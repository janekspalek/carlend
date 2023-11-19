<?php
    session_start();

    $server = "localhost";
    $uzivatel = "root";
    $heslo = "";
    $db = "carlend";

    $zprava = "";
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth ">

<?php
    $title = "Úvod";
    $index = 1;

    require_once 'soubory/header.php';
?>

<body class="font-exo bg-red-50 scroll-smooth overflow-x-hidden">

    <?php
        require_once 'soubory/menu.php';
    ?>
    <div></div>
    <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2573.175574846723!2d18.291604815866915!3d49.83915843910196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4713e32fae8220cf%3A0x3553e27d9cafa031!2sSt%C5%99edn%C3%AD%20pr%C5%AFmyslov%C3%A1%20%C5%A1kola%20elektrotechniky%20a%20informatiky!5e0!3m2!1scs!2scz!4v1679901713395!5m2!1scs!2scz" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="container flex flex-wrap mx-auto justify-evenly mt-[-80px] mb-28">
        <div class="mb-8 p-10 bg-white rounded-xl text-center text-gray-600 shadow-md xl:w-1/4 md:w-1/2 w-[90%]">
            <i class="ri-mail-line bg-red-500 text-white rounded-full p-5 text-3xl"></i>
            <h2 class="text-xl text-red-500 mt-10 mb-2 font-medium">Kontakt</h2>
            <p>Jonatan Lepík</p>
            <a href="mailto:j.lepik.st@spseiostrava.cz" class="text-red-400">j.lepik.st@spseiostrava.cz</a><br>
            <a href="tel:702009724" class="text-red-400">702 009 724</a>
        </div>

        <div class="mb-8  p-10 bg-white rounded-xl text-center text-gray-600 shadow-md xl:w-1/4 md:w-1/2 w-[90%]">
            <i class="ri-map-pin-line bg-red-500 text-white rounded-full p-5 text-3xl"></i>
            <h2 class="text-xl text-red-500 mt-10 mb-2 font-medium">Adresa</h2>
            <a href="https://mapy.cz/s/mefogohasa" target="_blank" class="text-red-400"><span class="text-gray-600"> Česká republika<br></span>Kratochvílova 1490/7<br> Ostrava 702 00<br> </a><br>
        </div>

        <div class="mb-8 p-10 bg-white rounded-xl text-center text-gray-600 shadow-md xl:w-1/4 md:w-1/2 w-[90%]">
            <i class="ri-mail-line bg-red-500 text-white rounded-full p-5 text-3xl"></i>
            <h2 class="text-xl text-red-500 mt-10 mb-2 font-medium">Sociální sítě</h2>
            <a href="https://www.instagram.com/" target="_blank" class="text-red-400">Instagram</a><br>
            <a href="https://www.facebook.com/" target="_blank" class="text-red-400">Facebook</a><br>
            <a href="https://www.twitter.com/" target="_blank" class="text-red-400">Twitter</a><br>
        </div>
    </div>

    <div class="w-full bg-white" id="podminky">
        <div class="container px-5 py-28 mx-auto bg-white" >
            <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
                <h2 class="text-center max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl md:mx-auto">
                    Naše podmínky
                </h2>
                <p class="text-center text-base text-gray-700 md:text-lg">
                    Níže naleznete podmínky, které platí v naší autopůjčovně. Podmínky jsou platné od 1.1.2023 až do odvolání.
                </p>
            </div>

            <div class="space-y-6 flex flex-wrap md:space-y-0">
                <div class="p-4 md:w-1/3 flex flex-col text-center items-center mb-5">
                    <i class="ri-number-1 text-3xl p-4 px-5 rounded-full bg-red-500 text-white mb-2 font-medium"></i>
                    <div>
                        <h2 class="text-gray-900 text-lg title-font font-medium mb-3 ">Věk</h2>
                        <p class="leading-relaxed text-base">Musíte být starší 21 let a mít řidičský průkaz platný po dobu nejméně 1 roku.</p>
                    </div>
                </div>

                <div class="p-4 md:w-1/3 flex flex-col text-center items-center mb-5">
                    <i class="ri-number-2 text-3xl p-4 px-5 rounded-full bg-red-500 text-white mb-2 font-medium "></i>
                    <div>
                        <h2 class="text-gray-900 text-lg title-font font-medium mb-3 ">Platba</h2>
                        <p class="leading-relaxed text-base">Před zapůjčením auta je třeba zaplatit zálohu a předložit platnou kreditní kartu.</p>
                    </div>
                </div>

                <div class="p-4 md:w-1/3 flex flex-col text-center items-center mb-5">
                    <i class="ri-number-3 text-3xl p-4 px-5 rounded-full bg-red-500 text-white mb-2 font-medium "></i>
                    <div>
                        <h2 class="text-gray-900 text-lg title-font font-medium mb-3 ">Palivo</h2>
                        <p class="leading-relaxed text-base">Auto musí být vráceno s plnou nádrží paliva, jinak může být účtován poplatek za doplnění paliva.</p>
                    </div>
                </div>

                <div class="p-4 md:w-1/3 flex flex-col text-center items-center mb-5">
                    <i class="ri-number-4 text-3xl p-4 px-5 rounded-full bg-red-500 text-white mb-2 font-medium "></i>
                    <div>
                        <h2 class="text-gray-900 text-lg title-font font-medium mb-3 ">Vrácení</h2>
                        <p class="leading-relaxed text-base">Auto musí být vráceno včas a v dobrém stavu. Pokud vrátíte auto pozdě nebo s poškozením, může být účtována pokuta.</p>
                    </div>
                </div>

                <div class="p-4 md:w-1/3 flex flex-col text-center items-center mb-5">
                    <i class="ri-number-5 text-3xl p-4 px-5 rounded-full bg-red-500 text-white mb-2 font-medium "></i>
                    <div>
                        <h2 class="text-gray-900 text-lg title-font font-medium mb-3 ">Ztráta klíčů</h2>
                        <p class="leading-relaxed text-base">Pokud ztratíte klíče od auta, budete muset zaplatit poplatek za výrobu nových klíčů nebo dokonce za výměnu zámku.</p>
                    </div>
                </div>

                <div class="p-4 md:w-1/3 flex flex-col text-center items-center mb-5">
                    <i class="ri-number-6 text-3xl p-4 px-5 rounded-full bg-red-500 text-white mb-2 font-medium "></i>
                    <div>
                        <h2 class="text-gray-900 text-lg title-font font-medium mb-3 ">Pojištění</h2>
                        <p class="leading-relaxed text-base">V ceně pronájmu vozidla je zahrnuto zákonné pojištění, havarijní pojištění, pojištění čelního skla a pojištění proti kráděži. Spoluúčast 10 %, min 10000 Kč</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container px-5 py-28 mx-auto" id="faq">
        <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
                <h2 class="text-center max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl md:mx-auto">
                    Často kladené dotazy
                </h2>
                <p class="text-center text-base text-gray-700 md:text-lg">
                    Níže naleznete často kladené dotazy od našich zákazníků. Pokud jste zde nenašli odpověď na svůj dotaz, neváhejte nás kontaktovat.
                </p>
            </div>

        <div class="flex flex-wrap">
            <div class="xl:w-1/3 md:w-1/2 p-4">
                <div class="rounded-lg bg-white shadow-md p-6">
                    <h2 class="text-lg text-gray-900 font-medium mb-3">Kolik mi musí být let, abych si mohl/a pronajmout vůz od vaší autopůjčovny?</h2>
                    <p class="text-gray-600">Vítáni jsou řidiči starší 21 let s platným řidičským průkazem starším jednoho roku.</p>
                </div>
            </div>
            
            <div class="xl:w-1/3 md:w-1/2 p-4">
                <div class="rounded-lg bg-white shadow-md p-6">
                    <h2 class="text-lg text-gray-900 font-medium mb-3">Co vše je zahrnuto v ceně denního pronájmu vozidla?</h2>
                    <p class="text-gray-600">V denním pronájmu je zahrnuto 500 km ZDARMA, po překročení tohoto limitu je účtována částka 1,50 Kč/km.</p>
                </div>
            </div>

            <div class="xl:w-1/3 md:w-1/2 p-4">
                <div class="rounded-lg bg-white shadow-md p-6">
                    <h2 class="text-lg text-gray-900 font-medium mb-3">Jaké doklady jsou potřeba k pronájmu vozidel?</h2>
                    <p class="text-gray-600">Pokud o půjčení vozů žádá fyzická osoba, potřebuje k tomu dva doklady totožnosti. U podnikajících osob je navíc potřeba předložit živnostenský list.</p>
                </div>
            </div>

            <div class="xl:w-1/3 md:w-1/2 p-4">
                <div class="rounded-lg bg-white shadow-md p-6">
                    <h2 class="text-lg text-gray-900 font-medium mb-3">Mohu si vypůjčit nebo vrátit auto o víkendu?</h2>
                    <p class="text-gray-600">Ano, můžete. Naše půjčovna je Vám k dispozici každý den v týdnu od 9:00 - 17:00. Nabízíme také individuální časy.</p>
                </div>
            </div>

            <div class="xl:w-1/3 md:w-1/2 p-4">
                <div class="rounded-lg bg-white shadow-md p-6">
                    <h2 class="text-lg text-gray-900 font-medium mb-3">Kolik paliva bude v nádrži?</h2>
                    <p class="text-gray-600">Do předávacího protokolu se zapíše stav nádrže a se stejným stavem nádrže se pak vůz vrací.</p>
                </div>
            </div>

            <div class="xl:w-1/3 md:w-1/2 p-4">
                <div class="rounded-lg bg-white shadow-md p-6">
                    <h2 class="text-lg text-gray-900 font-medium mb-3">Jak se vozidla přebírají a jak se vrací?</h2>
                    <p class="text-gray-600">Není-li s námi dohodnuto jinak, vůz se přebírá a vrací na její pobočce.</p>
                </div>
            </div>
        </div>
    </div>

    <?php
      require_once 'soubory/footer.php';
    ?>

    <script src="https://unpkg.com/aos@next/dist/aos.js" ></script>
    <script>AOS.init();</script>
</body>
</html>
