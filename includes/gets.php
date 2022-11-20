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
        "cpassword" => "<p class='text-sm text-red-500 w-4/6 ml-auto'>Contrasenya invalida <br> Minim: <br>1 majus, 1 minus, 1 numero, 1 simbol i 8 longitud</p>",
        "cnpassword" => "<p class='text-sm text-red-500 w-4/6 ml-auto'>Contrasenya invalida <br> Minim: <br>1 majus, 1 minus, 1 numero, 1 simbol i 8 longitud</p>",
        "cnrpassword" => "<p class='text-sm text-red-500 w-4/6 ml-auto'>Contrasenya invalida <br> Minim: <br>1 majus, 1 minus, 1 numero, 1 simbol i 8 longitud</p>",
        "noCoincideixen" => "<p class='text-sm text-red-500'>Les contrasenyes no coincideixen</p>",
        "passwordIncorrecte" => "<p class='text-sm text-red-500'>Contrasenya actual incorrecte</p>",
        "entryd" => "<p class='text-sm text-red-500'>L'entrada no ha pogut ser eliminada</p>",
        "categoryd" => "<p class='text-sm text-red-500'>La categoria no ha pogut ser eliminada</p>",
        "cname" => "<p class='text-sm text-red-500'>Nom invalid</p>",
        "csurname" => "<p class='text-sm text-red-500'>Cognom invalid</p>",
        "cemail" => "<p class='text-sm text-red-500'>Email invalid</p>",
        "cdesc" => "<p class='text-sm text-red-500'>Consulta invalida</p>",
        "contact" => "<p class='text-sm text-red-500 w-full'>El correu no ha pogut ser enviat</p>",
    ];

    $doneLogReg = [
        "category" => "<p class='text-sm text-green-500'>Categoria creada</p>",
        "entry" => "<p class='text-sm text-green-500'>Entrada creada</p>",
        "eentry" => "<p class='text-sm text-green-500'>Entrada modificada</p>",
        "password" => "<p class='text-sm text-green-500'>Contrasenya actualitzada</p>",
        "credentials" => "<p class='text-sm text-green-500'>Credencials actualitzades</p>",
        "entryd" => "<p class='text-sm text-green-500'>Entrada eliminada correctament</p>",
        "categoryd" => "<p class='text-sm text-green-500'>Categoria eliminada correctament</p>",
        "contact" => "<p class='text-sm text-green-500 w-full'>Correu enviat correctament</p>",
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
    
    function getCategories($limit = "") {
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/connect.php";
        $sql = "SELECT name,id FROM categories " . $limit;
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
        $sql = "SELECT * FROM entries ORDER BY date desc " . $limit;
        $select = $conn->query($sql);
        $row = $select->fetch_all();
        return $row;
    }
    
    function getEntry($id) {
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/connect.php";
        $sql = "SELECT * FROM entries WHERE id = " . $id;
        $select = $conn->query($sql);
        $row = $select->fetch_all();
        return $row[0];
    }


    function getUserEntries($id,$limit = "",$title = "", $category = "") {
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/connect.php";
        $titlesql = $title != "" ? " and title LIKE '%" . $title . "%'" : "";
        $categorysql = $category != "" ? " and entry_categories.category_id = '" . $category . "'" : "";
        if ($categorysql != "") {
            $sql = "SELECT * FROM entries INNER JOIN entry_categories ON entries.id = entry_id WHERE user_id = '" . $id . "'" . $titlesql . $categorysql . " ORDER BY date desc " . $limit;
        } else {
            $sql = "SELECT * FROM entries WHERE user_id = '" . $id . "'" . $titlesql . " ORDER BY date desc " . $limit;
        }
        $select = $conn->query($sql);
        $row = $select->fetch_all();
        return $row;
    }

    function getBlogName($entryID) {
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/connect.php";
        $sql = "SELECT name FROM blogs INNER JOIN entries ON entries.blog_id = blogs.id WHERE entries.id = " . $entryID;
        $select = $conn->query($sql);
        $row = $select->fetch_all();
        return $row[0][0];
    }

    function getGaleria($limit = "",$title = "", $category = "") {
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/connect.php";
        $titlesql = $title != "" ? " and title LIKE '%" . $title . "%'" : "";
        $categorysql = $category != "" ? " and entry_categories.category_id = '" . $category . "'" : "";
        if ($categorysql != "") {
            $sql = "SELECT * FROM entries INNER JOIN entry_categories ON entries.id = entry_id WHERE blog_id = 1" . $titlesql . $categorysql . " ORDER BY date desc " . $limit;
        } else {
            $sql = "SELECT * FROM entries WHERE blog_id = 1" . $titlesql . " ORDER BY date desc " . $limit;
        }
        $select = $conn->query($sql);
        $row = $select->fetch_all();
        return $row;
    }

    function getNoticies($limit = "",$title = "", $category = "") {
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/connect.php";
        $titlesql = $title != "" ? " and title LIKE '%" . $title . "%'" : "";
        $categorysql = $category != "" ? " and entry_categories.category_id = '" . $category . "'" : "";
        if ($categorysql != "") {
            $sql = "SELECT * FROM entries INNER JOIN entry_categories ON entries.id = entry_id WHERE blog_id = 2" . $titlesql . $categorysql . " ORDER BY date desc " . $limit;
        } else {
            $sql = "SELECT * FROM entries WHERE blog_id = 2" . $titlesql . " ORDER BY date desc " . $limit;
        }
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

    function getEntryCategoriesID($entryID) {
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/connect.php";
        $sql = "SELECT categories.id FROM categories INNER JOIN entry_categories ON entry_categories.category_id = categories.id WHERE entry_categories.entry_id = ". $entryID . "";
        $select = $conn->query($sql);
        $row = $select->fetch_all();
        return $row;
    }

    function str_without_accents($str, $charset='utf-8')
    {
        $str = htmlentities($str, ENT_NOQUOTES, $charset);

        $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
        $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

        return $str;   // or add this : mb_strtoupper($str); for uppercase :)
    }
?>