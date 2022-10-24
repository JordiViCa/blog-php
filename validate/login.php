<?php
    session_start();
    if (count($_POST) < 3) {
        session_destroy();
        header("Location: /");
    }
    $username = $_POST["lemail"] ?? "";
    $password = $_POST["lpassword"] ?? "";
    $redirect = $_POST["redirect"] ?? "/";

    include("../includes/connect.php");
    $sql = "SELECT * FROM users WHERE email = '" . $username . "'";
    $select = $conn->query($sql);
    $conn->close();
    if ($select && mysqli_num_rows($select) == 1) {
        $row = $select->fetch_assoc();
        if (password_verify($password,$row["password"])) {
            if (isset($_POST["lremember"])) {
                $time = time()+2592000;
                setcookie("remember",TRUE,$time,"/","localhost");
            } else {
                $time = time()+14400;
            }
            setcookie("password",$password,$time,"/","localhost");
            setcookie("user",$username,$time,"/","localhost");
            header("Location: " . $redirect);
        } else {
            $_SESSION["lError"] = $username;
            header("Location: " . $redirect);
        }
    } else {
        $_SESSION["lError"] = $username;
        header("Location: " . $redirect);
    }
?>