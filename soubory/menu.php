<!---------------------------------- MENU ---------------------------------->
<div class="fixed w-full mx-auto px-4 py-5 md:px-24 lg:px-8 transition duration-300 bg-opacity-95 z-auto" style="z-index: 9999;" id="navigace">
    <div class="flex items-center justify-between nav-div ">
    <?php
        if($index) {
            $cesta = "";
        }
        else {
            $cesta = "../";
        }
        echo '
        <a href="' . $cesta . 'index.php" class="flex items-center ">
            <i class="ri-car-fill text-3xl"></i>
            <span class="ml-2 text-3xl font-bold tracking-wide uppercase">CARLEND</span>
        </a>

        <ul class="hidden items-center space-x-8 lg:flex nav-ul">
            <li><a href="' . $cesta . 'index.php#domu" class="font-medium tracking-wide transition-colors duration-200 hover:text-red-500">Domů</a></li>
            <li><a href="' . $cesta . 'index.php#vozy" class="font-medium tracking-wide transition-colors duration-200 hover:text-red-500">Vozy</a></li>
            <li><a href="' . $cesta . 'index.php#vyhody" class="font-medium tracking-wide transition-colors duration-200 hover:text-red-500">Výhody</a></li>
            <li><a href="' . $cesta . 'kontakt.php#podminky" class="font-medium tracking-wide transition-colors duration-200 hover:text-red-500">Podmínky</a></li>
            <li><a href="' . $cesta . 'kontakt.php" class="font-medium tracking-wide transition-colors duration-200 hover:text-red-500">Kontakt</a></li>';
            if(isset($_SESSION["role"])) {
                if($_SESSION["role"] == 1) {
                    echo '<li><a href="' . $cesta . 'admin/admin.php" class="font-medium tracking-wide transition-colors duration-200 hover:text-red-500">Admin</a></li>';
                }
                else {
                    echo '<li><a href="' . $cesta . 'uzivatele/moje-rezervace.php" class="font-medium tracking-wide transition-colors duration-200 hover:text-red-500">Můj účet</a></li>';
                }
            }
            echo '
        </ul>
        <ul>';
            if(!isset($_SESSION["uzivatel"])) {
                echo '<li><a href="' . $cesta . 'uzivatele/prihlaseni.php" class="hidden w-full px-6 py-2 font-medium tracking-wide text-white transition duration-200 rounded-full shadow-md bg-red-500 hover:bg-red-400 lg:flex">Přihlásit se</a></li>';
            }
            else {
                echo '<li><a href="' . $cesta . 'uzivatele/odhlaseni.php" class="hidden w-full px-6 py-2 font-medium tracking-wide text-white transition duration-200 rounded-full shadow-md bg-red-500 hover:bg-red-400 lg:flex">Odhlásit se | Přihlášen jako ' . $_SESSION["jmeno"] . '</a></li>';
            }
            ?>
        </ul>
        <div class="lg:hidden">
            <button>
                <i class="ri-menu-3-line text-3xl nav-tlacitko"></i>
            </button>
        </div>
    </div>
</div>

<!---------------------------------- MENU-MOBIL ---------------------------------->
<div class="hidden fixed top-0 left-0 w-full px-4 py-5 shadow-xl border rounded-2xl bg-white" style="z-index: 9999;" id="navigace-responzivni">
    <div class="flex items-center justify-between mb-4">
        
        <?php
            if($index) {
                $cesta = "";
            }
            else {
                $cesta = "../";
            }
            echo '
            <a href="' . $cesta . 'index.php" class="flex items-center ">
                <i class="ri-car-fill text-3xl"></i>
                <span class="ml-2 text-3xl font-bold tracking-wide uppercase">CARLEND</span>
            </a>
            <div class="lg:hidden">
                <button>
                    <i class="ri-close-line text-3xl nav-tlacitko"></i>
                </button>
            </div>
        </div>
        <ul class="space-y-3 flex flex-col items-center">
            <li><a href="' . $cesta . 'index.php#domu" class="font-medium tracking-wide transition-colors duration-200 hover:text-red-500">Domů</a></li>
            <li><a href="' . $cesta . 'index.php#vozy" class="font-medium tracking-wide transition-colors duration-200 hover:text-red-500">Vozy</a></li>
            <li><a href="' . $cesta . 'index.php#vyhody" class="font-medium tracking-wide transition-colors duration-200 hover:text-red-500">Výhody</a></li>
            <li><a href="' . $cesta . 'kontakt.php#podminky" class="font-medium tracking-wide transition-colors duration-200 hover:text-red-500">Podmínky</a></li>
            <li><a href="' . $cesta . 'kontakt.php" class="font-medium tracking-wide transition-colors duration-200 hover:text-red-500">Kontakt</a></li>';
            if(isset($_SESSION["role"])) {
                if($_SESSION["role"] == 1) {
                    echo '<li><a href="' . $cesta . 'admin/admin.php" class="font-medium tracking-wide transition-colors duration-200 hover:text-red-500">Admin</a></li>';
                }
                else {
                    echo '<li><a href="' . $cesta . 'uzivatele/moje-rezervace.php" class="font-medium tracking-wide transition-colors duration-200 hover:text-red-500">Můj účet</a></li>';
                }
                echo '<li><a href="' . $cesta . 'uzivatele/odhlaseni.php" class="font-medium tracking-wide transition-colors duration-200 hover:bg-red-400 bg-red-500 text-white px-6 py-2 rounded-full">Odhlásit se | Přihlášen jako ' . $_SESSION["jmeno"] . '</a></li>';
            }
            else {
                echo '
                <li><a href="' . $cesta . 'uzivatele/prihlaseni.php" class="font-medium tracking-wide transition-colors duration-200 hover:bg-red-400 bg-red-500 text-white px-6 py-2 rounded-full">Přihlásit se</a></li>';
            }
        echo '
        </ul>';
        ?>
</div>