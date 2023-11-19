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
    $title = "Rezervace";
    $index = 0;
    require_once '../soubory/header.php';

    if(isset($_SESSION["role"])) {
        if($_SESSION["role"] == 1) {
            echo '
            <body class="font-exo scroll-smooth overflow-x-hidden">
                <div class="flex w-full">';
            
                    require_once '../admin/admin-panel.php';
                    
                    echo '
                    <div class="flex-1 bg-red-50 p-20">
                        <div class="container mx-auto ">
                            <h1 class="font-bold text-3xl text-gray-800 mb-10 underline underline-offset-8">
                                Rezervace
                            </h1>
                        </div>
                        <div class="container mx-auto w-full mb-8 overflow-hidden rounded-xl shadow-lg">
                            <div class="w-full h-[600px] overflow-auto">
                                <table class="w-full">
                                    <thead class="sticky top-0">
                                        <tr class="text-md font-semibold tracking-wide text-left text-white bg-red-500 border-b border-gray-600">
                                            <th class="px-4 py-2">ČÍSLO</th>
                                            <th class="px-4 py-2">DATUM</th>
                                            <th class="px-4 py-2">ZÁKAZNÍK</th>
                                            <th class="px-4 py-2">REZERVACE OD</th>
                                            <th class="px-4 py-2">REZERVACE DO</th>
                                            <th class="px-4 py-2">AUTO</th>
                                            <th class="px-4 py-2">ČAS VYZVEDNUTÍ</th>
                                            <th class="px-4 py-2">CENA</th>
                                            <th class="px-4 py-2">STAV</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">';
                                        $pripojeni = mysqli_init();
                                        if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
                                            die("Chyba při připojování k databázi");
                                        }
                                        else {
                                            $sql = "SELECT * FROM rezervace ORDER BY id_r DESC";
                                            $seznamRezervaci = mysqli_query($pripojeni, $sql);
                                            if(mysqli_num_rows($seznamRezervaci) > 0) {
                                                while (($rezervace = mysqli_fetch_array($seznamRezervaci)) != NULL) {
                                                    $sql = "SELECT * FROM uzivatele WHERE id_u = " . $rezervace["uzivatel"];
                                                    $uzivatel = mysqli_query($pripojeni, $sql);
                                                    $uzivatel = mysqli_fetch_array($uzivatel);
        
                                                    $sql = "SELECT * FROM vozidla WHERE id_v = " . $rezervace["vozidlo"];
                                                    $vozidlo = mysqli_query($pripojeni, $sql);
                                                    $vozidlo = mysqli_fetch_array($vozidlo);
                                                    echo '
                                                    <tr class="text-gray-800 hover:bg-gray-100 transition-all">
                                                        <td class="px-4 py-3 text-ms font-semibold border">' . $rezervace["id_r"] . '</td>
                                                        <td class="px-4 py-3 text-sm border">' . date("d.m.Y", strtotime($rezervace["datum_rezervace"])) . '</td>
                                                        <td class="border px-4 py-3">
                                                            <a href="../uzivatele/uzivatele-edit.php?uzivatel=' . $uzivatel["id_u"] . '" class="flex items-center text-sm hover:text-red-500 transition-all">
                                                                <i class="ri-account-circle-fill text-3xl mr-2"></i>
                                                                <div>
                                                                    <p class="font-semibold text-black">' . $uzivatel["jmeno"] . '</p>
                                                                    <p class="text-xs text-gray-600">' . $uzivatel["prijmeni"] . '</p>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td class="px-4 py-3 text-sm border">' . date("d.m.Y", strtotime($rezervace["rezervace_zacatek"])) . '</td>
                                                        <td class="px-4 py-3 text-sm border">' . date("d.m.Y", strtotime($rezervace["rezervace_konec"])) . '</td>
                                                        <td class="px-4 py-3 text-sm font-semibold border">
                                                            <a href="../vozidla/vozidla-edit.php?vozidlo=' . $vozidlo["id_v"] . '" class="hover:text-red-500 transition-all">' . $vozidlo["nazev"] . '</a>
                                                        </td>
                                                        <td class="px-4 py-3 text-sm border">' . $rezervace["cas_vyzvednuti"] . '</td>
                                                        <td class="px-4 py-3 text-sm font-semibold border">' . $rezervace["cena"] . ' Kč</td>
                                                        <td class="px-4 py-3 border">';
                                                            if($rezervace["stav"] == 1) {
                                                                echo '<span class="p-2 rounded-full font-semibold text-green-600 bg-green-100 text-sm">Potvrzeno</span>';
                                                            }
                                                            else if($rezervace["stav"] == 2) {
                                                                echo '<span class="p-2 rounded-full font-semibold text-yellow-600 bg-yellow-100 text-sm">Čekající</span>';
                                                            }
                                                            else if($rezervace["stav"] == 3) {
                                                                echo '<span class="p-2 rounded-full font-semibold text-gray-600 bg-gray-100 text-sm">Dokončeno</span>';
                                                            }
                                                            else {
                                                                echo '<span class="p-2 rounded-full font-semibold text-red-600 text-sm">Zrušeno</span>';
                                                            }
                                                            echo '
                                                        </td>
                                                        <td class="px-4 py-3 border">
                                                            <div class="flex justify-center">
                                                                <a href="rezervace-smazani.php?rezervace=' . $rezervace["id_r"] . '" class="mr-5 cursor-pointer">
                                                                    <i class="ri-delete-bin-6-fill text-2xl transition-all hover:text-red-500"></i>
                                                                </a>
                                                                <a href="rezervace-edit.php?rezervace=' . $rezervace["id_r"] . '" class="cursor-pointer">
                                                                    <i class="ri-more-fill text-2xl transition-all hover:text-gray-400"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>';
                                                }
                                            }
                                            else {
                                                echo "Momentálně se zde nenachází žádné rezervace.";
                                            }
                                        }
                                        echo '
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
            <h2 class="font-bold text-xl w-full text-center bg-red-500 py-5 text-white">Nemáte dostatečné oprávnění!</h2>
            <a href="../index.php" class="w-full text-center ml-5 font-semibold text-xl">Hlavní stránka</a>';
        }
    }
    else {
        echo '
        <h2 class="font-bold text-xl w-full text-center bg-red-500 py-5 text-white">Nejste přihlášen!</h2>
        <a href="../uzivatele/prihlaseni.php" class="w-full text-center ml-5 font-semibold text-xl">Přihlásit se</a>';
    }
?>
</html>
