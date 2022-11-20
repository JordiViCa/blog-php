<?php
    session_start();
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/gets.php";
    $actualUser = getUser();
    // If less than X post, redirect and destroy session
    if (count($_POST) < 2) {
        session_destroy();
        header("Location: /");
    }

    $category = true;
    // Get posts
    $redirect = $_POST["redirect"] ?? "/";
    $name = $_POST["category"] ?? "";

    // Validate name
    $nameSpecial = preg_match("/[^A-Za-z0-9 ]/", $name);
    if ($nameSpecial || $name == "") {
        $_SESSION["cerror"] = $name;
        $category = false;
    }
    // If valid continue
    if ($category) {
        // Make select to prevent repeated names
        include("../includes/connect.php");
        $sql = "SELECT * FROM categories WHERE name = '" . $name . "'";
        $select = $conn->query($sql);
        if ($select && mysqli_num_rows($select) == 0) {
            // Insert and return message
            $conn->close();
            include("../includes/connect.php");
            $sql = "INSERT INTO categories (name) VALUES ('" . $name . "')";
            if ($conn->query($sql) === TRUE) {
                $_SESSION["cdone"] = "category";
            }
            $conn->close();
        } else {
            $conn->close();
            $_SESSION["cerror"] = "category";
        }
    }
    header("Location: " . $redirect)
?>