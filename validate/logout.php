<?php
    if (isset($_COOKIE["user"])) {
        unset($_COOKIE["user"]);
        setcookie('user', null, -1, '/'); 
    }
    if (isset($_COOKIE["password"])) {
        unset($_COOKIE["password"]);
        setcookie('password', null, -1, '/'); 
    }
    header("Location: /");
?>