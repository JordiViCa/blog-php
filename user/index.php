<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
    $backUrl = $_SERVER['REQUEST_URI'];
    $actualUser = getUser();
?>
    <main class="py-10 flex flex-col-reverse sm:flex-row flex-wrap justify-arround">
        <div class="flex flex-wrap mb-10 justify-around bg-gray-200 mx-auto w-4/5 px-10 sm:px-20 py-14 rounded-md">
            <form class="flex mb-10 flex-col" action="/validate/changeCredentials.php" method="post">
                <h2 class="text-2xl font-thin mb-2">Modificar dades</h2>
                <div class="flex flex-col mb-4">
                    <div class="flex flex-row">
                        <label class="w-2/6 text-right pr-4 text-lg" for="cname">Nom</label>
                        <input class="w-4/6 border-b border-gray-600 h-8 text-lg focus:outline-gray-500" type="text" name="cname" required id="cname" <?php echo "value='" . $actualUser['name'] . "'"; ?>>
                    </div>
                    <?php
                        # Display text success/error
                        if (isset($_SESSION["cname"])) {
                            echo displayError($_SESSION["cname"]);
                            unset($_SESSION["cname"]);
                        }
                    ?>
                </div>
                <div class="flex flex-col mb-4">
                    <div class="flex flex-row">
                        <label class="w-2/6 text-right pr-4 text-lg" for="csurname">Cognom</label>
                        <input class="w-4/6 border-b border-gray-600 h-8 text-lg focus:outline-gray-500" type="text" name="csurname" required id="csurname" <?php echo "value='" . $actualUser['surname'] . "'"; ?>>
                    </div>
                    <?php
                        # Display text success/error
                        if (isset($_SESSION["csurname"])) {
                            echo displayError($_SESSION["csurname"]);
                            unset($_SESSION["csurname"]);
                        }
                    ?>
                    <?php
                        # Display text success/error
                        if (isset($_SESSION["ccorrect"])) {
                            echo displayDone($_SESSION["ccorrect"]);
                            unset($_SESSION["ccorrect"]);
                        }
                    ?>
                </div>
                <button class="bg-gray-500 w-4/6 ml-auto text-white hover:bg-white hover:text-gray-500 border-gray-500 border focus:outline-gray-500" type="submit">Modificar</button>
            </form>     
            <form class="flex flex-col" action="/validate/changePassword.php" method="post">
                <h2 class="text-2xl font-thin mb-2">Cambiar contrasenya</h2>
                <div class="flex flex-col mb-4">
                    <div class="flex flex-row">
                        <label class="w-3/6 text-right pr-4 text-lg" for="cpassword">Contrasenya actual</label>
                        <input class="w-3/6 border-b border-gray-600 h-8 text-lg focus:outline-gray-500" type="password" name="cpassword" required id="cpassword">
                    </div>
                    <?php
                        # Display text success/error
                        if (isset($_POST["cpassword"])) {
                            echo displayError($_POST["cpassword"]);
                            unset($_POST["cpassword"]);
                        }
                    ?>
                </div>
                <div class="flex flex-col mb-4">
                    <div class="flex flex-row">
                        <label class="w-3/6 text-right pr-4 text-lg" for="cnpassword">Nova contrasenya</label>
                        <input class="w-3/6 border-b border-gray-600 h-8 text-lg focus:outline-gray-500" type="password" name="cnpassword" required id="cnpassword">
                    </div>
                    <?php
                        # Display text success/error
                        if (isset($_SESSION["cnpassword"])) {
                            echo displayError($_SESSION["cnpassword"]);
                            unset($_SESSION["cnpassword"]);
                        }
                    ?>
                </div>
                <div class="flex flex-col mb-4">
                    <div class="flex flex-row">
                        <label class="w-3/6 text-right pr-4 text-lg" for="cnrpassword">Repetir contrasenya</label>
                        <input class="w-3/6 border-b border-gray-600 h-8 text-lg focus:outline-gray-500" type="password" name="cnrpassword" required id="cnrpassword">
                    </div>
                    <?php
                        # Display text success/error
                        if (isset($_SESSION["cnrpassword"])) {
                            echo displayError($_SESSION["cnrpassword"]);
                            unset($_SESSION["cnrpassword"]);
                        }
                    ?>
                    <?php
                        # Display text success/error
                        if (isset($_SESSION["correct"])) {
                            echo displayDone($_SESSION["correct"]);
                            unset($_SESSION["correct"]);
                        }
                    ?>
                </div>
                <button class="bg-gray-500 w-4/6 ml-auto text-white hover:bg-white hover:text-gray-500 border-gray-500 border focus:outline-gray-500" type="submit">Modificar</button>
            </form>
        </div>
        <div class="flex flex-wrap mb-10 bg-gray-200 mx-auto w-4/5 px-10 sm:px-20 py-14 rounded-md">
            <h1 class="text-4xl font-thin w-full">Entrades</h1>
            <?php
                # Display text success/error
                if (isset($_SESSION["dentrys"])) {
                    echo displayDone($_SESSION["dentrys"]);
                    unset($_SESSION["dentrys"]);
                }
            ?>
            <?php
                # Display text success/error
                if (isset($_SESSION["dentryf"])) {
                    echo displayError($_SESSION["dentryf"]);
                    unset($_SESSION["dentryf"]);
                }
            ?>
            <form action="" method="get" class="w-full">
                <div class="flex flex-row justify-between w-full flex-wrap  md:flex-nowrap mt-4 mb-2">
                    <div class="flex w-full md:w-auto mb-2 md:mb-0">
                        <input class="w-2/3 px-2 rounded-md" type="text" name="t" id="t" value="<?php $defaultTitle = $_GET["t"] ?? ""; echo $defaultTitle; ?>" placeholder="Filtrar per titol">
                        <button class="w-1/3 bg-gray-300 ml-1 rounded-md hover:bg-gray-100 transition-all border border-gray-300" onclick="this.form.submit()">Filtrar</button>
                    </div>
                    <select class='px-2 rounded-md max-w-full' name="c" id="c" onchange="this.form.submit()">
                        <?php
                            # Get and display categories
                            $defaultCategory = "";
                            if (isset($_GET["c"])) {
                                $defaultCategory = $_GET["c"];
                            }
                            if ($defaultCategory == "") {
                                echo "<option selected value=''>Selecciona una categoria</option><option value=''></option>";
                            } else {
                                echo "<option value=''>Selecciona una categoria</option><option value=''></option>";
                            }
                            $rows = getCategories();
                            foreach ($rows as $key => $value) {
                                echo "<option value='" . strtolower($value[1]) . "'";
                                if ($defaultCategory == strtolower($value[1])) { echo "selected >" . $value[0] .  "</option>"; } else { echo ">" . $value[0] .  "</option>"; }
                            }
                        ?>
                    </select>
                </div>
            </form>
            <?php
                # Get limit for pagination
                $limit = $_GET["p"] ?? "0";
                # Get entries with limit and params
                $entries = getUserEntries($actualUser["id"],"LIMIT " . $limit . ", 3",$defaultTitle,$defaultCategory);
                # Get total entries to make pagination
                $totalEntries = getUserEntries($actualUser["id"],"",$defaultTitle,$defaultCategory);
                $i = count($totalEntries) - $limit;
                # If empty don't display else show entries
                if (count($entries) == 0) {
                    echo "<article class='rounded-xl w-full shadow-md mt-4 mb-2 bg-gray-100 p-5 flex flex-row'><p class='my-4 mx-auto font-bold text-2xl'>No hi han entrades</p></article>";
                } else {
                    foreach ($entries as $key => $value) {
                        $categoriesArr = getEntryCategories($value[0]);
                        $arr = [];
                        foreach ($categoriesArr as $keyc => $valuec) {
                            $arr = array_merge($arr, $valuec);
                        }
                        $categories = join(" - ", $arr);
                        echo "<article class='rounded-xl w-full shadow-md mt-4 bg-gray-100 p-5 flex flex-row'>";
                        echo "<div class='hidden sm:block max-h-[160px] w-2/5 lg:w-1/5 h-auto mr-2 bg-center bg-cover bg-no-repeat' style='background-image: url(" . $value[7] . ");'></div>";
                        echo "<div class='flex flex-col w-full sm:w-3/5 lg:w-4/5'>
                                <div>
                                    <h1 class='text-3xl font-bold break-words'>" . $value[3] . "</h1>
                                    <p class='text-norma break-words'>" . substr_replace($value[4], "...", 100) . "</p>
                                </div>
                                <div>
                                    <p class='text-gray-500'>" . $categories . " || " . $value[5] . "</p>
                                    <div class='flex flex-col md:flex-row'>
                                        <a href='/" . str_without_accents(strtolower(getBlogName($value[0]))) . "/entrada?e=" . $value[0] . "' class='px-2 py-1 bg-gray-200 hover:bg-gray-300 text-sm font-bold'>Veure entrada</a>
                                        <a href='/user/entry/editar?e=" . $value[0] . "' class='px-2 py-1 bg-gray-200  md:mr-auto hover:bg-gray-300 text-sm font-bold'>Modificar entrada</a>
                                        <button onclick='deleteEntry(". $value[0] .")' class='md:ml-auto px-2 py-1 bg-red-500 hover:bg-red-6s00 text-sm font-bold'>Eliminar entrada</button>
                                    </div>
                                </div>
                            </div>
                        </article>
                        ";
                    }
                }
            ?>
            <form  action="" method="get" class="mt-2 font-medium text-lg w-full flex justify-around">
            <?php 
                # Pagination with disabled buttons
                if ($limit < 3) {
                    echo "<a disabled class='opacity-50 cursor-default'>  ANT </a>";
                } else {
                    $title =  $defaultTitle != "" ? "&t=" . $defaultTitle : "";
                    $category =  $defaultCategory != "" ? "&c=" . $defaultCategory : "";
                    echo "<a href='/user?p=" . $limit-3 . $title . $category . "'>  ANT </a>";
                }
                if ($i-3 <= 0) {
                    echo "<a disabled class='opacity-50 cursor-default'>  SEG </a>";
                } else {
                    $title =  $defaultTitle != "" ? "&t=" . $defaultTitle : "";
                    $category =  $defaultCategory != "" ? "&c=" . $defaultCategory : "";
                    echo "<a href='/user?p=" . $limit+3 . $title . $category . "'>  SEG </a>";
                }
            ?>
            </form>
        </div>
        <!-- Form for delete entries -->
        <form class="absolute invisible -z-50" action="/validate/deleteEntry.php" method="post" id="deleteEntry">
            <input value="" id="entryToDelete" name="entryToDelete">
            <input value="<?php echo $backUrl; ?>" id="redirect" name="redirect">
        </form>
        <script>
            // Function that ask for confirmation and deletes category with form trigger
            function deleteEntry(id) {
                if (confirm("Estas segur de eliminar l'entrada?")) {
                    document.getElementById("entryToDelete").value = id;
                    document.getElementById('deleteEntry').submit();
                } else {
                    console.log("Thing was not saved to the database.");
                }
            }
        </script>
    </main>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "./includes/footer.php";
?>