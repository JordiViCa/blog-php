<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
    $backUrl = $_SERVER['REQUEST_URI'];
?>
<main class="py-10">
    <div class="flex flex-wrap justify-around bg-gray-200 mx-auto w-4/5 px-20 py-14 rounded-md">
        <h1 class="text-4xl w-full">Ultimes entrades</h1>
        
        <?php
            $entries = getEntries("LIMIT 2");
            foreach ($entries as $key => $value) {
                echo "<article class='rounded-xl w-full shadow-md mt-4 bg-gray-100 p-5 flex flex-row'>";
                echo "<div class='w-1/5 h-40 mr-2 bg-center bg-contain bg-no-repeat' style='background-image: url(" . $value[7] . ");'></div>";
                echo "<div class='flex flex-col'>
                        <div>
                            <h1 class='text-3xl font-bold'>" . $value[3] . "</h1>
                            <p class='text-normal'>" . $value[4] . "</p>
                        </div>
                        <div>
                            <p class='text-gray-500'>categoria || " . $value[5] . "</p>
                            <button class='px-2 py-1 bg-gray-200 hover:bg-gray-300 text-sm font-bold'>Veure entrada</button>
                        </div>
                    </div>
                </article>
                ";
            }
        ?>
        <button class="px-6 py-2 text-lg bg-gray-300 border mt-10 rounded-lg font-bold hover:bg-gray-200 border-gray-300 shadow-lg transition-all">Veure totes les entrades</button>
    </div>
</main>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php";
?>