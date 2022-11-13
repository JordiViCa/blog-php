<?php
    session_start();
    if (isset($_SESSION["errors"])) {
        $errors = explode("-",$_SESSION["errors"]);
        unset($_SESSION["errors"]);
    }
    if (isset($_SESSION["rdone"])) {
        unset($_SESSION["rdone"]);
    }
    if (isset($_COOKIE["remember_me"])) {
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/connect.php";
        $sql = "SELECT * FROM user_tokens WHERE token = '" . $_COOKIE["remember_me"] . "'";
        $select = $conn->query($sql);
        if ($select && mysqli_num_rows($select) == 1) {
            $_SESSION["id"] = $select->fetch_assoc()["user_id"];
        }
        $conn->close();
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
<body class="bg-gray-100 relative" style="z-index: 5;">
    <header>
        <h1 class="text-2xl sm:text-5xl md:text-7xl font-extralight py-4 pl-4">L'ART GENERAT PER I.A.</h1>
        <nav class="flex justify-between border-b border-t border-gray-400 text-lg">
            <div class="flex flex-row">
                <a class="px-8 py-2 bg-gray-200 hover:bg-gray-400 border-gray-400 border-r border-l transition-all" href="/">Inici</a>
                <a class="px-8 py-2 bg-gray-200 hover:bg-gray-400 border-gray-400 border-r border-l transition-all" href="/galeria">Galeria</a>
                <a class="px-8 py-2 bg-gray-200 hover:bg-gray-400 border-gray-400 border-r border-l transition-all" href="/noticies">Noticies</a>
            </div>
            <div class="flex flex-row relative">
                
                
                

                <!-- Dropdown menu -->


                <?php 

                    if (isset($_SESSION["id"])) {
                        echo '<button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider" class="px-8 inline-flex items-center py-2 bg-gray-200 active:bg-gray-400  hover:bg-gray-400 border-gray-400 border-r border-l" type="button">' . getFullName() . '<svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>';
                        echo    '<div id="dropdownDivider" class="hidden z-10 w-44 bg-gray-200 rounded divide-y divide-gray-100 shadow" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: trangray(0px, 510px);">
                                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownDividerButton">
                                        <li>
                                            <a href="/user" class="inline-flex w-full py-2 px-4 hover:bg-gray-100"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 mr-2 my-auto" viewBox="0 0 512 512"><title>Settings</title><path d="M262.29 192.31a64 64 0 1057.4 57.4 64.13 64.13 0 00-57.4-57.4zM416.39 256a154.34 154.34 0 01-1.53 20.79l45.21 35.46a10.81 10.81 0 012.45 13.75l-42.77 74a10.81 10.81 0 01-13.14 4.59l-44.9-18.08a16.11 16.11 0 00-15.17 1.75A164.48 164.48 0 01325 400.8a15.94 15.94 0 00-8.82 12.14l-6.73 47.89a11.08 11.08 0 01-10.68 9.17h-85.54a11.11 11.11 0 01-10.69-8.87l-6.72-47.82a16.07 16.07 0 00-9-12.22 155.3 155.3 0 01-21.46-12.57 16 16 0 00-15.11-1.71l-44.89 18.07a10.81 10.81 0 01-13.14-4.58l-42.77-74a10.8 10.8 0 012.45-13.75l38.21-30a16.05 16.05 0 006-14.08c-.36-4.17-.58-8.33-.58-12.5s.21-8.27.58-12.35a16 16 0 00-6.07-13.94l-38.19-30A10.81 10.81 0 0149.48 186l42.77-74a10.81 10.81 0 0113.14-4.59l44.9 18.08a16.11 16.11 0 0015.17-1.75A164.48 164.48 0 01187 111.2a15.94 15.94 0 008.82-12.14l6.73-47.89A11.08 11.08 0 01213.23 42h85.54a11.11 11.11 0 0110.69 8.87l6.72 47.82a16.07 16.07 0 009 12.22 155.3 155.3 0 0121.46 12.57 16 16 0 0015.11 1.71l44.89-18.07a10.81 10.81 0 0113.14 4.58l42.77 74a10.8 10.8 0 01-2.45 13.75l-38.21 30a16.05 16.05 0 00-6.05 14.08c.33 4.14.55 8.3.55 12.47z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg> Configuració</a>
                                        </li>
                                        <li>
                                            <a href="/user/entry" class="inline-flex w-full py-2 px-4 hover:bg-gray-100"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 mr-2 my-auto" viewBox="0 0 512 512"><title>Document</title><path d="M416 221.25V416a48 48 0 01-48 48H144a48 48 0 01-48-48V96a48 48 0 0148-48h98.75a32 32 0 0122.62 9.37l141.26 141.26a32 32 0 019.37 22.62z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M256 56v120a32 32 0 0032 32h120" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg> Afegir entrada</a>
                                        </li>
                                        <li>
                                            <a href="/user/category" class="inline-flex w-full py-2 px-4 hover:bg-gray-100"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 mr-2 my-auto" viewBox="0 0 512 512"><title>Copy</title><rect x="128" y="128" width="336" height="336" rx="57" ry="57" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M383.5 128l.5-24a56.16 56.16 0 00-56-56H112a64.19 64.19 0 00-64 64v216a56.16 56.16 0 0056 56h24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg> Afegir categoria</a>
                                        </li>
                                    </ul>
                                    <div class="py-1">
                                    <a href="/validate/logout.php" class="inline-flex w-full py-2 px-4 text-sm text-gray-700 hover:bg-gray-100"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 mr-2 my-auto" viewBox="0 0 512 512"><title>Log Out</title><path d="M304 336v40a40 40 0 01-40 40H104a40 40 0 01-40-40V136a40 40 0 0140-40h152c22.09 0 48 17.91 48 40v40M368 336l80-80-80-80M176 256h256" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg> Logout</a>
                                    </div>
                                </div>';
                    } else {
                        echo '<button class="px-8 py-2 bg-gray-200 hover:bg-gray-400 border-gray-400 border-r border-l" onclick="toggleLogin()">Login</button>
                        <button class="px-8 py-2 bg-gray-200 hover:bg-gray-400 border-gray-400 border-r border-l" onclick="toggleRegister()">Register</button>';
                    }
                ?>
            </div>
        </nav>
    </header>