<?php
    session_start();
    if (isset($_SESSION["rerror"])) {
        $rerrors = explode("-",$_SESSION["rerror"]);
    }
    if (isset($_SESSION["rdone"])) {
        echo "registered";
    }
    if (isset($_COOKIE["remember"])) {
        $cookieUser = $_COOKIE["user"];
        if (isset($_COOKIE["password"])) {
            $time = time()+2592000;
            $cookiePassword = $_COOKIE["password"];
            setcookie("remember",TRUE,$time,"/","localhost");
            setcookie("password",$cookiePassword,$time,"/","localhost");
            setcookie("user",$cookieUser,$time,"/","localhost");
        }
    }
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/gets.php";
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 relative" style="z-index: 5;">
    <header>
        <h1 class="text-7xl font-extralight py-4 pl-4">L'ART GENERAT PER I.A.</h1>
        <nav class="flex justify-between border-b border-t border-gray-400 text-lg">
            <div class="flex flex-row">
                <a class="px-8 py-2 bg-slate-200 hover:bg-slate-400 border-gray-400 border-r border-l" href="/">Inici</a>
                <a class="px-8 py-2 bg-slate-200 hover:bg-slate-400 border-gray-400 border-r border-l" href="/galeria">Galeria</a>
                <a class="px-8 py-2 bg-slate-200 hover:bg-slate-400 border-gray-400 border-r border-l" href="/noticies">Noticies</a>
            </div>
            <div class="flex flex-row">
                <?php 

                    if (isset($_COOKIE["user"]) && isset($_COOKIE["password"])) {
                        echo '<a class="px-8 py-2 bg-slate-200 hover:bg-slate-400 border-gray-400 border-r border-l" href="/user">' . getFullName() . '</a>';
                        echo '<a class="px-8 py-2 bg-slate-200 hover:bg-slate-400 border-gray-400 border-r border-l" href="/validate/logout.php">Logout</a>';
                    } else {
                        echo '<button class="px-8 py-2 bg-slate-200 hover:bg-slate-400 border-gray-400 border-r border-l" onclick="toggleLogin()">Login</button>
                        <button class="px-8 py-2 bg-slate-200 hover:bg-slate-400 border-gray-400 border-r border-l" onclick="toggleRegister()">Register</button>';
                    }
                ?>
            </div>
        </nav>
    </header>