<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/gets.php";
    $actualUser = getUser();
    // If less than X post, redirect and destroy session
    if (count($_POST) < 2) {
        session_destroy();
        header("Location: /");
    }
    // Get posts
    $redirect = $_POST["redirect"] ?? "/";
    $idCategory = $_POST["categoryToDelete"] ?? "";
    // Delete category and return response
    include("../includes/connect.php");
    $sql = "DELETE FROM categories WHERE categories.id = '" . $idCategory . "'";
    $insert = $conn->query($sql);
    $conn->close();
    if ($insert === TRUE) {
        $_SESSION["dcategorys"] = "categoryd";
    } else {
        $_SESSION["dcategoryf"] = "categoryd";
    }
    header("Location: " . $redirect)
?>