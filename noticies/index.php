<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
    $backUrl = $_SERVER['REQUEST_URI'];
?>
<main class="py-10 min-h-[70vh]">
    <div class="flex flex-wrap justify-around bg-gray-200 mx-auto w-4/5 px-10 sm:px-20 py-14 rounded-md">
        <h1 class="text-4xl w-full">Entrades</h1>
        <form action="" method="get" class="w-full">
            <div class="flex flex-row justify-between w-full flex-wrap  md:flex-nowrap mt-4 mb-2">
                <div class="flex w-full md:w-auto mb-2 md:mb-0">
                    <input class="w-2/3 px-2 rounded-md" type="text" name="t" id="t" value="<?php $defaultTitle = $_GET["t"] ?? ""; echo $defaultTitle; ?>" placeholder="Filtrar per titol">
                    <button class="w-1/3 bg-gray-300 ml-1 rounded-md hover:bg-gray-100 transition-all border border-gray-300" onclick="this.form.submit()">Filtrar</button>
                </div>
                <select class='px-2 rounded-md max-w-full' name="c" id="c" onchange="this.form.submit()">
                    <?php
                        # Build categories on select
                        # Check default
                        $defaultCategory = "";
                        if (isset($_GET["c"])) {
                            $defaultCategory = $_GET["c"];
                        }
                        if ($defaultCategory == "") {
                            echo "<option selected value=''>Selecciona una categoria</option>";
                        } else {
                            echo "<option value=''>Selecciona una categoria</option>";
                        }
                        # Print rows
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
            # get limit and build paginate paginate
            $limit = $_GET["p"] ?? "0";
            $entries = getNoticies("LIMIT " . $limit . ",5",$defaultTitle,$defaultCategory);
            $totalEntries = getNoticies("",$defaultTitle,$defaultCategory);
            $i = count($totalEntries) - $limit;
            # If empty don't display else show entries
            if (count($entries) == 0) {
                echo "<article class='rounded-xl w-full shadow-md mt-4 bg-gray-100 p-5 flex flex-row'><p class='my-4 mx-auto font-bold text-2xl'>No hi han entrades</p></article>";
            } else {
                foreach ($entries as $key => $value) {
                    # Build category text
                    $categoriesArr = getEntryCategories($value[0]);
                    $arr = [];
                    foreach ($categoriesArr as $keyc => $valuec) {
                        $arr = array_merge($arr, $valuec);
                    }
                    $categories = join(" - ", $arr);
                    echo "<article class='rounded-xl w-full shadow-md mt-4 bg-gray-100 p-5 flex flex-row'>";
                    echo "<div class='hidden max-h-[160px] sm:block w-2/5 lg:w-1/5 h-auto mr-2 bg-center bg-cover bg-no-repeat' style='background-image: url(" . $value[7] . ");'></div>";
                    echo "<div class='flex flex-col w-full sm:w-3/5 lg:w-4/5'>
                            <div>
                                <h1 class='text-3xl font-bold break-words'>" . $value[3] . "</h1>
                                <p class='text-norma break-words'>" . substr_replace($value[4], "...", 100) . "</p>
                            </div>
                            <div>
                                <p class='text-gray-500'>" . $categories . " || " . $value[5] . "</p>
                                <a href='entrada?e=" . $value[0] . "' class='px-2 py-1 bg-gray-200 hover:bg-gray-300 text-sm font-bold'>Veure entrada</a>
                            </div>
                        </div>
                    </article>
                    ";
                }
            }
        ?>
        <form  action="" method="get" class="mt-2 font-medium text-lg w-full flex justify-around">
            <?php 
                # form paginate, with disabled buttons
                if ($limit < 5) {
                    echo "<a disabled class='opacity-50 cursor-default'>  ANT </a>";
                } else {
                    $title =  $defaultTitle != "" ? "&t=" . $defaultTitle : "";
                    $category =  $defaultCategory != "" ? "&c=" . $defaultCategory : "";
                    echo "<a href='/noticies?p=" . $limit-5 . $title . $category . "'>  ANT </a>";
                }
                if ($i-5 <= 0) {
                    echo "<a disabled class='opacity-50 cursor-default'>  SEG </a>";
                } else {
                    $title =  $defaultTitle != "" ? "&t=" . $defaultTitle : "";
                    $category =  $defaultCategory != "" ? "&c=" . $defaultCategory : "";
                    echo "<a href='/noticies?p=" . $limit+5 . $title . $category . "'>  SEG </a>";
                }
            ?>
        </form>
    </div>
</main>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "./includes/footer.php";
?>