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
  
    <!---------------------------------- ÚVOD ---------------------------------->
    <div data-aos="fade-right" class="container h-screen mx-auto flex px-4 py-24 md:flex-row flex-col items-center justify-center " id="domu">
        <div class="flex flex-col mb-16 items-center text-center md:w-1/2 md:pr-16 md:items-start md:text-left md:mb-0 lg:pr-28 lg:flex-grow ">
            <h2 class="text-center max-w-lg mb-6 text-3xl tracking-wide font-bold leading-none sm:leading-2 md:text-left sm:text-5xl">
                NABÍZÍME <span class="text-red-500">VÝHODNÝ PRONÁJEM</span> LUXUSNÍCH VOZŮ MERCEDES
            </h2>
            <p class="text-center leading-none mb-6 md:text-left md:text-lg md:leading-6">
                Naše autopůjčovna sídlící v lokalitě Ostrava-Centrum je už dlouhé roky spolehlivým partnerem 
                pro půjčení auta v Ostravě a okolí. Vozový park je rozsáhlý, půjčujeme 
                osobní automobily, luxusní limuzíny, SUV i dodávky, a to už od 1100 korun na den bez dalších skrytých poplatků.
            </p>
            <div class="flex items-center justify-center lg:justify-start">
                <a href="#vozy" class="px-6 py-2 mr-6 font-medium tracking-wide text-white bg-red-500 hover:bg-red-400 transition duration-200 rounded-full shadow-md button">Naše nabídka</a>   
                <a href="#navod" class="text-red-500">Jak si půjčit auto?</a>             
            </div>
        </div>
        <div class="w-5/6 md:w-1/2 lg:max-w-3xl lg:w-full text-right">
            <img class="object-cover object-center rounded" alt="hero" src="https://assets.oneweb.mercedes-benz.com/iris/iris.jpg?COSY-EU-100-1713d0VXq0WFqtyO67PobzIr3eWsrrCsdRRzwQZQ9vZbMw3SGtGyStsd2spcUfp8cXGEubYJ0l36xOB2NbcbApRAlI5ux4YQC31gFkzNwtnm7jA6ohKV5Kh%25vqCBjyLRzO6YaxPXSrH1eJrn8ws8WoiZUMNM4FACPTg95zp6PDak6SeWHeutsd8ZDcUfiMfXGE4TdJ0lgOhOB2PbcbApeIoI5usKYQC32hOkzNLzkm7jaSthymI9WFrmcUf8%256XGEHVSe%25hCqts6lqRcUa4zxXGJXV1J0OJ2wOBbnHZbAI68FITin0xdL789ikp8Ns35u9CAGmmKgdPzqCPDVeg8c8uAuyBM6%25GYBkvmP1CP&imgt=P27&bkgnd=9&pov=BE040&uni=c&im=Crop,rect=(50,-25,1370,770),gravity=Center;Resize,width=1000">
        </div>
    </div>

    <div class="bg-white rounded-tr-3xl rounded-br-3xl shadow-md p-4 absolute w-full bottom-0 left-0 sm:max-w-xl lg:max-w-screen-xl lg:px-8 lg:w-1/2">
        <div class="space-x-16 flex justify-center xl:space-x-40">
            <?php
                $pripojeni = mysqli_init();
                if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
                    die("Chyba při připojování k databázi");
                }
                else {
                    $sql = "SELECT COUNT(*) AS pocet FROM uzivatele";
                    $pocetUzivatelu = mysqli_query($pripojeni, $sql)->fetch_array();

                    $sql = "SELECT COUNT(*) AS pocet FROM vozidla";
                    $pocetVozidel = mysqli_query($pripojeni, $sql)->fetch_array();

                    echo '
                    <div class="text-center">
                        <h6 class="text-3xl text-gray-900 font-bold md:text-5xl">' . (date("Y") - 2015) . '</h6>
                        <p class="font-bold">Let na trhu</p>
                    </div>
                    <div class="text-center">
                        <h6 class="text-3xl text-gray-900 font-bold md:text-5xl">' . $pocetUzivatelu["pocet"] . '+</h6>
                        <p class="font-bold">Uživatelů</p>
                    </div>
                    <div class="text-center">
                        <h6 class="text-3xl text-gray-900 font-bold md:text-5xl">' . $pocetVozidel["pocet"] . '</h6>
                        <p class="font-bold">Vozidel</p>
                    </div>';
                }
            ?>
        </div>
    </div>
    



    <!---------------------------------- NABÍDKA VOZŮ ---------------------------------->
    <div class="w-full bg-white">
        <div id="vozy" class="bg-white px-4 py-24 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
                <h2 class="text-center max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl md:mx-auto">
                  Naše nabídka vozů
                </h2>
                <p class="text-center text-base text-gray-700 md:text-lg">
                  Podívejte se na naši širokou nabídku užitkových i osobních vozů k zapůjčení
                </p>
                <form action="index.php#vozy" method="get" class="mt-5 shadow-xl py-4 mx-auto rounded-full flex justify-evenly items-center md:w-4/6">
                    <div>
                        <label for="kategorie" >Kategorie:</label>
                        <select name="kategorie" id="kategorie" >
                            <option value="nezalezi">Nezáleží</option>
                            <?php
                                $sql = "SELECT * FROM kategorie";
                                $kategorieJedna = mysqli_query($pripojeni, $sql);
            
                                if(mysqli_num_rows($kategorieJedna) > 0) {
                                    while (($kategorie = mysqli_fetch_array($kategorieJedna)) != NULL) {
                                        echo '
                                        <option value="' . $kategorie["id_k"] . '"';
                                            if(isset($_GET["kategorie"])) {
                                                if($_GET["kategorie"] == $kategorie["id_k"]) {
                                                    echo 'selected';
                                                }
                                            }
                                            echo '
                                        >' . $kategorie["nazev"] . '</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="bg-red-500 rounded-full py-1 px-4 text-white font-medium shadow-lg transition-all hover:bg-red-400 ">Zobrazit</button>
                </form>
            </div>
            <?php
                $pripojeni = mysqli_init();
                if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
                  die("Chyba při připojování k databázi");
                }
                else {
                    if(isset($_GET["kategorie"]) && ($_GET["kategorie"] != "nezalezi")) {
                        $sql = "SELECT * FROM vozidla WHERE kategorie=" . $_GET["kategorie"];
                    }
                    else {
                        $sql = "SELECT * FROM vozidla";
                    }
                    
                    $seznamVozidel = mysqli_query($pripojeni, $sql);

                    if(mysqli_num_rows($seznamVozidel) > 0) {
                      
                        echo "<div class='grid gap-5 row-gap-5 mb-8 lg:grid-cols-4 sm:grid-cols-2'>";
                        $pocet = 0;
                        while (($vozidlo = mysqli_fetch_array($seznamVozidel)) != NULL) {
                            if($vozidlo["dostupnost"]) {                                
                                $sql = "SELECT * FROM kategorie WHERE id_k=" . $vozidlo["kategorie"];
                                $kategorie = mysqli_query($pripojeni, $sql)->fetch_array();

                                echo "
                                <a data-aos='flip-up' data-aos-delay='50' href='vozidla/detail-auta.php?vozidlo=" . $vozidlo["id_v"] . "' class='inline-block overflow-hidden duration-300 transform bg-white rounded-xl shadow-xl  hover:bg-gray-100'>
                                    <div class='flex flex-col h-full justify-between'>
                                        <img src='" . $vozidlo["obrazek"] . "' class=' w-[255px] mx-auto' alt='". $vozidlo["nazev"] . "' />
                                        <div class='rounded-b'>
                                            <div class='p-5'>
                                                <h6 class='mb-2 font-bold text-xl leading-5 text-center'>". $vozidlo["nazev"] . " " . $vozidlo["rok"] ."</h6>
                                                <p class='mb-2 flex flex-col items-center text-center text-sm text-gray-900'>
                                                    <i class='ri-gas-station-fill'></i>" . $vozidlo["palivo"] . "
                                                    <i class='ri-settings-4-fill'></i>" . $vozidlo["prevodovka"];
                                                    if($vozidlo["pocetmist"] == 1) {
                                                        echo "<i class='ri-group-fill'></i> " . $vozidlo["pocetmist"] ." Místo<br>";
                                                    } 
                                                    else if($vozidlo["pocetmist"] <= 4) {
                                                        echo "<i class='ri-group-fill'></i> " . $vozidlo["pocetmist"] ." Místa<br>";
                                                    } 
                                                    else {
                                                        echo "<i class='ri-group-fill'></i> " . $vozidlo["pocetmist"] ." Míst<br>";
                                                    }
                                                    $cena = ($vozidlo["cena"] / 1000) * 2;
                                                    echo '
                                                    <div class="h-0.5 w-full bg-red-500 mb-2 opacity-60"></div>
                                                    <div class="text-center">Cena již od <span class="text-red-500 ">' . $cena - ($kategorie["sleva"] * 3) . ' </span>Kč/den</div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>';
                                $pocet ++;
                            }
                        }
                        if($pocet == 0) {
                            $zprava = "Aktuálně nenabízíme žádná vozidla k vypůjčení.";
                        }
                        echo "</div>";
                    }
                    else {
                        $zprava = "V databázi se nenašly žádná data.";
                    }
                    if($zprava != "") {
                        echo "<div class='text-center mx-auto'>" . $zprava . "</div>";
                    }
                }
            ?>
        </div>
    </div>

    <div id="navod" class="bg-white">
        <div class="px-4 py-24 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-32">
            <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
                <h2 class="text-center max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl mx-auto">
                  Jak si lze u nás auto půjčit?
                </h2>
                <p class="text-center text-base text-gray-700  md:text-lg py-4">
                  Rezervace probíhají online přes naši webovou stránku, rezervace je možná až po registraci
                </p>
            </div>

            <div class="grid gap-8 row-gap-0 lg:grid-cols-3">
                <div data-aos="fade-right" data-aos-delay="50" class="relative text-center ">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-zinc-200 sm:w-20 sm:h-20">
                        <i class="ri-edit-line text-4xl text-gray-900"></i>
                    </div>
                    <h6 class="mb-2 text-2xl font-extrabold">Krok 1</h6>
                    <p class="text-center max-w-md mb-3 text-gray-900 mx-auto">
                        Vyberete si auto a termín vypůjčení.
                    </p>
                    <div class="top-0 right-0 flex items-center justify-center h-24 lg:-mr-8 lg:absolute">
                        <i class="ri-arrow-right-line text-4xl text-red-500 rotate-90 lg:rotate-0"></i>
                    </div>
                </div>
        
                <div data-aos="fade-right" data-aos-delay="50" class="relative text-center">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-zinc-200 sm:w-20 sm:h-20">
                        <i class="ri-message-2-line text-4xl text-gray-900"></i>
                    </div>
                    <h6 class="mb-2 text-2xl font-extrabold">Krok 2</h6>
                    <p class="text-center max-w-md mb-3 text-gray-900 mx-auto">
                        Podáte nám nezávaznou rezervaci přes náš rezervační systém. Rezervaci Vám obratem potvrdíme.
                    </p>
                    <div class="top-0 right-0 flex items-center justify-center h-24 lg:-mr-8 lg:absolute">
                        <i class="ri-arrow-right-line text-4xl text-red-500 rotate-90 lg:rotate-0"></i>
                    </div>
                </div>
            
                <div data-aos="fade-right" data-aos-delay="50" class="relative text-center">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-zinc-200 sm:w-20 sm:h-20">
                      <i class="ri-car-fill text-4xl text-gray-900"></i>
                    </div>
                    <h6 class="mb-2 text-2xl font-extrabold">Krok 3</h6>
                    <p class="text-center max-w-md mb-3 text-gray-900 mx-auto">
                      Na místě složíte vratnou kauci a podepíšete smlouvu o pronájmu. Nyní je auto vaše a můžete vyrazit.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!---------------------------------- VÝHODY ---------------------------------->
    <div  class="px-4 py-20 mx-auto sm:px-10 xl:px-32 2xl:pl-40" id="vyhody">
        <h1 class="text-3xl font-bold text-gray-800 text-center sm:text-left lg:text-4xl ">Proč si půjčit auto <span class="text-red-500">právě</span>  u nás?</h1>
        <div class="mt-8 xl:mt-12 flex items-center">
            <div data-aos="fade-left" data-aos-delay="50" class="grid w-full grid-cols-1 gap-8 lg:w-1/2 xl:gap-16 md:grid-cols-2">
                <div class="bg-white p-4 rounded-xl shadow-lg space-y-3 text-center sm:text-left ">
                    <i class="ri-time-fill text-5xl text-red-500"></i>

                    <h2 class="text-2xl font-semibold text-gray-800">PRONÁJMY</h1>

                    <p class="text-gray-800">
                      Krátkodobé i dlouhodobé pronájmy osobních automobilů, dodávek i mikrobusů
                    </p>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-lg space-y-3 text-center sm:text-left ">
                    <i class="ri-map-pin-2-fill text-5xl text-red-500"></i>
                    <h2 class="text-2xl font-semibold text-gray-800">PŘISTAVENÍ VOZIDLA</h1>
                    <p class="text-gray-800">
                      ZDARMA přistavíme vozidlo v Ostravě a okolí dle domluvy (letiště, nádraží, hotel,...)
                    </p>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-lg space-y-3 text-center sm:text-left ">
                    <i class="ri-checkbox-fill text-5xl text-red-500"></i>
                    <h2 class="text-2xl font-semibold text-gray-800">SPOLEHLIVOST</h1>
                    <p class="text-gray-800">
                      V případě poruchy přistavení náhradního vozidla ZDARMA
                    </p>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-lg space-y-3 text-center sm:text-left ">
                    <i class="ri-bank-card-fill text-5xl text-red-500"></i>
                    <h2 class="text-2xl font-semibold text-gray-800">VÝHODNÉ CENY</h1>
                    <p class="text-gray-800">
                      Výhodné ceny již od 1100,- Kč / den <br>
                      Zvýhodněné ceny při dlouhodobém pronájmu
                    </p>
                </div>
            </div>
            <div class="hidden lg:flex lg:w-1/2 lg:justify-center">
                <img class="w-[28rem] h-[28rem] flex-shrink-0 object-cover xl:w-[34rem] xl:h-[34rem] rounded-full" src="soubory/pujceni.jpg" alt="">
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
