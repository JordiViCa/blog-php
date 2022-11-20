<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
    $backUrl = $_SERVER['REQUEST_URI'];
    $actualUser = getUser();
    # Get actual entry
    if (isset($_GET["e"])) {
        $entry = getEntry($_GET["e"]);
        if ($actualUser["id"] != $entry[1]) {
            header("Location: /");
        }
    } else {
        header("Location: /");
    }
?>
<main class="py-10 flex flex-row justify-arround">
    <div class="flex flex-col bg-gray-200 min-w-[600px] mx-auto w-auto px-20 py-14 rounded-md shadow-lg">
        <h1 class="text-4xl font-thin">Modificar entrada</h1>
        <form class="mt-10 flex flex-col" action="/validate/modifyEntry.php" enctype="multipart/form-data" method="post">
            <input class="invisible absolute -z-20" type="text" name="e" id="e" value="<?php echo $_GET["e"] ?>">
            <div class="flex flex-col mb-4">
                <div class="flex flex-col">
                    <label class="text-xl" for="title">Titol</label>
                    <input class="w-full border-b border-gray-600 h-8 text-lg focus:outline-gray-500" type="text" name="title" value="<?php echo $entry[3] ?>" required id="title">
                </div>
                <?php
                    # Display text success/error
                    if (isset($_SESSION["enamerror"])) {
                        unset($_SESSION["enamerror"]);
                    }
                    if (isset($_SESSION["erroret"])) {
                        echo displayError($_SESSION["erroret"]);
                        unset($_SESSION["erroret"]);
                    }
                ?>
                <div class="flex flex-col">
                    <label class="text-xl" for="description">Contingut</label>
                    <textarea class="w-full min-h-[100px] border-b border-gray-600 h-8 text-lg focus:outline-gray-500" type="text" name="description" required id="description"><?php echo $entry[4] ?></textarea>
                </div>
                <?php
                    # Display text success/error
                    if (isset($_SESSION["edscerror"])) {
                        unset($_SESSION["edscerror"]);
                    }
                    if (isset($_SESSION["errored"])) {
                        echo displayError($_SESSION["errored"]);
                        unset($_SESSION["errored"]);
                    }
                ?>
                <div class="flex flex-col">
                    <label class="text-xl" for="file">Imatge - <?php echo $entry[6] ?></label>
                    <input class="w-full border-b border-gray-600 h-8 text-lg focus:outline-gray-500" type="file" name="file" id="file">
                </div>
                <?php
                    # Display text success/error
                    if (isset($_SESSION["erroreu"])) {
                        echo displayError($_SESSION["erroreu"]);
                        unset($_SESSION["erroreu"]);
                    }
                ?>
                <div class="flex flex-col relative my-5">
                    <select name="blog" id="blog" class="px-8 inline-flex items-center py-2 bg-gray-200 active:bg-gray-400  border-gray-400 border rounded-md">
                        <ul class="text-sm text-gray-700" aria-labelledby="dropdownBlogButton">
                            <?php 
                                # Get and display blogs to select
                                $rows = getBlogs();
                                foreach ($rows as $row) {
                                    $text = "";
                                    if ($entry[2] == $row[0]) {
                                        $text = 'selected="selected"';
                                    }
                                    echo "<option " . $text . " value='" . strtolower($row[0]) . "'/> " . $row[1] . "</option>";
                                    if (isset($_SESSION[strtolower($row[0])])) {
                                        unset($_SESSION[strtolower($row[0])]);
                                    }
                                }
                            ?>
                        </ul>
                    </select>
                    <?php
                        # Display text success/error
                        if (isset($_SESSION["emptyBlog"])) {
                            echo displayDone($_SESSION["emptyBlog"]);
                            unset($_SESSION["emptyBlog"]);
                        }
                    ?>
                </div>
                <div class="flex flex-col relative my-5">
                    <button id="dropdownEntryButton" data-dropdown-toggle="dropDownEntry" class="px-8 inline-flex items-center py-2 bg-gray-200 active:bg-gray-400  border-gray-400 border rounded-md" type="button">Entrades<svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                    <?php
                        # Display text success/error
                        if (isset($_SESSION["errorec"])) {
                            echo displayError($_SESSION["errorec"]);
                            unset($_SESSION["errorec"]);
                        }
                    ?>
                    <div id="dropDownEntry" class="hidden z-10 bg-gray-300 p-5 rounded shadow-xl absolute right-0" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">
                        <ul class="text-sm text-gray-700" aria-labelledby="dropdownEntryButton">
                            <?php 
                                # Get and display categories to dropdown
                                $rows = getCategories();
                                $arrCategories = [];
                                foreach (getEntryCategories($entry[0]) as $value) {
                                    array_push($arrCategories,strtolower($value[0]));
                                }
                                foreach ($rows as $row) {
                                    $text = "";
                                    if (in_array(strtolower($row[0]), $arrCategories)) {
                                        $text = "checked";
                                    }
                                    echo "<li class='text-lg w-full'><input name='" . strtolower($row[0]) . "' type='checkbox'" . $text . " value='" . strtolower($row[0]) . "'/> " . $row[0] . "</li>";
                                    if (isset($_SESSION[strtolower($row[0])])) {
                                        unset($_SESSION[strtolower($row[0])]);
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
                # Display text success/error
                if (isset($_SESSION["eedone"])) {
                    echo displayDone($_SESSION["eedone"]);
                    unset($_SESSION["eedone"]);
                }
            ?>
            <button class="bg-gray-500 w-4/6 ml-auto text-white hover:bg-white hover:text-gray-500 border-gray-500 border focus:outline-gray-500" type="submit" name="redirect" value="<?php echo isset($backUrl) ? $backUrl:'/'?>">Modificar</button>
        </form>
    </div>
</main>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "./includes/footer.php";
?>