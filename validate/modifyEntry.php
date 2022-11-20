<?php
    session_start();
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/gets.php";
    $actualUser = getUser();
    // If less than X post, redirect and destroy session
    if (count($_POST) < 3) {
        session_destroy();
        header("Location: /");
    }
    $entry = true;
    // Get posts
    $actualEntry = getEntry($_POST["e"]);
    $redirect = $_POST["redirect"] ?? "/";
    $title = $_POST["title"] ?? "";
    $description = htmlspecialchars($_POST["description"]) ?? "";
    $description = str_replace("'","&#39;",$description);
    $blogs = getBlogs();
    $blogid = $_POST["blog"] ?? "";
    // Validate blog
    $found = false;
    foreach ($blogs as $blog) {
        if ($blog[0] == $blogid) {
            $found = true;
        }
    }
    if (!$found) {
        $entry = false;
        $_SESSION["erroreb"] = "blogNotFound";
    }
    // Validate categories
    $categories = [];
    $rows = getCategories();
    foreach ($rows as $row) {
        if (isset($_POST[strtolower($row[0])])) {
            array_push($categories,strtolower($row[0]));
        }
    }
    if (count($categories) < 1) {
        $entry = false;
        $_SESSION["errorec"] = "emptyCategory";
    }

    // Validate title
    $nameSpecial = preg_match("/[^A-Za-z0-9 ]/", $title);
    if ($nameSpecial || $title == "") {
        $_SESSION["erroret"] = "badTitle";
        $entry = false;
    }
    $title = htmlspecialchars($title);
    // Validate description
    if ($description == "") {
        $_SESSION["errored"] = "emptyDescription";
        $entry = false;
    }

    if ($blogid == "") {
        $entry = false;
        $_SESSION["errorblog"] = "emptyBlog";
    }
    // Validate file
    if (isset($_FILES['file']) && $entry && $_FILES['file']['name'] != "" && $_FILES['file']['name'] != $entry[6]) {
        // If image, make variables with fields
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = ['jpg', 'jpeg', 'png', 'svg'];
        // Check if extension allowed
        if (in_array($fileActualExt, $allowed)) {
            // If not file error
            if ($fileError === 0) {
                // Generate new name for the file
                $isFile = False;
                while ($isFile == False) {
                    $fileDestination = getSiteRoot()."/assets/img/". rand() .$fileName;
                    if (!file_exists($fileDestination)) {
                        $isFile = True;
                    }
                }
                // Generate the final url and move the image
                $finalUrl = str_replace(getSiteRoot(),"",$fileDestination);
                move_uploaded_file($fileTmpName, $fileDestination);
                $image = $fileDestination;
                include("../includes/connect.php");
                $sql = "UPDATE entries SET image = '" . $fileName . "',image_url = '" . $finalUrl . "' WHERE id = '" . $actualEntry[0] . "'";
                // If all ok remove the old img
                if ($insert = $conn->query($sql)) {
                    unlink(getSiteRoot() . $actualEntry[7]);
                }
                $conn->close();
            } else {
                $entry = false;
                $_SESSION["erroreu"] = "uploadFailed";
            }
        } else {
            $entry = false;
            $_SESSION["erroreu"] = "extensionError";
        }
    } else {
        $image = "";
    }
    // If valid continue
    if ($entry) {
        // Insert
        include("../includes/connect.php");
        $sql = "UPDATE entries SET title = '" . $title . "',description = '" . $description . "',blog_id = '" . $blogid . "' WHERE id = '" . $actualEntry[0] . "'";
        $insert = $conn->query($sql);
        $conn->close();
        if ($insert === TRUE) {
            // Get ID
            include("../includes/connect.php");
            $sql = "DELETE FROM entry_categories WHERE entry_id = '" . $actualEntry[0] . "'";
            if ($delete = $conn->query($sql)) {
                $conn->close();
                // Get the categories id and insert into entry_categories
                foreach ($categories as $value) {
                    include("../includes/connect.php");
                    $sql = "SELECT id FROM categories WHERE name = '" . $value . "'";
                    $select2 = $conn->query($sql);
                    if ($select2) {
                        $row2 = $select2->fetch_assoc();
                        $conn->close();
                        include("../includes/connect.php");
                        $sql = "INSERT INTO entry_categories (entry_id,category_id) VALUES ('" . $actualEntry[0] . "','" . $row2["id"] . "')";
                        $insertec = $conn->query($sql);
                        $conn->close();
                        $_SESSION["eedone"] = "eentry";
                    }
                } 
            } else {
                $conn->close();
            } 
        }
    } else {
        $_SESSION["enamerror"] = $title;
        $_SESSION["edscerror"] = $description;
        foreach ($categories as $row) {
            $_SESSION[$row] = $row[0];
        }
    }
    header("Location: " . $redirect)
?>