<?php
    session_start();
    // If less than X post, redirect and destroy session
    if (count($_POST) < 3) {
        session_destroy();
        header("Location: /");
    }
    // Get posts
    $username = $_POST["lemail"] ?? "";
    $password = $_POST["lpassword"] ?? "";
    $redirect = $_POST["redirect"] ?? "/";
    $remember = $_POST["lremember"] ? true:false;
    // Try to get user
    include("../includes/connect.php");
    $sql = "SELECT * FROM users WHERE email = '" . $username . "'";
    $select = $conn->query($sql);
    $conn->close();
    // If exists
    if ($select && mysqli_num_rows($select) == 1) {
        $row = $select->fetch_assoc();
        // Check password
        if (password_verify($password,$row["password"])) {
            // Create session
            $_SESSION["id"] = $row["id"];
            // If remember me
            if ($remember) {
                // Try to get user token
                include("../includes/connect.php");
                $sql = "SELECT * FROM user_tokens WHERE user_id = '" . $row["id"] . "' ORDER BY expiry DESC LIMIT 1";
                $rememberSelect = $conn->query($sql);
                $result = $rememberSelect->fetch_assoc();
                $conn->close();
                echo time();
                // If exists and is valid set cookie, else generate cookie
                if ($rememberSelect && mysqli_num_rows($rememberSelect) > 0 && $result["expiry"] > time()) {
                    setcookie("remember_me",$result["token"],$result["expiry"],"/","localhost");
                } else {
                    $token = bin2hex(random_bytes(16));
                    $expired_seconds = time() + 60 * 60 * 24 * 30;
                    include("../includes/connect.php");
                    $sql = "INSERT INTO user_tokens (token,expiry,user_id) VALUES ('" . $token . "','" . $expired_seconds . "','" . $row["id"] . "')";
                    if ($conn->query($sql) === TRUE) {
                        $conn->close();
                        setcookie("remember_me",$token,$expired_seconds,"/","localhost");
                    }
                }
            }
        } else {
            $_SESSION["lError"] = $username;
        }
    } else {
        $_SESSION["lError"] = $username;
    }
    header("Location: " . $redirect);
?>