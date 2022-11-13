<?php
    session_start();
    if (count($_POST) < 5) {
        session_destroy();
        header("Location: /");
    }
    $register = true;
    $redirect = htmlspecialchars($_POST["redirect"]) ?? "/";
    $name = $_POST["rname"] ?? "";
    $surname = $_POST["rsurname"] ?? "";
    $email = $_POST["remail"] ?? "";
    $password = $_POST["rpass"] ?? "";
    $rememberMe = $_POST["rremember"] ? true:false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["errors"] = "email-";
        $register = false;
    }
    $email = htmlspecialchars($email);
    // Validate password strength
    $passUpper = preg_match('@[A-Z]@', $password);
    $passLower = preg_match('@[a-z]@', $password);
    $passNumber    = preg_match('@[0-9]@', $password);
    $passSpecial = preg_match('@[^\w]@', $password);

    if (!$passUpper || !$passLower || !$passNumber || !$passSpecial || strlen($password) < 8) {
        $_SESSION["errors"] = $_SESSION["errors"] . "password-";
        $register = false;
    }
    $password = htmlspecialchars($password);
    
    // Validate name
    $nameNumber = preg_match('@[0-9]@', $name);
    $nameSpecial = preg_match('@[^\w]@', $name);
    if ($nameNumber || $nameSpecial || $name == "") {
        $_SESSION["errors"] = $_SESSION["errors"] . "name-";
        $register = false;
    }
    $name = htmlspecialchars($name);
    
    // Validate surname
    $surnameNumber = preg_match('@[0-9]@', $surname);
    $surnameSpecial = preg_match('@[^\w]@', $surname);
    if ($surnameNumber || $surnameSpecial || $surname == "") {
        $_SESSION["errors"] = $_SESSION["errors"] . "surname";
        $register = false;  
    }
    $surname = htmlspecialchars($surname);

    if ($register) {
        include("../includes/connect.php");
        $sql = "SELECT email FROM users WHERE email = '" . $email . "'";
        $select = $conn->query($sql);
        if ($select && mysqli_num_rows($select) == 0) {
            $conn->close();
            include("../includes/connect.php");
            $sql = "INSERT INTO users (name,surname,email,password,date) VALUES ('" . $name . "','" . $surname . "','" . $email . "','". password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]) ."',(SELECT now()))";
            if ($conn->query($sql) === TRUE) {
                $conn->close();
                include("../includes/connect.php");
                $sql = "SELECT * FROM users WHERE email = '" . $email . "'";
                $id = $conn->query($sql)->fetch_assoc()["id"];
                $conn->close();
                $_SESSION["id"] = $id;
                if ($rememberMe) {
                    $token = bin2hex(random_bytes(16));
                    $expired_seconds = time() + 60 * 60 * 24 * 30;
                    include("../includes/connect.php");
                    $sql = "INSERT INTO user_tokens (token,expiry,user_id) VALUES ('" . $token . "','" . $expired_seconds . "','" . $id . "')";
                    if ($conn->query($sql) === TRUE) {
                        $conn->close();
                        setcookie("remember_me",$token,$expired_seconds,"/","localhost");
                    }
                }
            }
        } else {
            $_SESSION["remailexistent"] = $email;
            $_SESSION["remail"] = $email;
            $_SESSION["rname"] = $name;
            $_SESSION["rsurname"] = $surname;
        }
    } else {
        $_SESSION["remail"] = $email;
        $_SESSION["rname"] = $name;
        $_SESSION["rsurname"] = $surname;
    }
    header("Location: " . $redirect);
?>