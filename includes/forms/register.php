<!-- Popup register -->
<div class="max-w-full fixed w-[100vw] h-screen top-0 left-0 flex backdrop-blur-md transition-all <?php if (isset($errors) || isset($remailexistent)) { echo 'opacity-100 z-10'; } else { echo 'opacity-0 -z-10'; } ?>" style="background-color: rgba(0, 0, 0, 0.3);transition-duration: 300ms;" id="registerComponent">
    <div class="shadow-lg bg-gray-100 md:w-1/2 xl:w-1/3 mx-auto my-auto blur-none">
        <button class="absolute top-2 right-3" onclick="toggleRegister()"><svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 my-auto" viewBox="0 0 512 512"><title>Close</title><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M368 368L144 144M368 144L144 368"/></svg></button>
        <h1 class="text-6xl font-thin mb-10 border-b border-gray-400 pb-4 pt-4 px-20">Register</h1>
        <form class="px-20 border-b border-gray-400 flex flex-col pb-10" action="/validate/register.php" method="post">
            <div class="flex flex-col mb-4">
                <div class="flex flex-row">
                    <label class="w-2/6 text-right pr-4 text-lg" for="rname">Nom</label>
                    <input class="w-4/6 border-b border-gray-600 h-8 text-lg focus:outline-gray-500" type="text" name="rname" required id="rname" <?php if (isset($_SESSION["rname"])) { echo "value='" . $_SESSION['rname'] . "'";} ?>>
                </div>
                <?php
                    if (isset($errors) && in_array("name",$errors)) {
                        echo displayError("name");
                    }
                    if (isset($_SESSION["rname"])) {
                        unset($_SESSION["rname"]);
                    }
                ?>
            </div>
            <div class="flex flex-col mb-4">
                <div class="flex flex-row">
                    <label class="w-2/6 text-right pr-4 text-lg" for="rsurname">Cognom</label>
                    <input class="w-4/6 border-b border-gray-600 h-8 text-lg focus:outline-gray-500" type="text" name="rsurname" required id="rsurname" <?php if (isset($_SESSION["rsurname"])) { echo "value='" . $_SESSION['rsurname'] . "'";} ?>>
                </div>
                <?php
                    if (isset($errors) && in_array("surname",$errors)) {
                        echo displayError("surname");
                    }
                    if (isset($_SESSION["rsurname"])) {
                        unset($_SESSION["rsurname"]);
                    }
                ?>
            </div>
            <div class="flex flex-col mb-4">
                <div class="flex flex-row">
                    <label class="w-2/6 text-right pr-4 text-lg" for="remail">Email</label>
                    <input class="w-4/6 border-b border-gray-600 h-8 text-lg focus:outline-gray-500" type="text" name="remail" required id="remail" <?php if (isset($_SESSION["remail"])) { echo "value='" . $_SESSION['remail'] . "'";} ?>>
                </div>
                <?php
                    if (isset($errors) && in_array("email",$errors)) {
                        echo displayError("email");
                    }
                    if (isset($_SESSION["remailexistent"])) {
                        echo displayError("remailexistent");
                        unset($_SESSION["remailexistent"]);
                    }
                    if (isset($_SESSION["remail"])) {
                        unset($_SESSION["remail"]);
                    }
                ?>
            </div>
            <div class="flex flex-col mb-4">
                <div class="flex flex-row">
                    <label class="w-2/6 text-right pr-4 text-lg" for="rpass">Contrasenya</label>
                    <input class="w-4/6 border-b border-gray-600 h-8 text-lg focus:outline-gray-500" type="password" name="rpass" required id="rpass">
                </div>
                <?php
                    if (isset($errors) && in_array("password",$errors)) {
                        echo displayError("password");
                    }
                ?>
            </div>
            <div class="flex flex-row">
                <div class="ml-auto w-4/6 text-lg">
                    <input class=" checked:accent-gray-500 focus:outline-gray-500" type="checkbox" name="rremember" id="rremember">
                    <label class="w-2/6 text-right pr-4 text-lg" for="rremember">Recordem</label>
                </div>
            </div>
            <button class="bg-gray-500 w-4/6 ml-auto text-white hover:bg-white hover:text-gray-500 border-gray-500 border focus:outline-gray-500" type="submit" name="redirect" value="<?php echo isset($backUrl) ? $backUrl:'/'?>">    Register</button>
        </form>
        <div class="flex py-3 flex-row justify-between">
            <p class="ml-auto my-auto">Ja tens un compte?</p>
            <a class="mr-auto border border-gray-500 rounded-sm p-2 my-auto hover:bg-gray-500 hover:text-white transition-all ml-5" href="">Iniciar sessio</a>
        </div>
    </div>
    <script>
        // Function to toggle register popup
        function toggleRegister() {
            document.body.style.overflow = "";
            let register = document.getElementById("registerComponent");
            if(register.classList.contains("opacity-0")) {
                register.classList.remove("opacity-0");
                register.classList.add("opacity-100");
                register.classList.remove("-z-10");
                register.classList.add("z-10");
                document.body.style.overflow = "hidden";
            } else {
                register.classList.remove("opacity-100");
                register.classList.add("opacity-0");
                register.classList.remove("z-10");
                register.classList.add("-z-10");
            }
        }
        // Add event listener to registerComponent
        document.getElementById("registerComponent").addEventListener("click", function(event) {
            if (event.target.id == "registerComponent") {
                toggleRegister();
            }
        });
    </script>
</div>