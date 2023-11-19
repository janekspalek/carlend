<?php
    if($index) {
        $cesta = "";
    }
    else {
        $cesta = "../";
    }
?>
<div class="bg-white px-4 pt-10 mx-auto sm:max-w-xl md:max-w-full md:px-24 lg:px-8">
    <div class="grid gap-10 row-gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
        <div class="sm:col-span-2">
            <a href="#" class="flex items-center ">
                <i class="ri-car-fill text-3xl"></i>
                <span class="ml-2 text-3xl font-bold tracking-wide uppercase">CARLEND</span>
            </a>
            <div class="mt-6 lg:max-w-sm">
                <p class="text-sm text-gray-800">
                    Naše autopůjčovna sídlící v lokalitě Ostrava-Centrum je už dlouhé roky spolehlivým partnerem pro půjčení auta v Ostravě a okolí. 
                </p>
                <p class="mt-4 text-sm text-gray-800">
                    Naše autopůjčovna sídlící v lokalitě Ostrava-Centrum je už dlouhé roky spolehlivým partnerem pro půjčení auta v Ostravě a okolí. Vozový park je rozsáhlý, půjčujeme osobní automobily, luxusní limuzíny, SUV i dodávky, a to už od 1100 korun na den bez skrytých poplatků.
                </p>
            </div>
        </div>
        <div class="space-y-2 text-sm">
            <p class="text-base font-bold tracking-wide text-gray-900">Kontakt</p>
            <div class="flex items-center">
                <i class="ri-phone-line mr-1"></i>
                <a href="tel:702009724" class="transition-colors duration-300 hover:text-red-500">+420 702 009 724</a>
            </div>
            <div class="flex items-center">
                <i class="ri-mail-line mr-1"></i>
                <a href="mailto:j.lepik.st@spseiostrava.cz" class="transition-colors duration-300 hover:text-red-500">j.lepik.st@spseiostrava.cz</a>
            </div>
            <div class="flex items-center">
                <i class="ri-map-pin-2-line mr-1"></i>
                <a href="https://goo.gl/maps/diDro6iK33LZVVn89" target="_blank" class="transition-colors duration-300 hover:text-red-500">Kratochvílova 7, 702 00 Ostrava
                </a>
            </div>
        </div>
        <div>
            <span class="font-bold tracking-wide text-gray-900">Sociální sítě</span>
            <div class="flex items-center mt-1 space-x-3">
                <a href="https://www.instagram.com/" target="_blank" class="text-gray-500 transition-colors duration-300 hover:text-gray-900">
                    <i class="ri-instagram-line text-2xl"></i>
                </a>
                <a href="https://www.twitter.com/" target="_blank" class="text-gray-500 transition-colors duration-300 hover:text-gray-900">
                    <i class="ri-twitter-line text-2xl"></i>
                </a>
                <a href="https://www.facebook.com/" target="_blank" class="text-gray-500 transition-colors duration-300 hover:text-gray-900">
                    <i class="ri-facebook-box-line text-2xl"></i>
                </a>
            </div>
            <p class="mt-4 text-sm text-gray-500">
                Sledujte nás také na našich sociálních sítích
            </p>
          </div>
        </div>
        <div class="flex flex-col-reverse justify-between pt-5 pb-10 border-t lg:flex-row">
            <p class="text-sm text-gray-600">
                © Jonatan Lepík 2023
            </p>
            <?php
            echo '
            <ul class="flex flex-col mb-3 space-y-2 lg:mb-0 sm:space-y-0 sm:space-x-5 sm:flex-row">
                <li>
                    <a href="' . $cesta . 'kontakt.php#faq" class="text-sm text-gray-600 transition-colors duration-300 hover:text-gray-900">Často kladené otázky</a>
                </li>
                <li>
                    <a href="' . $cesta . 'kontakt.php#podminky" class="text-sm text-gray-600 transition-colors duration-300 hover:text-gray-900">Podmínky</a>
                </li>
            </ul>';
            ?>
        </div>
    </div>
</div>