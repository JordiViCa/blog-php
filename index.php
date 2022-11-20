<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
    $backUrl = $_SERVER['REQUEST_URI'];
?>
<main class="py-10 min-h-[70vh]">
    <div class="flex flex-wrap justify-around bg-gray-200 mx-auto w-4/5 px-10 sm:px-20 py-14 rounded-md">
        <h1 class="text-4xl w-full">Ultimes entrades</h1>
        
        <?php
            // Display last entries
            $entries = getEntries("LIMIT 2");
            if (count($entries) == 0) {
                echo "<article class='rounded-xl w-full shadow-md mt-4 bg-gray-100 p-5 flex flex-row'><p class='my-4 mx-auto font-bold text-2xl'>No hi han entrades</p></article>";
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
                                <a href='/" . str_without_accents(strtolower(getBlogName($value[0]))) . "/entrada?e=" . $value[0] . "' class='px-2 py-1 bg-gray-200 hover:bg-gray-300 text-sm font-bold'>Veure entrada</a>
                            </div>
                        </div>
                    </article>
                    ";
                }
            }
        ?>
    </div>
</main>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php";
?>