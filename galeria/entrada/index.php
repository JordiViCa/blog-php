<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
    $backUrl = $_SERVER['REQUEST_URI'];
    # Get entry ( Use all entries in related entries )
    $entries = getGaleria();
    # Filter entry
    $entry = array_filter($entries, function ($k) {
        return $k[0] == $_GET["e"];
    });
    $entry = $entry[array_keys($entry)[0]];
    # Get and build categories
    $categoriesArr = getEntryCategories($entry[0]);
    $arr = [];
    foreach ($categoriesArr as $keyc => $valuec) {
        $arr = array_merge($arr, $valuec);
    }
    $categories = join(" #", $arr);
    $categories = "#".$categories;
?>
<main class="py-10">
    <div class="flex flex-row justify-around bg-gray-200 mx-auto w-4/5 px-20 py-14 rounded-md">
        <div class="flex flex-col w-7/12 rounded-md">
            <article class="rounded-xl shadow-md mt-4 bg-gray-100 p-5 flex flex-col">
                <h1 class="text-6xl font-thin"><?php echo $entry[3] ?></h1>
                <p class="mt-5 text-gray-500"><?php echo $categories ?> || <?php echo $entry[5] ?></p>
                <?php
                    # If image display image
                    if ($entry[7] != "") {
                        echo '
                        <div class="mr-auto flex flex-col w-full">
                            <img src="' . $entry[7] . '" alt="Image" class="m-10 shadow-2xl rounded-sm aspect-auto max-h-[50vh] mx-auto">
                        </div>';
                    }
                ?>
                <div class="flex flex-col">
                    <div>
                        <p class="text-normal"><?php echo nl2br($entry[4]) ?></p>
                    </div>
                </div>
            </article>
        </div>
        <div class="rounded-xl shadow-md mt-4 bg-gray-100 p-5 flex flex-col w-3/12 overflow-hidden">
            <h1 class="text-4xl font-thin">Articles relacionats</h1>
            <?php
                # Search related entries
                $i = 0;
                foreach ($entries as $key => $value) {
                    if ($entry[0] != $value[0] && $i < 3) {
                        $i++;
                        $arr = [];
                        foreach ($categoriesArr as $keyc => $valuec) {
                            $arr = array_merge($arr, $valuec);
                        }
                        $categories = join(" - ", $arr);
                        echo "<article class='rounded-xl w-full shadow-md mt-4 bg-gray-100 p-5 flex flex-row'>";
                        echo "<div class='flex flex-col w-full sm:w-3/5 lg:w-4/5'>
                                <div>
                                    <h1 class='text-3xl font-bold break-words'>" . $value[3] . "</h1>
                                    <p class='text-norma break-words'>" . substr_replace($value[4], "...", 100) . "</p>
                                </div>
                                <div>
                                    <p class='text-gray-500'>" . $categories . " || " . $value[5] . "</p>
                                    <a href='/" . str_without_accents(strtolower(getBlogName($value[0]))) . "/entrada?e=" . $value[0] . "' class='px-2 py-1 bg-gray-200 hover:bg-gray-300 text-sm font-bold'>Veure entrada</a>
                                </div>
                            </div>
                        </article>
                        ";
                    }
                }
            ?>
        </div>
</div>
    </div>
</main>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "./includes/footer.php";
?>