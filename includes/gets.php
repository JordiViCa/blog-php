<?php 

    $errorsLogReg = [
        "password" => "Contrasenya invalida <br> Minim: <br>1 majus, 1 minus, 1 numero, 1 simbol i 8 longitud",
        "remailexistent" => "Correu electronic ja registrat",
        "email" => "Email invalid",
        "surname" => "Cognom invalid",
        "name" => "Nom invalid",
        "lError" => "Usurai / Contrasenya incorrecte"
    ];

    function displayError($key,$text = "") {
        global $errorsLogReg;
        if (!empty($text)) {
            return "<p class='text-sm text-red-500 w-4/6 ml-auto'>" . $text . "</p>";
        } else {
            return "<p class='text-sm text-red-500 w-4/6 ml-auto'>" . $errorsLogReg[$key] . "</p>";
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
        $sql = "SELECT name,surname,email FROM users WHERE id = '" . $_SESSION["id"] . "'";
        $select = $conn->query($sql);
        $row = $select->fetch_assoc();
        $conn->close();
        return $row;
    }
?>