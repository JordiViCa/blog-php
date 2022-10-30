<?php
    session_start();
    unset($_SESSION["id"]);
    unset($_COOKIE["remember_me"]);
    setcookie('remember_me', null, -1, '/'); 
    header("Location: /");
?>