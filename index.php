<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
    $backUrl = $_SERVER['REQUEST_URI'];
?>
<main class="py-10">
    <div class="flex flex-wrap justify-around bg-slate-200 mx-auto w-4/5 px-20 py-14 rounded-md">
        <h1 class="text-4xl w-full">Ultimes entrades</h1>
        <article class="rounded-xl shadow-md mt-4 bg-slate-100 p-5 flex flex-row">
            <img src="\assets\img\post.png" alt="Image" class="mr-2 w-1/5 aspect-auto">
            <div class="flex flex-col">
                <div>
                    <h1 class="text-3xl font-bold">Titol</h1>
                    <p class="text-normal">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magnam, doloribus excepturi enim recusandae laborum soluta quas tempora dolores, numquam officiis et...</p>
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
                    <p class="text-normal">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magnam, doloribus excepturi enim recusandae laborum soluta quas tempora dolores, numquam officiis et...</p>
                </div>
                <div>
                    <p class="text-gray-500">categoria || 11-11-2002</p>
                    <button class="px-2 py-1 bg-slate-200 hover:bg-slate-300 text-sm font-bold">Veure entrada</button>
                </div>
            </div>
        </article>
        <button class="px-6 py-2 text-lg bg-slate-300 border mt-10 rounded-lg font-bold hover:bg-slate-200 border-slate-300 shadow-lg transition-all">Veure totes les entrades</button>
    </div>
</main>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php";
?>