<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
    $backUrl = $_SERVER['REQUEST_URI'];
    $actualUser = getUser();
?>
<main class="py-10 flex flex-row justify-arround">
    <div class="flex flex-col bg-gray-200 mx-auto w-auto px-20 py-14 rounded-md shadow-lg">
        <h1 class="text-4xl font-thin">Afegir categoria</h1>
        <form class="mt-10 flex flex-col" action="/validate/createCategory.php" method="post">
            <div class="flex flex-col mb-4">
                <div class="flex flex-col">
                    <label class="text-xl" for="category">Titol</label>
                    <input class="w-full border-b border-gray-600 h-8 text-lg focus:outline-gray-500" type="text" name="category" value="<?php echo isset($_SESSION["cerror"]) ? $_SESSION["cerror"] : '' ?>" required id="category">
                </div>
                <?php
                    if (isset($_SESSION["cerror"])) {
                        if ($_SESSION["cerror"] == "category") {
                            echo displayError($_SESSION["cerror"]);
                        } else {
                            echo displayError("name");
                        }
                        unset($_SESSION["cerror"]);
                    }
                    if (isset($_SESSION["cdone"])) {
                        echo displayDone($_SESSION["cdone"]);
                        unset($_SESSION["cdone"]);
                    }
                ?>
            </div>
            <button class="bg-gray-500 w-4/6 ml-auto text-white hover:bg-white hover:text-gray-500 border-gray-500 border focus:outline-gray-500" type="submit" name="redirect" value="<?php echo isset($backUrl) ? $backUrl:'/'?>">Crear</button>
        </form>
    </div>
</main>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "./includes/footer.php";
?>