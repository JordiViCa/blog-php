    <footer class="py-10 bg-slate-500 text-white text-4xl font-bold text-center">
        FOOTER ENCARA NO DECIDIT
    </footer>
    <?php
        include_once  $_SERVER['DOCUMENT_ROOT'] . "/includes/forms/login.php";
        include_once  $_SERVER['DOCUMENT_ROOT'] . "/includes/forms/register.php";
        session_unset();
        session_destroy();
    ?>
</body>
</html>