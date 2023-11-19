<?php
    session_start();
    $server = "localhost";
    $uzivatel = "root";
    $heslo = "";
    $db = "carlend";

    $odeslano = 0;

    if(isset($_POST["rezervace_zacatek"])) {
        $pripojeni = mysqli_init();
        if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
            die("Chyba při připojování k databázi");
        }
        else {
            $sql = "SELECT * FROM rezervace WHERE vozidlo = " . $_GET["vozidlo"];
            $seznamRezervaci = mysqli_query($pripojeni, $sql);
            if(mysqli_num_rows($seznamRezervaci) > 0) {
                $kontrola = 1;
                while (($rezervace = mysqli_fetch_array($seznamRezervaci)) != NULL) {
                    if(($_POST["rezervace_zacatek"] <= $rezervace["rezervace_konec"]) && ($_POST["rezervace_konec"] >= $rezervace["rezervace_zacatek"])) {
                        $kontrola = 0;
                        break;
                    }
                }
                // Kontrola data, nesmi byt rezervace v minulem case 
                // A zaroven nesmi byt zacatek az po konci rezervace
                if(($_POST["rezervace_zacatek"] > $_POST["rezervace_konec"]) || ($_POST["rezervace_zacatek"] < date('Y-m-d')) || ($_POST["rezervace_konec"] < date('Y-m-d'))) {
                    $odeslano = 2;
                }
                else if($kontrola) {
                    $rozdilDat = strtotime($_POST["rezervace_konec"]) - strtotime($_POST["rezervace_zacatek"]);
                    $rozdilDat = round($rozdilDat / (60*60*24));

                    $sql = "SELECT * FROM vozidla WHERE id_v=" . $_GET["vozidlo"];
                    $vozidlo = mysqli_query($pripojeni, $sql);
                    $vozidlo = mysqli_fetch_array($vozidlo);

                    $sql = "SELECT * FROM kategorie WHERE id_k=" . $vozidlo["kategorie"];
                    $kategorie = mysqli_query($pripojeni, $sql);
                    $kategorie = mysqli_fetch_array($kategorie);

                    $cena = ($vozidlo["cena"] / 1000) * 2;

                    if($rozdilDat < 1) {
                        $cena = $cena;
                    }
                    else if($rozdilDat < 4) {
                        $cena = $cena * $rozdilDat;
                    }
                    else if($rozdilDat >= 4 && $rozdilDat <= 6) {
                        $cena = ($cena - $kategorie["sleva"]) * $rozdilDat;
                    }
                    else if($rozdilDat > 6 && $rozdilDat <= 7) {
                        $cena = ($cena - ($kategorie["sleva"] * 1.5)) * $rozdilDat;
                    }
                    else if($rozdilDat > 7 && $rozdilDat <= 14) {
                        $cena = ($cena - ($kategorie["sleva"] * 2)) * $rozdilDat;
                    }
                    else {
                        $cena = ($cena - ($kategorie["sleva"] * 3)) * $rozdilDat;
                    }

                    $sql = "INSERT INTO rezervace (datum_rezervace, rezervace_zacatek, rezervace_konec, uzivatel, vozidlo, stav, popis, cas_vyzvednuti, cena) VALUES(CURRENT_TIMESTAMP, '{$_POST["rezervace_zacatek"]}', '{$_POST["rezervace_konec"]}', '{$_SESSION["id"]}', '{$_GET["vozidlo"]}', '2', '{$_POST["popis"]}', '{$_POST["cas_vyzvednuti"]}', $cena);";
                    mysqli_query($pripojeni, $sql);
                    $odeslano = 1;
                }
                else {
                    $odeslano = 3;
                }
                
            }
            else if(($_POST["rezervace_zacatek"] > $_POST["rezervace_konec"]) || ($_POST["rezervace_zacatek"] < date('Y-m-d')) || ($_POST["rezervace_konec"] < date('Y-m-d'))) {
                $odeslano = 2;
            }
            else {
                $rozdilDat = strtotime($_POST["rezervace_konec"]) - strtotime($_POST["rezervace_zacatek"]);
                $rozdilDat = round($rozdilDat / (60*60*24));

                $sql = "SELECT * FROM vozidla WHERE id_v=" . $_GET["vozidlo"];
                $vozidlo = mysqli_query($pripojeni, $sql);
                $vozidlo = mysqli_fetch_array($vozidlo);

                $sql = "SELECT * FROM kategorie WHERE id_k=" . $vozidlo["kategorie"];
                $kategorie = mysqli_query($pripojeni, $sql);
                $kategorie = mysqli_fetch_array($kategorie);

                $cena = ($vozidlo["cena"] / 1000) * 2;

                if($rozdilDat < 1) {
                    $cena = $cena;
                }
                else if($rozdilDat < 4) {
                    $cena = $cena * $rozdilDat;
                }
                else if($rozdilDat >= 4 && $rozdilDat <= 6) {
                    $cena = ($cena - $kategorie["sleva"]) * $rozdilDat;
                }
                else if($rozdilDat > 6 && $rozdilDat <= 7) {
                    $cena = ($cena - ($kategorie["sleva"] * 1.5)) * $rozdilDat;
                }
                else if($rozdilDat > 7 && $rozdilDat <= 14) {
                    $cena = ($cena - ($kategorie["sleva"] * 2)) * $rozdilDat;
                }
                else {
                    $cena = ($cena - ($kategorie["sleva"] * 3)) * $rozdilDat;
                }

                $sql = "INSERT INTO rezervace (datum_rezervace, rezervace_zacatek, rezervace_konec, uzivatel, vozidlo, stav, popis, cas_vyzvednuti, cena) VALUES(CURRENT_TIMESTAMP, '{$_POST["rezervace_zacatek"]}', '{$_POST["rezervace_konec"]}', '{$_SESSION["id"]}', '{$_GET["vozidlo"]}', '2', '{$_POST["popis"]}', '{$_POST["cas_vyzvednuti"]}', $cena);";
                mysqli_query($pripojeni, $sql);
                $odeslano = 1;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth ">
    <?php
        $title = "Detail auta";
        $index = 0;
        require_once '../soubory/header.php';
    ?>
    <body class="font-exo bg-red-50 scroll-smooth overflow-x-hidden">
    <?php
        require_once '../soubory/menu.php';

        $pripojeni = mysqli_init();
        if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
          die("Chyba při připojování k databázi");
        }
        else {
            if(isset($_GET["vozidlo"])) {
                $sql = "SELECT * FROM vozidla WHERE id_v=" . $_GET["vozidlo"];
                $vozidlo = mysqli_query($pripojeni, $sql);

                if(mysqli_num_rows($vozidlo) > 0) {
                    $vozidlo = mysqli_fetch_array($vozidlo);

                    $sql = "SELECT * FROM kategorie WHERE id_k=" . $vozidlo["kategorie"];
                    $kategorie = mysqli_query($pripojeni, $sql)->fetch_array();

                    $cena = ($vozidlo["cena"] / 1000) * 2;

                    echo '
                    <div class="container px-4 pt-32 mx-auto flex justify-between flex-wrap overflow-hidden lg:w-10/12 items-center">
                        <img src="' . $vozidlo["obrazek"] . '">
                        <div class="bg-white bg-opacity-70 rounded p-4 w-full lg:p-10 mt-6 lg:mt-0 lg:w-5/12">
                            <h2 class="text-sm title-font text-gray-500 tracking-widest uppercase">' . $kategorie["nazev"] . '</h2>
                            <h1 class="text-gray-900 text-3xl title-font font-semibold mb-1">' . $vozidlo["nazev"] . ' ' . $vozidlo["rok"] .'</h1>
                
                            <p class="leading-snug text-justify">' . $vozidlo["popis"] . '</p>
                            <div class="my-5 flex">
                                <div class="mr-7">
                                    <div class="flex items-center">
                                        <i class="ri-gas-station-fill text-xl mr-2"></i>
                                        <p>Palivo: <span class="font-semibold">' . $vozidlo["palivo"] . '</span></p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="ri-settings-4-fill text-xl mr-2"></i>
                                        <p>Převodovka: <span class="font-semibold">' . $vozidlo["prevodovka"] . '</span></p>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="ri-group-fill text-xl mr-2"></i>
                                        <p>Počet míst: <span class="font-semibold">' . $vozidlo["pocetmist"] . '</span></p>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center">
                                        <i class="ri-car-fill text-xl mr-2"></i>
                                        <p>Motor: <span class="font-semibold">' . $vozidlo["motor"] . '</span></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex my-5">
                                <span class="title-font font-medium text-2xl">Již od <span class="text-red-500 font-bold">' . $cena - ($kategorie["sleva"] * 3) . '</span>  Kč/den</span>
                            </div>
                            <div class="grid grid-cols-2 grid-rows-5 border p-2 rounded w-full md:w-1/2 lg:w-4/5">
                                <div class="font-semibold">1-3 dny</div>
                                <div>' . $cena . ' Kč/den</div>
                                <div class="font-semibold">4-6 dnů</div>
                                <div>' . $cena - $kategorie["sleva"] . ' Kč/den</div>
                                <div class="font-semibold">1 týden</div>
                                <div>' . $cena - ($kategorie["sleva"] * 1.5). ' Kč/den</div>
                                <div class="font-semibold">2 týdny</div>
                                <div>' . $cena - ($kategorie["sleva"] * 2) . ' Kč/den</div>
                                <div class="font-semibold">1 měsíc</div>
                                <div>' . $cena - ($kategorie["sleva"] * 3) . ' Kč/den</div>
                                <div class="text-gray-400">Kauce</div>
                                <div class="text-gray-400">30 000 Kč</div>
                            </div>
                        </div>
                    </div>
                    ';
                    if($odeslano == 1) {
                        echo "<h2 class='font-bold text-center text-xl my-5 py-5 px-5 bg-green-500 text-white'>Rezervace byla úspěšně odeslána na potvrzení, děkujeme.</h2>";
                    }
                    else if($odeslano == 2){
                        echo "<h2 class='font-bold text-center text-xl my-5 py-5 px-5 bg-red-500 text-white'>Zadejte, prosím, platné datum rezervace.</h2>";
                    }
                    else if($odeslano == 3){
                        echo "<h2 class='font-bold text-center text-xl my-5 py-5 px-5 bg-red-500 text-white'>Vybraný termín již není dostupný.</h2>";
                        $sql = "SELECT * FROM rezervace";
                        $seznamRezervaci = mysqli_query($pripojeni, $sql);
                        echo "<div class='flex flex-col items-center pb-6 '>";
                        echo "<h3 class='font-bold'>Vozidlo je již zarezervováno v níže uvedených termínech:</h3>";
                        while (($rezervace = mysqli_fetch_array($seznamRezervaci)) != NULL) {
                            if(($_POST["rezervace_zacatek"] <= $rezervace["rezervace_konec"]) && ($_POST["rezervace_konec"] >= $rezervace["rezervace_zacatek"])) {
                                echo "<p>" . $rezervace["rezervace_zacatek"] . " - " . $rezervace["rezervace_konec"] . "</p>";
                            }
                        }
                        echo "</div>";
                    }
                    
                    echo "<div class='w-full flex items-center justify-center p-4 md:px-12 md:py-10'>";
                        if(isset($_SESSION["uzivatel"])) {
                            echo "<form action='detail-auta.php?vozidlo=" . $vozidlo["id_v"] . "' method='POST' class='w-full'>
                            <div class='w-full flex flex-col items-center'>
                                <div class='w-full sm:w-1/2'>
                                    <div class='flex flex-wrap'>
                                        <div class='w-full px-3 mb-5 lg:w-1/3'>
                                            <label for='rezervace_zacatek' class='mb-2 block text-base font-medium text-gray-900'>Datum od:</label>
                                            <input type='date' id='rezervace_zacatek' name='rezervace_zacatek' class='w-full rounded-md border border-gray-300 bg-white py-3 px-6 text-base font-medium text-gray-500 outline-none focus:border-red-400 focus:shadow-md' required/>
                                        </div>
                                        <div class='w-full px-3 mb-5 lg:w-1/3'>
                                            <label for='rezervace_konec' class='mb-2 block text-base font-medium text-gray-900'>Datum do:</label>
                                            <input type='date' id='rezervace_konec' name='rezervace_konec' class='w-full rounded-md border border-gray-300 bg-white py-3 px-6 text-base font-medium text-gray-500 outline-none focus:border-red-400 focus:shadow-md' required/>
                                        </div>
                                        <div class='w-full px-3 mb-5 lg:w-1/3'>
                                            <label for='cas_vyzvednuti' class='mb-2 block text-base font-medium text-gray-900'>Čas</label>
                                            <input type='time' id='cas_vyzvednuti' value='06:00:00' step='60' name='cas_vyzvednuti' id='time' class='w-full rounded-md border border-gray-300 bg-white py-3 px-6 text-base font-medium text-gray-500 outline-none focus:border-red-400 focus:shadow-md' required/>
                                        </div>
                                        </div>
                                        <div class='w-full px-3 mb-5'>
                                            <label for='popis' class='mb-2 block text-base font-medium text-gray-900'>Popis</label>
                                            <input type='textarea' name='popis' class='w-full rounded-md border border-gray-300 bg-white py-3 px-6 text-base font-medium text-gray-500 outline-none focus:border-red-400 focus:shadow-md'/>
                                        </div>
                                    </div>";?>
                                    <script>
                                        $(document).ready(function() {
                                            $("#rezervace_konec").change(function() {
                                                var start = new Date($("#rezervace_zacatek").val());
                                                var konec = new Date($("#rezervace_konec").val());

                                                var rozdil = new Date(konec - start);

                                                var dny = rozdil/1000/60/60/24;
                                                var cena = "<?= $cena ?>";
                                                var cenaKategorie = "<?= $kategorie["sleva"] ?>";

                                                if(dny < 1) {
                                                    $("#predbezna-cena").text(cena);
                                                }
                                                else if(dny < 4) {
                                                    $("#predbezna-cena").text(cena * dny);
                                                }
                                                else if(dny >= 4 && dny <= 6) {
                                                    $("#predbezna-cena").text((cena - cenaKategorie) * dny);
                                                }
                                                else if(dny > 6 && dny <= 7) {
                                                    $("#predbezna-cena").text((cena - cenaKategorie * 1.5) * dny);
                                                }
                                                else if(dny > 7 && dny <= 14) {
                                                    $("#predbezna-cena").text((cena - cenaKategorie * 2) * dny);
                                                }
                                                else {
                                                    $("#predbezna-cena").text((cena - cenaKategorie * 3) * dny);
                                                }
                                                
                                            });
                                        });
                                    </script>
                                    <?php
                                    echo "

                                    <p class='mb-2'>Předběžná cena: <span id='predbezna-cena'>x</span> Kč</p>
                                    <button type='submit' class='rounded-full bg-red-500 py-2 px-8 w-full sm:w-1/2 lg:w-1/4 text-center text-base font-semibold text-white outline-none transition-all duration-200 shadow-xl hover:bg-red-400'>Nezávazně rezervovat</button>
                                </div>
                            </form>";
                        }
                        else {
                            echo "<a href='../uzivatele/prihlaseni.php' class='font-semibold text-center text-md py-2 px-10 bg-red-500 text-white shadow-xl rounded-full transition-all duration-200 hover:bg-red-400 md:text-xl md:py-5'>Pro zarezervování vozidla se nejprve musíte přihlásit.</a>";
                        }
                    echo "</div>";
                }
            }
        }
        require_once '../soubory/footer.php';
    ?>
</body>
</html>

