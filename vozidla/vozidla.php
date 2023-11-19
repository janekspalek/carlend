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
    $title = "Vozidla";
    $index = 0;
    require_once '../soubory/header.php';
    if(isset($_GET["chyba"])) {
        echo '
        <script>
            alert("Chyba při smazání vozidla");
        </script>';
    }

    if(isset($_SESSION["role"])) {
        if($_SESSION["role"] == 1) {
            echo '
            <body class="font-exo scroll-smooth overflow-x-hidden">
            <div class="flex w-full">';

                require_once '../admin/admin-panel.php';

                echo '
                <div class="flex-1 bg-red-50 p-20">
                    <div class="container mx-auto flex justify-between mb-10 ">
                        <h1 class="font-bold text-3xl text-gray-800 underline underline-offset-8 ">
                            Vozidla
                        </h1>
                        <a href="vozidla-pridani.php" class="font-bold text-3xl bg-red-500 text-white rounded-full text-center flex items-center px-3 py-2 transition-all hover:bg-red-400">
                            <i class="ri-add-line"></i>
                        </a>
                    </div>
                    <div class="container mx-auto w-full mb-8 overflow-hidden rounded-xl shadow-lg">
                        <div class="w-full h-[600px] overflow-auto">
                            <table class="w-full">
                                <thead class="sticky top-0">
                                    <tr class="text-md font-semibold tracking-wide text-left text-white bg-red-500 border-b border-gray-600">
                                        <th class="px-4 py-2">ID</th>
                                        <th class="px-4 py-2">NÁZEV</th>
                                        <th class="px-4 py-2">ROK</th>
                                        <th class="px-4 py-2">KATEGORIE</th>
                                        <th class="px-4 py-2">PŘEVODOVKA</th>
                                        <th class="px-4 py-2">POČET MÍST</th>
                                        <th class="px-4 py-2">MOTOR</th>
                                        <th class="px-4 py-2">TYP PALIVA</th>
                                        <th class="px-4 py-2">STATUS</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">';

                                    $pripojeni = mysqli_init();
                                    if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
                                        die("Chyba při připojování k databázi");
                                    }
                                    else {
                                        $sql = "SELECT * FROM vozidla";
                                        $seznamVozidel = mysqli_query($pripojeni, $sql);
    
                                        if(mysqli_num_rows($seznamVozidel) > 0) {
                                            while (($vozidlo = mysqli_fetch_array($seznamVozidel)) != NULL) {
                                                $sql = "SELECT * FROM kategorie WHERE id_k = " . $vozidlo["kategorie"];
                                                $kategorie = mysqli_query($pripojeni, $sql);
                                                $kategorie = mysqli_fetch_array($kategorie);
                                                echo '
                                                <tr class="text-gray-800 hover:bg-gray-100 transition-all">
                                                    <td class="px-4 py-3 text-ms font-semibold border">' . $vozidlo["id_v"] . '</td>
                                                    <td class="px-4 py-3 text-sm border font-bold">' . $vozidlo["nazev"] .'</td>
                                                    <td class="px-4 py-3 text-sm border font-bold">' . $vozidlo["rok"] . '</td>
                                                    <td class="px-4 py-3 text-sm border">' . $kategorie["nazev"] . '</td>
                                                    <td class="px-4 py-3 text-sm border">' . $vozidlo["prevodovka"] . '</td>
                                                    <td class="px-4 py-3 text-sm border">' . $vozidlo["pocetmist"] . '</td>
                                                    <td class="px-4 py-3 text-sm border">' . $vozidlo["motor"] . '</td>
                                                    <td class="px-4 py-3 text-sm border">' . $vozidlo["palivo"] . '</td>
                                                    <td class="px-4 py-3 text-sm border">';
                                                    if($vozidlo["dostupnost"]) {
                                                        echo '<span class="p-2 rounded-full font-semibold text-green-600 bg-green-100 text-sm">Dostupné</span>';
                                                    }
                                                    else {
                                                        echo '<span class="p-2 rounded-full font-semibold text-red-600 bg-red-100 text-sm">Nedostupné</span>';
                                                    }
                                                    echo '
                                                    </td>
                                                    <td class="px-4 py-3 border">
                                                        <div class="flex justify-center">
                                                            <a href="vozidla-smazani.php?vozidlo=' . $vozidlo["id_v"] . '" class="mr-5">
                                                                <i class="ri-delete-bin-6-fill text-2xl transition-all hover:text-red-500"></i>
                                                            </a>
                                                            <a href="vozidla-edit.php?vozidlo=' . $vozidlo["id_v"] . '">
                                                                <i class="ri-more-fill text-2xl transition-all hover:text-gray-400"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
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
