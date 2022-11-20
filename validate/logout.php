<?php
    session_start();
    // Unset remember and id, destroy cookie and session
    unset($_SESSION["id"]);
    unset($_COOKIE["remember_me"]);
    setcookie('remember_me', null, -1, '/'); 
    session_destroy();
    header("Location: /");
?>