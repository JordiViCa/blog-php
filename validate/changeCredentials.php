<?php
    session_start();
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/gets.php";
    $actualUser = getUser();
    // If less than X post, redirect and destroy session
    if (count($_POST) < 2) {
        session_destroy();
        header("Location: /");
    }
    $modify = true;
    // Get posts
    $name = $_POST["cname"];
    $surname = $_POST["csurname"];
    
    // Validate name
    $nameNumber = preg_match('@[0-9]@', $name);
    $nameSpecial = preg_match("/[^A-Za-z0-9 ]/", $name);
    if ($nameNumber || $nameSpecial || $name == "") {
        $_SESSION["cname"] = "name";
        $modify = false;
    }
    $name = htmlspecialchars($name);
    
    // Validate surname
    $surnameNumber = preg_match('@[0-9]@', $surname);
    $surnameSpecial = preg_match("/[^A-Za-z0-9 ]/", $surname);
    if ($surnameNumber || $surnameSpecial || $surname == "") {
        $_SESSION["csurname"] = "surname";
        $modify = false;  
    }
    $surname = htmlspecialchars($surname);
    // If we can modify proceed
    if ($modify) {
        // Make update and return message
        include("../includes/connect.php");
        $sql = "UPDATE users SET name = '" . $name . "', surname = '" . $surname . "' WHERE id = '" . $actualUser["id"] . "'";
        if ($conn->query($sql)) {
            $_SESSION["ccorrect"] = "credentials";
        } else {
            $_SESSION["cname"] = "name";
        }
    }
    header("Location: /user")
?>