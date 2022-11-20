<?php
    session_start();
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/gets.php";
    $actualUser = getUser();
    // If less than X post, redirect and destroy session
    if (count($_POST) < 5) {
        session_destroy();
        header("Location: /");
    }

    $contact = true;
    // Get posts
    $redirect = $_POST["redirect"] ?? "/";
    $name = htmlspecialchars($_POST["name"]) ?? "";
    $surname = htmlspecialchars($_POST["surname"]) ?? "";
    $email = $_POST["email"] ?? "";
    $desc = htmlspecialchars($_POST["desc"]) ?? "";
    // Check name
    if ($name == "") {
        $_SESSION["cnameerr"] = "cname";
        $contact = false;
    }
    // Check surname
    if ($surname == "") {
        $_SESSION["csurnameerr"] = "csurname";
        $contact = false;
    }
    // Check email
    if ($email == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["cemailerr"] = "cemail";
        $contact = false;
    }
    // Check description
    if ($desc == "") {
        $_SESSION["cdescerr"] = "cdesc";
        $contact = false;
    }
    // If we can send proceed
    if ($contact) {
        // Make variables with the content
        $to = "jordi.vilacast@gmail.com";
        $subject = "Contact form - " . $email;
        $content = $name . " " . $surname . "\n" . $desc;
        $headers = "From: jordi.vilacast@gmail.com\r\n";
        // Send mail and return message
        if (mail($to, $subject, $content, $headers))
        {
            $_SESSION["dcontact"] = "contact";
        } 
        else 
        {
            $_SESSION["econtact"] = "contact";
            $_SESSION["cname"] = $name;
            $_SESSION["csurname"] = $surname;
            $_SESSION["cemail"] = $email;
            $_SESSION["cdesc"] = $desc;
        }
    } else {
        $_SESSION["cname"] = $name;
        $_SESSION["csurname"] = $surname;
        $_SESSION["cemail"] = $email;
        $_SESSION["cdesc"] = $desc;
    }

    header("Location: " . $redirect)
?>