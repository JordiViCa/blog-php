<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
    $backUrl = $_SERVER['REQUEST_URI'];
?>
<main class="py-10">
    <div class="flex flex-wrap justify-around bg-slate-200 mx-auto w-4/5 px-20 py-14 rounded-md">
        <h1 class="text-4xl w-full">Entrades</h1>
        <form action="" method="get" class="w-full">
            <div class="flex flex-col w-2/12 mt-4 mb-2">
                <select name="c" id="c" onchange="this.form.submit()">
                    <?php
                        $default = "";
                        if (isset($_GET["c"])) {
                            $default = $_GET["c"];
                        }
                        if ($default == "") {
                            echo "<option selected value=''>Selecciona una categoria</option>";
                        } else {
                            echo "<option value=''>Selecciona una categoria</option>";
                        }
                        include("../includes/connect.php");
                        $sql = "SELECT name FROM categories";
                        $select = $conn->query($sql);
                        $conn->close();
                        $rows = mysqli_fetch_all ($select, MYSQLI_ASSOC);
                        foreach ($rows as $key => $value) {
                            echo "<option value='" . strtolower($value["name"]) . "'";
                            if ($default == strtolower($value["name"])) { echo "selected >" . $value["name"] .  "</option>"; } else { echo ">" . $value["name"] .  "</option>"; }
                        }
                    ?>
                </select>
            </div>
        </form>
        <article class="rounded-xl shadow-md mt-4 bg-slate-100 p-5 flex flex-row">
            <img src="\assets\img\post.png" alt="Image" class="mr-2 w-1/5 aspect-auto">
            <div class="flex flex-col">
                <div>
                    <h1 class="text-3xl font-bold">Titol</h1>
                    <p class="text-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum?</p>
                </div>
                <div>
                    <p class="text-gray-500">categoria || 11-11-2002</p>
                    <button class="px-2 py-1 bg-slate-200 hover:bg-slate-300 text-sm font-bold">Veure entrada</button>
                </div>
            </div>
        </article>
        <article class="rounded-xl shadow-md mt-4 bg-slate-100 p-5 flex flex-row">
            <img src="\assets\img\post.png" alt="Image" class="mr-2 w-1/5 aspect-auto">
            <div class="flex flex-col">
                <div>
                    <h1 class="text-3xl font-bold">Titol</h1>
                    <p class="text-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum?</p>
                </div>
                <div>
                    <p class="text-gray-500">categoria || 11-11-2002</p>
                    <button class="px-2 py-1 bg-slate-200 hover:bg-slate-300 text-sm font-bold">Veure entrada</button>
                </div>
            </div>
        </article>
        <article class="rounded-xl shadow-md mt-4 bg-slate-100 p-5 flex flex-row">
            <img src="\assets\img\post.png" alt="Image" class="mr-2 w-1/5 aspect-auto">
            <div class="flex flex-col">
                <div>
                    <h1 class="text-3xl font-bold">Titol</h1>
                    <p class="text-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum?</p>
                </div>
                <div>
                    <p class="text-gray-500">categoria || 11-11-2002</p>
                    <button class="px-2 py-1 bg-slate-200 hover:bg-slate-300 text-sm font-bold">Veure entrada</button>
                </div>
            </div>
        </article>
        <article class="rounded-xl shadow-md mt-4 bg-slate-100 p-5 flex flex-row">
            <img src="\assets\img\post.png" alt="Image" class="mr-2 w-1/5 aspect-auto">
            <div class="flex flex-col">
                <div>
                    <h1 class="text-3xl font-bold">Titol</h1>
                    <p class="text-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum?</p>
                </div>
                <div>
                    <p class="text-gray-500">categoria || 11-11-2002</p>
                    <button class="px-2 py-1 bg-slate-200 hover:bg-slate-300 text-sm font-bold">Veure entrada</button>
                </div>
            </div>
        </article>
        <article class="rounded-xl shadow-md mt-4 bg-slate-100 p-5 flex flex-row">
            <img src="\assets\img\post.png" alt="Image" class="mr-2 w-1/5 aspect-auto">
            <div class="flex flex-col">
                <div>
                    <h1 class="text-3xl font-bold">Titol</h1>
                    <p class="text-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum?</p>
                </div>
                <div>
                    <p class="text-gray-500">categoria || 11-11-2002</p>
                    <button class="px-2 py-1 bg-slate-200 hover:bg-slate-300 text-sm font-bold">Veure entrada</button>
                </div>
            </div>
        </article>
        <article class="rounded-xl shadow-md mt-4 bg-slate-100 p-5 flex flex-row">
            <img src="\assets\img\post.png" alt="Image" class="mr-2 w-1/5 aspect-auto">
            <div class="flex flex-col">
                <div>
                    <h1 class="text-3xl font-bold">Titol</h1>
                    <p class="text-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum?</p>
                </div>
                <div>
                    <p class="text-gray-500">categoria || 11-11-2002</p>
                    <button class="px-2 py-1 bg-slate-200 hover:bg-slate-300 text-sm font-bold">Veure entrada</button>
                </div>
            </div>
        </article>
        <article class="rounded-xl shadow-md mt-4 bg-slate-100 p-5 flex flex-row">
            <img src="\assets\img\post.png" alt="Image" class="mr-2 w-1/5 aspect-auto">
            <div class="flex flex-col">
                <div>
                    <h1 class="text-3xl font-bold">Titol</h1>
                    <p class="text-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum?</p>
                </div>
                <div>
                    <p class="text-gray-500">categoria || 11-11-2002</p>
                    <button class="px-2 py-1 bg-slate-200 hover:bg-slate-300 text-sm font-bold">Veure entrada</button>
                </div>
            </div>
        </article>
        <article class="rounded-xl shadow-md mt-4 bg-slate-100 p-5 flex flex-row">
            <img src="\assets\img\post.png" alt="Image" class="mr-2 w-1/5 aspect-auto">
            <div class="flex flex-col">
                <div>
                    <h1 class="text-3xl font-bold">Titol</h1>
                    <p class="text-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum?</p>
                </div>
                <div>
                    <p class="text-gray-500">categoria || 11-11-2002</p>
                    <button class="px-2 py-1 bg-slate-200 hover:bg-slate-300 text-sm font-bold">Veure entrada</button>
                </div>
            </div>
        </article>
        <article class="rounded-xl shadow-md mt-4 bg-slate-100 p-5 flex flex-row">
            <img src="\assets\img\post.png" alt="Image" class="mr-2 w-1/5 aspect-auto">
            <div class="flex flex-col">
                <div>
                    <h1 class="text-3xl font-bold">Titol</h1>
                    <p class="text-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum?</p>
                </div>
                <div>
                    <p class="text-gray-500">categoria || 11-11-2002</p>
                    <button class="px-2 py-1 bg-slate-200 hover:bg-slate-300 text-sm font-bold">Veure entrada</button>
                </div>
            </div>
        </article>
        <article class="rounded-xl shadow-md mt-4 bg-slate-100 p-5 flex flex-row">
            <img src="\assets\img\post.png" alt="Image" class="mr-2 w-1/5 aspect-auto">
            <div class="flex flex-col">
                <div>
                    <h1 class="text-3xl font-bold">Titol</h1>
                    <p class="text-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum?</p>
                </div>
                <div>
                    <p class="text-gray-500">categoria || 11-11-2002</p>
                    <button class="px-2 py-1 bg-slate-200 hover:bg-slate-300 text-sm font-bold">Veure entrada</button>
                </div>
            </div>
        </article>
        <p>Implementar sistema paginacio amb $_GET < 0 ></p>
    </div>
</main>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "./includes/footer.php";
?>