<?php
    session_start();
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/gets.php";
    $actualUser = getUser();
    // If less than X post, redirect and destroy session
    if (count($_POST) < 3) {
        session_destroy();
        header("Location: /");
    }
    $modify = true;
    // Get posts
    $cpassword = $_POST["cpassword"];
    $cnpassword = $_POST["cnpassword"];
    $cnrpassword = $_POST["cnrpassword"];
    $arr = ["cpassword" => $cpassword, "cnpassword" => $cnpassword, "cnrpassword" => $cnrpassword];
    
    // Validate password strength
    foreach ($arr as $key => $value) {
        $passUpper = preg_match('@[A-Z]@', $value);
        $passLower = preg_match('@[a-z]@', $value);
        $passNumber = preg_match('@[0-9]@', $value);
        $passSpecial = preg_match("/[^A-Za-z0-9 ]/", $value);

        if (!$passUpper || !$passLower || !$passNumber || !$passSpecial || strlen($value) < 8) {
            $_SESSION[$key] = $key;
            $modify = false;
        }
    }
    $cpassword = htmlspecialchars($cpassword);
    $cnpassword = htmlspecialchars($cnpassword);
    $cnrpassword = htmlspecialchars($cnrpassword);

    // Check if are different
    if ($cnpassword != $cnrpassword) {
        $_SESSION["cnrpassword"] = "noCoincideixen";
        $modify = false;
    }
    // If we can modify proceed
    if ($modify) {
        // Verify password
        if (password_verify($cpassword, $actualUser["password"])) {
            // Make update and return message
            include("../includes/connect.php");
            $sql = "UPDATE users SET password = '" . password_hash($cnpassword, PASSWORD_BCRYPT, ['cost'=>4]) . "' WHERE id = '" . $actualUser["id"] . "'";
            if ($conn->query($sql)) {
                $_SESSION["correct"] = "password";
            } else {
                $_SESSION["cpassword"] = "passwordIncorrecte";
            }
        } else {
            $_SESSION["cpassword"] = "passwordIncorrecte";
        }
    }
    header("Location: /user")
?>