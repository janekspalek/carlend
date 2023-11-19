<?php
    $aktualniStranka = basename($_SERVER['PHP_SELF'], ".php");

echo '
<div class=" bg-gradient-to-bl from-red-50 to-red-200 flex flex-col justify-between min-h-screen">
    <a href="../index.php" class="py-5 px-20 bg-red-500 text-lg font-semibold text-white shadow-xl">
        <span class="flex justify-center items-center">
            Administrační<br>
            panel
        </span>
    </a>
    <div class="flex flex-col">
        <a href="../admin/admin.php" class="py-5 px-10 transition-all duration-300 text-lg hover:bg-red-500 hover:text-white'; if($aktualniStranka == "admin") echo ' shadow-xl bg-red-500 text-white"'; else echo '"'; echo '>
            <div class="flex items-center justify-between">
                <div class="flex justify-center items-center ">
                    <i class="ri-home-2-fill pr-2 text-xl"></i>
                    Nástěnka
                </div>
                <i class="ri-arrow-right-s-line text-xl ml-16"></i>
            </div>
        </a>
        <a href="../rezervace/rezervace.php" class="py-5 px-10 transition-all duration-300 text-lg hover:bg-red-500 hover:text-white'; if($aktualniStranka == "rezervace" || $aktualniStranka == "rezervace-edit") echo ' shadow-xl bg-red-500 text-white"'; else echo '"'; echo '>
            <div class="flex items-center justify-between">
                <div class="flex justify-center items-center ">
                    <i class="ri-price-tag-3-fill pr-2 text-xl "></i>
                    Rezervace
                </div>
                <i class="ri-arrow-right-s-line text-xl ml-16"></i>
            </div>
        </a>
        <a href="../uzivatele/uzivatele.php" class="py-5 px-10 transition-all duration-300 text-lg hover:bg-red-500 hover:text-white'; if($aktualniStranka == "uzivatele" || $aktualniStranka == "uzivatele-edit" || $aktualniStranka == "uzivatele-pridani") echo ' shadow-xl bg-red-500 text-white"'; else echo '"'; echo '>
            <div class="flex items-center justify-between">
                <div class="flex justify-center items-center">
                    <i class="ri-user-3-fill pr-2 text-xl"></i>
                    Uživatelé
                </div>
                <i class="ri-arrow-right-s-line text-xl ml-16"></i>
            </div>
        </a>
        <a href="../vozidla/vozidla.php" class="py-5 px-10 transition-all duration-300 text-lg hover:bg-red-500 hover:text-white'; if($aktualniStranka == "vozidla" || $aktualniStranka == "vozidla-edit" || $aktualniStranka == "vozidla-pridani") echo ' shadow-xl bg-red-500 text-white"'; else echo '"'; echo '>
            <div class="flex items-center justify-between">
                <div class="flex justify-center items-center">
                    <i class="ri-car-fill pr-2 text-xl"></i>
                    Vozidla
                </div>
                <i class="ri-arrow-right-s-line text-xl ml-16"></i>
            </div>
        </a>
        <a href="../kategorie/kategorie.php" class="py-5 px-10 transition-all duration-300 text-lg hover:bg-red-500 hover:text-white'; if($aktualniStranka == "kategorie" || $aktualniStranka == "kategorie-edit" || $aktualniStranka == "kategorie-pridani") echo ' shadow-xl bg-red-500 text-white"'; else echo '"'; echo '>
            <div class="flex items-center justify-between">
                <div class="flex justify-center items-center">
                    <i class="ri-file-text-line pr-2 text-xl"></i>
                    Kategorie
                </div>
                <i class="ri-arrow-right-s-line text-xl ml-16"></i>
            </div>
        </a>
        <a href="../admin/admin-prihlaseni.php" class="py-5 px-10 transition-all duration-300 text-lg hover:bg-red-500 hover:text-white'; if($aktualniStranka == "admin-prihlaseni") echo ' shadow-xl bg-red-500 text-white"'; else echo '"'; echo '>
            <div class="flex items-center justify-between">
                <div class="flex justify-center items-center">
                    <i class="ri-file-user-fill pr-2 text-xl"></i>
                    Přihlášení
                </div>
                <i class="ri-arrow-right-s-line text-xl ml-16"></i>
            </div>
        </a>
    </div>
    <a href="../uzivatele/odhlaseni.php" class="py-5 transition-all duration-300 text-lg text-gray-900 hover:text-red-500">
        <div class="flex justify-center items-center">
            <i class="ri-door-open-fill pr-2 text-xl"></i>
            Odhlásit se
        </div>
    </a>
</div>';