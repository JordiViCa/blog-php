<?php
    session_start();
    if (count($_POST) < 4) {
        session_destroy();
        header("Location: /");
    }
    $register = true;
    $name = $_POST["rname"] ?? "";
    $surname = $_POST["rsurname"] ?? "";
    $email = $_POST["remail"] ?? "";
    $password = $_POST["rpass"] ?? "";
    $rememberMe = $_POST["rremember"] ? TRUE:FALSE;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["rerror"] = "email-";
        $register = false;
    }
    // Validate password strength
    $passUpper = preg_match('@[A-Z]@', $password);
    $passLower = preg_match('@[a-z]@', $password);
    $passNumber    = preg_match('@[0-9]@', $password);
    $passSpecial = preg_match('@[^\w]@', $password);

    if (!$passUpper || !$passLower || !$passNumber || !$passSpecial || strlen($password) < 8) {
        $_SESSION["rerror"] = $_SESSION["rerror"] . "password-";
        $register = false;
    }
    
    // Validate name
    $nameNumber = preg_match('@[0-9]@', $name);
    $nameSpecial = preg_match('@[^\w]@', $name);
    if ($nameNumber || $nameSpecial || $name == "") {
        $_SESSION["rerror"] = $_SESSION["rerror"] . "name-";
        $register = false;
    }
    
    // Validate surname
    $surnameNumber = preg_match('@[0-9]@', $surname);
    $surnameSpecial = preg_match('@[^\w]@', $surname);
    if ($surnameNumber || $surnameSpecial || $surname == "") {
        $_SESSION["rerror"] = $_SESSION["rerror"] . "surname";
        $register = false;  
    }
    if ($register) {
        include("../includes/connect.php");
        $sql = "SELECT email FROM users WHERE email = '" . $email . "'";
        $select = $conn->query($sql);
        if ($select && mysqli_num_rows($select) == 0) {
            $conn->close();
            include("../includes/connect.php");
            $sql = "INSERT INTO users (name,surname,email,password,date) VALUES ('" . $name . "','" . $surname . "','" . $email . "','". password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]) ."',(SELECT now()))";
            if ($conn->query($sql) === TRUE) {
                if ($rememberMe === TRUE) {
                    setcookie("password",$password,time()+2592000,"/","localhost");
                    setcookie("user",$email,time()+2592000,"/","localhost");
                    setcookie("remember",$rememberMe,time()+2592000,"/","localhost");
                } else {
                    setcookie("password",$password,time()+14400,"/","localhost");
                    setcookie("user",$email,time()+14400,"/","localhost");
                }
                header("Location: /");
            } else {
                echo "\nError" . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        } else {
            $_SESSION["remailexistent"] = $email;
            $_SESSION["remail"] = $email;
            $_SESSION["rname"] = $name;
            $_SESSION["rsurname"] = $surname;
            header("Location: /");
        }
    } else {
        $_SESSION["remail"] = $email;
        $_SESSION["rname"] = $name;
        $_SESSION["rsurname"] = $surname;
        header("Location: /");
    }
?>