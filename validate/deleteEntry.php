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
    $idEntry = $_POST["entryToDelete"] ?? "";
    // Get entry
    $entry = getEntry($idEntry);
    // Unlink entry image
    if ($entry[7] != "") {
        unlink(getSiteRoot() . $entry[7]);
    }
    // Delete entry and return message
    include("../includes/connect.php");
    $sql = "DELETE FROM entries WHERE entries.id = '" . $idEntry . "'";
    $insert = $conn->query($sql);
    $conn->close();
    if ($insert === TRUE) {
        $_SESSION["dentrys"] = "entryd";
    } else {
        $_SESSION["dentryf"] = "entryd";
    }
    header("Location: " . $redirect)
?>