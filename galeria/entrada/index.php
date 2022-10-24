<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
    $backUrl = $_SERVER['REQUEST_URI'];
?>
<main class="py-10">
    <div class="flex flex-row justify-around bg-slate-200 mx-auto w-4/5 px-20 py-14 rounded-md">
        <div class="flex flex-col w-7/12 rounded-md">
            <article class="rounded-xl shadow-md mt-4 bg-slate-100 p-5 flex flex-col">
                <h1 class="text-8xl font-thin">Titol</h1>
                <p>#Image #Categoria #X #Y</p>
                <div class="mr-auto">
                    <img src="\assets\img\post.png" alt="Image" class="w-full mt-10 aspect-auto">
                    <p class="text-gray-500 mb-10">categoria || 11-11-2002</p>
                </div>
                <div class="flex flex-col">
                    <div>
                        <p class="text-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ratione iure consequatur reprehenderit porro, praesentium dolorem dolores explicabo assumenda? Debitis fugit quaerat fuga dignissimos ab cum corporis doloribus dolorem illum?</p>
                    </div>
                </div>
            </article>
            <article class="rounded-xl shadow-md mt-4 bg-slate-100 p-5 flex flex-col">
                <h1 class="text-4xl font-thin">Comentaris</h1>
            </article>
        </div>
        <div class="rounded-xl shadow-md mt-4 bg-slate-100 p-5 flex flex-col w-3/12">
            <h1 class="text-4xl font-thin">Articles relacionats</h1>
            <article class="rounded-xl shadow-md mt-4 bg-slate-50 p-5 flex flex-row">
                <div class="flex flex-col">
                    <div>
                        <h1 class="text-3xl font-bold">Titol</h1>
                        <p class="text-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit...</p>
                    </div>
                    <div>
                        <p class="text-gray-500">categoria || 11-11-2002</p>
                        <button class="px-2 py-1 bg-slate-200 hover:bg-slate-300 text-sm font-bold">Veure entrada</button>
                    </div>
                </div>
            </article>
</div>
    </div>
</main>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "./includes/footer.php";
?>