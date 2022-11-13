<?php 

    $errorsLogReg = [
        "password" => "<p class='text-sm text-red-500 w-4/6 ml-auto'>Contrasenya invalida <br> Minim: <br>1 majus, 1 minus, 1 numero, 1 simbol i 8 longitud</p>",
        "remailexistent" => "<p class='text-sm text-red-500 w-4/6 ml-auto'>Correu electronic ja registrat</p>",
        "email" => "<p class='text-sm text-red-500 w-4/6 ml-auto'>Email invalid</p>",
        "surname" => "<p class='text-sm text-red-500 w-4/6 ml-auto'>Cognom invalid</p>",
        "name" => "<p class='text-sm text-red-500 w-4/6 ml-auto'>Nom invalid</p>",
        "lError" => "<p class='text-sm text-red-500 w-4/6 ml-auto'>Usurai / Contrasenya incorrecte</p>",
        "category" => "<p class='text-sm text-red-500'>La categoria ja existeix</p>",
        "blogNotFound" => "<p class='text-sm text-red-500'>No s'ha trobat el blog seleccionat</p>",
        "emptyCategory" => "<p class='text-sm text-red-500'>No s'ha seleccionat categoria</p>",
        "badTitle" => "<p class='text-sm text-red-500'>Titol invalid</p>",
        "emptyDescription" => "<p class='text-sm text-red-500'>No s'ha agregat cap descripció</p>",
        "uploadFailed" => "<p class='text-sm text-red-500'>L'imatge no ha pogut ser pujada correctament</p>",
        "extensionError" => "<p class='text-sm text-red-500'>Extensió d'imatge invalida</p>",
        "emptyBlog" => "<p class='text-sm text-red-500'>No s'ha seleccionat blog</p>",
    ];

    $doneLogReg = [
        "category" => "<p class='text-sm text-green-500'>Categoria creada</p>",
        "entry" => "<p class='text-sm text-green-500'>Entrada creada</p>",
    ];

    function displayError($key,$text = "") {
        global $errorsLogReg;
        if (!empty($text)) {
            return "<p class='text-sm text-red-500 w-4/6 ml-auto'>" . $text . "</p>";
        } else {
            return $errorsLogReg[$key];
        }
    }
    function displayDone($key, $text = "") {
        global $doneLogReg;
        if (!empty($text)) {
            return "<p class='text-sm text-red-500 w-4/6 ml-auto'>" . $text . "</p>";
        } else {
            return $doneLogReg[$key];
        }
    }
    function getFullName() {
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/connect.php";
        $sql = "SELECT name,surname FROM users WHERE id = '" . $_SESSION["id"] . "'";
        $select = $conn->query($sql);
        $row = $select->fetch_assoc();
        $nameSurname = $row["name"] . " " . $row["surname"];
        $conn->close();
        return $nameSurname;
    }

    function getUser() {
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/connect.php";
        $sql = "SELECT * FROM users WHERE id = '" . $_SESSION["id"] . "'";
        $select = $conn->query($sql);
        $row = $select->fetch_assoc();
        $conn->close();
        if (isset($row["name"])) {
            return $row;
        }
        header("Location: /");
    }
    
    function getCategories() {
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/connect.php";
        $sql = "SELECT name FROM categories";
        $select = $conn->query($sql);
        $row = $select->fetch_all();
        return $row;
    }
    
    function getSiteRoot() {
        return str_replace("\includes","",realpath(dirname(__FILE__)));
    }

    function getBlogs() {
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/connect.php";
        $sql = "SELECT * FROM blogs";
        $select = $conn->query($sql);
        $row = $select->fetch_all();
        return $row;
    }

    function getEntries($limit = "") {
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/connect.php";
        $sql = "SELECT * FROM entries " . $limit;
        $select = $conn->query($sql);
        $row = $select->fetch_all();
        return $row;
    }

    function getGaleria($limit = "") {
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/connect.php";
        $sql = "SELECT * FROM entries WHERE blog_id = 1 " . $limit;
        $select = $conn->query($sql);
        $row = $select->fetch_all();
        return $row;
    }

    function getNoticies($limit = "") {
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/connect.php";
        $sql = "SELECT * FROM entries WHERE blog_id = 2 " . $limit;
        $select = $conn->query($sql);
        $row = $select->fetch_all();
        return $row;
    }

    function getEntryCategories($entryID) {
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/connect.php";
        $sql = "SELECT categories.name FROM categories INNER JOIN entry_categories ON entry_categories.category_id = categories.id WHERE entry_categories.entry_id = ". $entryID . "";
        $select = $conn->query($sql);
        $row = $select->fetch_all();
        return $row;
    }
?>