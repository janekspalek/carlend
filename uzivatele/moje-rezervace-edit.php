<?php
    session_start();
    $server = "localhost";
    $uzivatel = "root";
    $heslo = "";
    $db = "carlend";

    $zprava = "";

    if(isset($_POST["rezervace_zacatek"])) {
        $pripojeni = mysqli_init();
        if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
            die("Chyba při připojování k databázi");
        }
        else {
            $sql = "UPDATE rezervace SET cas_vyzvednuti='" . $_POST["cas_vyzvednuti"] . "', popis='" . $_POST["popis"] . "', stav=2 WHERE id_r = " . $_POST["id_r"];

            if(mysqli_query($pripojeni, $sql)) {
                header("Location: moje-rezervace.php");
                exit;
            }
            else {
                $zprava = "Chyba při vkládání dat do databáze";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth ">
<?php
    $title = "Rezervace úprava";
    $index = 0;
    require_once '../soubory/header.php';

    if(isset($_SESSION["role"])) {
        echo '
        <body class="font-exo scroll-smooth overflow-x-hidden">
        <div class="flex w-full">';
    
            require_once 'muj-ucet-menu.php';
            
            echo '
            <div class="flex-1 bg-red-50 p-20">';
                $pripojeni = mysqli_init();
                if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
                    die("Chyba při připojování k databázi");
                }
                else {
                    if(isset($_GET["rezervace"])) {
                        $sql = "SELECT * FROM rezervace WHERE id_r=" . $_GET["rezervace"];
                        $rezervace = mysqli_query($pripojeni, $sql);

                        if(mysqli_num_rows($rezervace) > 0) {
                            $rezervace = mysqli_fetch_array($rezervace);
                            
                            $sql = "SELECT * FROM uzivatele WHERE id_u = " . $rezervace["uzivatel"];
                            $uzivatel = mysqli_query($pripojeni, $sql)->fetch_array();

                            $sql = "SELECT * FROM vozidla WHERE id_v = " . $rezervace["vozidlo"];
                            $vozidlo = mysqli_query($pripojeni, $sql)->fetch_array();

                            if($rezervace["stav"] == 1) {
                                $stav = "Potvrzeno";
                            }
                            else if($rezervace["stav"] == 2) {
                                $stav = "Čekající";
                            }
                            else if($rezervace["stav"] == 3) {
                                $stav = "Dokončeno";
                            }
                            else {
                                $stav = "Zrušeno";
                            }

                            echo '
                            <div class="container mx-auto">
                                <h1 class="font-bold text-3xl text-gray-800 mb-10 underline underline-offset-8">
                                    Moje rezervace: úprava rezervace č. ' . $rezervace["id_r"] . '
                                </h1>
                            </div>
                            <div class="container mx-auto w-full mb-8 overflow-hidden rounded-xl shadow-lg bg-white p-20 px-32">
                                <form action="moje-rezervace-edit.php?rezervace=' . $rezervace["id_r"] . '" method="post" class="grid grid-cols-2 w-[1000px]">
                                    <p class="font-bold mb-2">ID: </p>
                                    <p class="mb-2">' . $rezervace["id_r"] . '</p>
                                    <p class="font-bold mb-2">Datum: </p>
                                    <p class="mb-2">' . date("d.m.Y", strtotime($rezervace["datum_rezervace"])) . '</p>
                                    <p class="font-bold mb-2">Jméno: </p>
                                    <p class="mb-2">' . $uzivatel["jmeno"] . ' ' . $uzivatel["prijmeni"] . '</p>
                                    <p class="font-bold mb-2">Vozidlo: </p>
                                    <p class="mb-2">' . $vozidlo["nazev"] . '</p>
                                    <p class="font-bold mb-2">Poznámka: </p>
                                    <input type="textarea" name="popis" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value="' . $rezervace["popis"] . '">
                                    
                                    <p class="font-bold mb-2">Termín rezervace: </p>
                                    <div class="flex items-center justify-center mb-3">
                                        <input type="date" name="rezervace_zacatek" class="p-2 mr-2 bg-gray-50 border border-gray-300 text-gray-400 text-sm rounded-lg w-full" value="' . $rezervace["rezervace_zacatek"] . '" readonly>
                                        <p class="text-3xl mr-2 font-thin">-</p>
                                        <input type="date" name="rezervace_konec" class="p-2 bg-gray-50 border border-gray-300 text-gray-400 text-sm rounded-lg w-full" value="' . $rezervace["rezervace_konec"] . '" readonly>
                                    </div>
                                    
                                    <p class="font-bold mb-2">Čas vyzvednutí: </p>
                                    <input type="time" name="cas_vyzvednuti" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value="' . $rezervace["cas_vyzvednuti"] . '" required>
                                    
                                    <p class="font-bold mb-2">Stav: </p>
                                    <input type="text" name="stav" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-400 text-sm rounded-lg w-full" value="' . $stav . '" readonly>
                                    
                                    <p class="font-bold mb-2">Cena [Kč]: </p>
                                    <input type="number" name="cena" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-400 text-sm rounded-lg w-full" min="0" value="' . $rezervace["cena"] . '" readonly>
                                    <p></p>
                                    <div>
                                        <input type="hidden" name="id_r" value="' . $rezervace["id_r"] . '">
                                        <button type="submit" class="py-2 w-52 mr-8 bg-red-500 hover:bg-red-400 rounded-full transition-all duration-200 text-white">Uložit</button>
                                        <a href="moje-rezervace.php" class="text-red-500">Zpět</a>
                                    </div>
                                </form>
                            </div>';
                        }
                    }
                }
                echo '
                </div>
            </div>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
        AOS.init();
        </script>
        </body>';
    }
    else {
        echo '
        <h2 class="font-bold text-xl w-full text-center bg-red-500 py-5 text-white">Nejste přihlášen!</h2>
        <a href="../uzivatele/prihlaseni.php" class="w-full text-center ml-5 font-semibold text-xl">Přihlásit se</a>';
    }
?>
</html>
