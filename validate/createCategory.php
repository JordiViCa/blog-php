<?php
    session_start();
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/gets.php";
    $actualUser = getUser();
    if (count($_POST) < 2) {
        session_destroy();
        header("Location: /");
    }

    $category = true;
    $redirect = $_POST["redirect"] ?? "/";
    $name = $_POST["category"] ?? "";

    // Validate name
    $nameNumber = preg_match('@[0-9]@', $name);
    $nameSpecial = preg_match('@[^\w]@', $name);
    if ($nameNumber || $nameSpecial || $name == "") {
        $_SESSION["cerror"] = $name;
        $category = false;
    }

    if ($category) {
        include("../includes/connect.php");
        $sql = "SELECT * FROM categories WHERE name = '" . $name . "'";
        $select = $conn->query($sql);
        if ($select && mysqli_num_rows($select) == 0) {
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