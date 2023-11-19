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
    $title = "Kategorie";
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
                                Kategorie
                            </h1>
                            <a href="kategorie-pridani.php" class="font-bold text-3xl bg-red-500 text-white rounded-full text-center flex items-center px-3 py-2 transition-all hover:bg-red-400">
                                <i class="ri-add-line"></i>
                            </a>
                        </div>
                        <div class="container mx-auto w-full mb-8 overflow-hidden rounded-xl shadow-lg">
                            <div class="w-full overflow-auto">
                                <table class="w-full">
                                    <thead class="sticky top-0">
                                        <tr class="text-md font-semibold tracking-wide text-left text-white bg-red-500 border-b border-gray-600">
                                            <th class="px-4 py-2 ">ID</th>
                                            <th class="px-4 py-2">NÁZEV</th>
                                            <th class="px-4 py-2">POČET VOZIDEL</th>
                                            <th class="px-4 py-2">SLEVA</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class=" bg-white">';
                                        $pripojeni = mysqli_init();
                                        if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
                                            die("Chyba při připojování k databázi");
                                        }
                                        else {
                                            $sql = "SELECT * FROM kategorie";
                                            $seznamKategorii = mysqli_query($pripojeni, $sql);
                                            if(mysqli_num_rows($seznamKategorii) > 0) {
                                                while (($kategorie = mysqli_fetch_array($seznamKategorii)) != NULL) {
                                                    $sql = "SELECT COUNT(*) AS pocet
                                                    FROM vozidla v INNER JOIN kategorie k ON v.kategorie=k.id_k 
                                                    WHERE k.id_k = " . $kategorie["id_k"] . " 
                                                    GROUP BY id_k";
                                                    $pocetVozidel = mysqli_query($pripojeni, $sql)->fetch_array();

                                                    echo "
                                                    <tr class='text-gray-800 hover:bg-gray-100 transition-all'>
                                                        <td class='px-4 py-3 text-ms border'>" . $kategorie["id_k"] . "</td>
                                                        <td class='px-4 py-3 text-sm border font-bold'>" . $kategorie["nazev"] . "</td>
                                                        <td class='px-4 py-3 text-sm border'>" . ($pocetVozidel["pocet"] ?? 0) . "</td>
                                                        <td class='px-4 py-3 text-sm border'>" . $kategorie["sleva"] . " Kč" . "</td>
                                                        <td class='px-4 py-3 border'>
                                                            <div class='flex justify-center'>
                                                                <a href='kategorie-smazani.php?kategorie=" . $kategorie["id_k"] . "' class='mr-5'>
                                                                    <i class='ri-delete-bin-6-fill text-2xl transition-all hover:text-red-500'></i>
                                                                </a>
                                                                <a href='kategorie-edit.php?kategorie=" . $kategorie["id_k"] . "'>
                                                                    <i class='ri-more-fill text-2xl transition-all hover:text-gray-400'></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>";
                                                }
                                            }
                                            else {
                                                echo "V databázi se nenašly žádná data";
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
            echo '<h2 class="font-bold text-xl w-full text-center bg-red-500 py-5 text-white">Nemáte dostatečné oprávnění!</h2>
            <a href="../index.php" class="w-full text-center ml-5 font-semibold text-xl">Hlavní stránka</a>';
        }
    }
    else {
        echo '<h2 class="font-bold text-xl w-full text-center bg-red-500 py-5 text-white">Nejste přihlášen!</h2>
        <a href="../uzivatele/prihlaseni.php" class="w-full text-center ml-5 font-semibold text-xl">Přihlásit se</a>';
    }
?>
</html>
