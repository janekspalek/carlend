<?php
    $aktualniStranka = basename($_SERVER['PHP_SELF'], ".php");

echo '
<div class=" bg-gradient-to-bl from-red-50 to-red-200 flex flex-col justify-between min-h-screen">
    <a href="../index.php" class="py-5 px-20 bg-red-500 text-lg font-semibold text-white shadow-xl">
        <span class="flex justify-center items-center">
            Zpět
        </span>
    </a>
    <div class="flex flex-col">
        <a href="../uzivatele/moje-rezervace.php" class="py-5 px-10 transition-all duration-300 text-lg hover:bg-red-500 hover:text-white'; if($aktualniStranka == "moje-rezervace" || $aktualniStranka == "moje-rezervace-edit") echo ' shadow-xl bg-red-500 text-white"'; else echo '"'; echo '>
            <div class="flex items-center justify-between">
                <div class="flex justify-center items-center">
                    <i class="ri-price-tag-3-fill pr-2 text-xl "></i>
                    Rezervace
                </div>
                <i class="ri-arrow-right-s-line text-xl ml-16"></i>
            </div>
        </a>
        <a href="../uzivatele/moje-udaje.php" class="py-5 px-10 transition-all duration-300 text-lg hover:bg-red-500 hover:text-white'; if($aktualniStranka == "moje-udaje") echo ' shadow-xl bg-red-500 text-white"'; else echo '"'; echo '>
            <div class="flex items-center justify-between">
                <div class="flex justify-center items-center">
                    <i class="ri-user-3-fill pr-2 text-xl"></i>
                    Údaje
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