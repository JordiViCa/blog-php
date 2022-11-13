<div class="max-w-full fixed w-[100vw] h-screen top-0 left-0 flex backdrop-blur-md transition-all  <?php if (isset($_SESSION["lError"])) { echo 'opacity-100 z-10'; } else { echo 'opacity-0 -z-10'; } ?>" style="background-color: rgba(0, 0, 0, 0.3);transition-duration: 300ms;" id="loginComponent">
    <div class="shadow-lg bg-gray-100 md:w-1/2 xl:w-1/3 mx-auto my-auto blur-none">
        <button class="absolute top-2 right-3" onclick="toggleLogin()"><svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 my-auto" viewBox="0 0 512 512"><title>Close</title><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M368 368L144 144M368 144L144 368"/></svg></button>
        <h1 class="text-6xl font-thin mb-10 border-b border-gray-400 pb-4 pt-4 px-20">Login</h1>
        <form class="px-20 border-b border-gray-400 flex flex-col pb-10" action="/validate/login.php" method="post">
            <div class="flex flex-col mb-4">
                <div class="flex flex-row">
                    <label class="w-2/6 text-right pr-4 text-lg" for="lemail">Email</label>
                    <input class="w-4/6 border-b border-gray-600 h-8 text-lg focus:outline-gray-500" type="email" name="lemail" id="lemail" <?php if (isset($_SESSION["lError"])) { echo 'value="' . $_SESSION["lError"] . '"'; } ?>>
                </div>
            </div>
            <div class="flex flex-col mb-4">
                <div class="flex flex-row">
                    <label class="w-2/6 text-right pr-4 text-lg" for="lpassword">Contrasenya</label>
                    <input class="w-4/6 border-b border-gray-600 h-8 text-lg focus:outline-gray-500" type="password" name="lpassword" id="lpassword">
                </div>
                <?php
                    if (isset($_SESSION["lError"])) {
                        echo displayError("lError");
                        echo displayError("lError","No tens un compte? <a>Registret ara!</a>");
                        unset($_SESSION["lError"]);
                    }
                ?>
            </div>
            <div class="flex flex-row">
                <div class="ml-auto w-4/6 text-lg">
                    <input class=" checked:accent-gray-500 focus:outline-gray-500" type="checkbox" name="lremember" id="lremember" value="remember">
                    <label class="w-2/6 text-right pr-4 text-lg" for="lremember">Recordem</label>
                </div>
            </div>
            <button class="bg-gray-500 w-4/6 ml-auto text-white hover:bg-white hover:text-gray-500 border-gray-500 border focus:outline-gray-500" type="submit" name="redirect" value="<?php echo isset($backUrl) ? $backUrl:'/' ?>">Iniciar sessio</button>
        </form>
        <div class="flex py-3 flex-row justify-between">
            <a class="mx-5 my-auto" href="">Has perdut la contrasenya?</a>
            <a class="mx-5 border border-gray-500 rounded-sm p-2 my-auto hover:bg-gray-500 hover:text-white transition-all" href="">Registrarse</a>
        </div>
    </div>
    <script>
        function toggleLogin() {
            let login = document.getElementById("loginComponent");
            document.body.style.overflow = "";
            if(login.classList.contains("opacity-0")) {
                login.classList.remove("opacity-0");
                login.classList.add("opacity-100");
                login.classList.remove("-z-10");
                login.classList.add("z-10");
                document.body.style.overflow = "hidden";
            } else {
                login.classList.remove("opacity-100");
                login.classList.add("opacity-0");
                login.classList.remove("z-10");
                login.classList.add("-z-10");
            }
        }
        document.getElementById("loginComponent").addEventListener("click", function(event) {
            console.log(event)
            if (event.target.id == "loginComponent") {
                toggleLogin();
            }
        });
    </script>
</div>