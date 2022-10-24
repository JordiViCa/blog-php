<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
    $backUrl = $_SERVER['REQUEST_URI'];
    $actualUser = getUser();
?>
    <main class="py-10 flex flex-row justify-arround">
        <div class="flex flex-col bg-slate-200 mx-auto w-auto px-20 py-14 rounded-md">
            <h1 class="text-4xl font-thin">Modificar dades</h1>
            <form class="mt-10 flex flex-col" action="/validate/modify.php" method="post">
                <div class="flex flex-col mb-4">
                    <div class="flex flex-row">
                        <label class="w-2/6 text-right pr-4 text-lg" for="rname">Nom</label>
                        <input class="w-4/6 border-b border-slate-600 h-8 text-lg focus:outline-gray-500" type="text" name="rname" required id="rname" <?php echo "value='" . $actualUser['name'] . "'"; ?>>
                    </div>
                    <?php
                        if (isset($rerrors) && in_array("name",$rerrors)) {
                            echo displayError("name");
                        }
                    ?>
                </div>
                <div class="flex flex-col mb-4">
                    <div class="flex flex-row">
                        <label class="w-2/6 text-right pr-4 text-lg" for="rsurname">Cognom</label>
                        <input class="w-4/6 border-b border-slate-600 h-8 text-lg focus:outline-gray-500" type="text" name="rsurname" required id="rsurname" <?php echo "value='" . $actualUser['surname'] . "'"; ?>>
                    </div>
                    <?php
                        if (isset($rerrors) && in_array("surname",$rerrors)) {
                            echo displayError("surname");
                        }
                    ?>
                </div>
                <div class="flex flex-col mb-4">
                    <div class="flex flex-row">
                        <label class="w-2/6 text-right pr-4 text-lg" for="remail">Email</label>
                        <input class="w-4/6 border-b border-slate-600 h-8 text-lg focus:outline-gray-500" disabled type="text" name="remail" required id="remail" <?php echo "value='" . $actualUser['email'] . "'"; ?>>
                    </div>
                </div>
                <div class="flex flex-col mb-4">
                    <div class="flex flex-row">
                        <label class="w-2/6 text-right pr-4 text-lg" for="rpass">Contrasenya</label>
                        <input class="w-4/6 border-b border-slate-600 h-8 text-lg focus:outline-gray-500" type="text" name="rpass" required id="rpass">
                    </div>
                    <?php
                        if (isset($rerrors) && in_array("password",$rerrors)) {
                            echo displayError("password");
                        }
                    ?>
                </div>
                <div class="flex flex-col mb-4">
                    <div class="flex flex-row">
                        <label class="w-2/6 text-right pr-4 text-lg" for="rpass">Contrasenya</label>
                        <input class="w-4/6 border-b border-slate-600 h-8 text-lg focus:outline-gray-500" type="text" name="rpass" required id="rpass">
                    </div>
                    <?php
                        if (isset($rerrors) && in_array("password",$rerrors)) {
                            echo displayError("password");
                        }
                    ?>
                </div>
                <div class="flex flex-row">
                    <div class="ml-auto w-4/6 text-lg">
                        <input class=" checked:accent-gray-500 focus:outline-gray-500" type="checkbox" name="rremember" id="rremember">
                        <label class="w-2/6 text-right pr-4 text-lg" for="rremember">Recordem</label>
                    </div>
                </div>
                <button class="bg-gray-500 w-4/6 ml-auto text-white hover:bg-white hover:text-gray-500 border-gray-500 border focus:outline-gray-500" type="submit">Modificar</button>
            </form>
        </div>
        <div class="flex flex-wrap bg-slate-200 mx-auto w-auto px-20 py-14 rounded-md">
            <h1 class="text-6xl font-thin">Entrades</h1>
        </div>
    </main>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "./includes/footer.php";
?>