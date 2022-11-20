<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
    $backUrl = $_SERVER['REQUEST_URI'];
?>
<main class="py-10 min-h-[70vh] flex">
    <div class="flex flex-wrap justify-around bg-gray-200 mx-auto px-10 sm:px-20 pt-14 pb-8 rounded-md">
        <h1 class="text-4xl w-full">Contacte</h1>
        <?php 
            # Display text success/error
            if (isset($_SESSION["dcontact"])) {
                echo displayDone($_SESSION["dcontact"]);
                unset($_SESSION["dcontact"]);
            }
        ?>
        
        <?php 
            # Display text success/error
            if (isset($_SESSION["econtact"])) {
                echo displayError($_SESSION["econtact"]);
                unset($_SESSION["econtact"]);
            }
        ?>
        <form action="/validate/contact.php" class="w-full" method="post">
            <div class="flex flex-col">
                <label for="name" class="text-xl">Nom</label>
                <input value="<?php echo isset($_SESSION["cname"]) ? $_SESSION["cname"] : '' ?>" required type="text" class="w-full border-b border-gray-600 h-8 text-lg focus:outline-gray-500" name="name" id="name">
                <?php
                    # Display text success/error
                    if (isset($_SESSION["cname"])) {
                        unset($_SESSION["cname"]);
                    }
                    if (isset($_SESSION["cnameerr"])) {
                        echo displayError($_SESSION["cnameerr"]);
                        unset($_SESSION["cnameerr"]);
                    }
                ?>
            </div>
            <div class="flex flex-col">
                <label for="surname" class="text-xl">Cognoms</label>
                <input value="<?php echo isset($_SESSION["csurname"]) ? $_SESSION["csurname"] : '' ?>" required type="text" class="w-full border-b border-gray-600 h-8 text-lg focus:outline-gray-500" name="surname" id="surname">
                <?php
                    # Display text success/error
                    if (isset($_SESSION["csurname"])) {
                        unset($_SESSION["csurname"]);
                    }
                    if (isset($_SESSION["csurnameerr"])) {
                        echo displayError($_SESSION["csurnameerr"]);
                        unset($_SESSION["csurnameerr"]);
                    }
                ?>
            </div>
            <div class="flex flex-col">
                <label for="email" class="text-xl">Correu</label>
                <input value="<?php echo isset($_SESSION["cemail"]) ? $_SESSION["cemail"] : '' ?>" required type="email" class="w-full border-b border-gray-600 h-8 text-lg focus:outline-gray-500" name="email" id="email">
                <?php
                    # Display text success/error
                    if (isset($_SESSION["cemail"])) {
                        unset($_SESSION["cemail"]);
                    }
                    if (isset($_SESSION["cemailerr"])) {
                        echo displayError($_SESSION["cemailerr"]);
                        unset($_SESSION["cemailerr"]);
                    }
                ?>
            </div>
            <div class="flex flex-col">
                <label for="desc" class="text-xl">Consulta</label>
                <textarea required class="w-full min-h-[100px] border-b border-gray-600 h-8 text-lg focus:outline-gray-500" name="desc" id="desc" cols="30" rows="10"><?php echo isset($_SESSION["cdesc"]) ? $_SESSION["cdesc"] : '' ?></textarea>
                <?php
                    # Display text success/error
                    if (isset($_SESSION["cdesc"])) {
                        unset($_SESSION["cdesc"]);
                    }
                    if (isset($_SESSION["cdescerr"])) {
                        echo displayError($_SESSION["cdescerr"]);
                        unset($_SESSION["cdescerr"]);
                    }
                ?>
            </div>
            <button class="bg-gray-500 px-10 py-2 mt-4 text-white hover:bg-white hover:text-gray-500 border-gray-500 border focus:outline-gray-500"  type="submit" value="<?php echo $backUrl; ?>" name="redirect">Enviar</button>
        </form>
        <p class='text-sm text-green-500 w-full invisible'>Correu enviat correctament</p>
    </div>
</main>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "./includes/footer.php";
?>