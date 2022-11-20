<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
    $backUrl = $_SERVER['REQUEST_URI'];
    # Check if user exists
    $actualUser = getUser();
?>
<main class="py-10 flex flex-row justify-arround md:flex-nowrap flex-wrap">
    <div class="flex flex-col bg-gray-200 mx-auto w-auto px-20 py-14 rounded-md shadow-lg mb-auto">
        <h1 class="text-4xl font-thin">Afegir categoria</h1>
        <form class="mt-10 flex flex-col" action="/validate/createCategory.php" method="post">
            <div class="flex flex-col mb-4">
                <div class="flex flex-col">
                    <label class="text-xl" for="category">Titol</label>
                    <input class="w-full border-b border-gray-600 h-8 text-lg focus:outline-gray-500" type="text" name="category" value="<?php echo isset($_SESSION["cerror"]) ? $_SESSION["cerror"] : '' ?>" required id="category">
                </div>
                <?php
                    # Display text success/error
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
    <div class="flex flex-col mx-2 my-4 md:m-0 bg-gray-200 md:mx-auto px-20 py-14 rounded-md shadow-lg w-full md:max-w-[50vw] lg:max-w-[60vw] xl:max-w-[70vw]">
        <h1 class="text-4xl font-thin mb-4">Categories</h1>
        <?php
            # Display text success/error
            if (isset($_SESSION["dcategorys"])) {
                echo displayDone($_SESSION["dcategorys"]);
                unset($_SESSION["dcategorys"]);
            }
            if (isset($_SESSION["dcategoryf"])) {
                echo displayError($_SESSION["dcategoryf"]);
                unset($_SESSION["dcategoryf"]);
            }
        ?>
        <div class="flex flex-row flex-wrap justify-center max-h-[50vh] overflow-y-auto">
            <?php 
                # Get limit
                $limit = $_GET["p"] ?? "0";
                # Get rows of categories
                $rows = getCategories("LIMIT " . $limit . ",12");
                # calc diff
                $i = count(getCategories()) - $limit;
                # If empty don't display, else show categories
                if (count($rows) == 0) {
                    echo "<article class='rounded-xl w-full shadow-md mt-4 bg-gray-100 p-5 flex flex-row mb-2'><p class='my-4 mx-auto font-bold text-2xl'>No hi han categories</p></article>";
                } else {
                    foreach ($rows as $row) {
                        echo "<div class=' bg-gray-100 rounded-md my-2 md:m-2 p-5 w-full md:w-[40%] lg:w-[30%] xl:w-[20%]'>
                            <h1 class=' font-medium text-xl mb-2 break-words'>" . $row[0] . "</h1>
                            <button onclick='deleteCategory(" . $row[1] . ")' class='px-2 py-1 bg-red-500 hover:bg-red-6s00 text-sm font-bold'>Eliminar</button>
                        </div>";
                    }
                }
            ?>
        </div>
        <form  action="" method="get" class="mt-2 font-medium text-lg w-full flex justify-around">
            <?php 
                # Pagination with disabled buttons
                if ($limit < 12) {
                    echo "<a disabled class='opacity-50 cursor-default'>  ANT </a>";
                } else {
                    echo "<a href='/user/category?p=" . $limit-12 . "'>  ANT </a>";
                }
                if ($i-12 <= 0) {
                    echo "<a disabled class='opacity-50 cursor-default'>  SEG </a>";
                } else {
                    echo "<a href='/user/category?p=" . $limit+12 . "'>  SEG </a>";
                }
            ?>
        </form>
    </div>
    <!-- Form for delete category -->
    <form class="absolute invisible -z-50" action="/validate/deleteCategory.php" method="post" id="deleteCategory">
        <input value="" id="categoryToDelete" name="categoryToDelete">
        <input value="<?php echo $backUrl; ?>" id="redirect" name="redirect">
    </form>
    <script>
        // Function that ask for confirmation and deletes category with form trigger
        function deleteCategory(id) {
            if (confirm("Estas segur de eliminar la categoria?")) {
                document.getElementById("categoryToDelete").value = id;
                document.getElementById('deleteCategory').submit();
            } else {
                console.log("Thing was not saved to the database.");
            }
        }
    </script>
</main>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "./includes/footer.php";
?>