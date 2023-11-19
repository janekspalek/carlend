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
    $title = "Uživatelé";
    $index = 0;
    require_once '../soubory/header.php';

    if(isset($_SESSION["role"])) {
        if($_SESSION["role"] == 1) {
            echo '
            <body class="font-exo scroll-smooth overflow-x-hidden">
                <div class="flex w-full">';
                    require_once '../admin/admin-panel.php';
        
                    if(isset($_GET["chyba"])) {
                        echo '
                        <script>
                            alert("Chyba při smazání uživatele");
                        </script>';
                    }
                    echo '
                    <div class="flex-1 bg-red-50 p-20">
                        <div class="container mx-auto flex justify-between mb-10 ">
                            <h1 class="font-bold text-3xl text-gray-800 underline underline-offset-8 ">
                                Uživatelé
                            </h1>
                            <a href="uzivatele-pridani.php" class="font-bold text-3xl bg-red-500 text-white rounded-full text-center flex items-center px-3 py-2 transition-all hover:bg-red-400">
                                <i class="ri-add-line"></i>
                            </a>
                        </div>
                        <div class="container mx-auto w-full mb-8 overflow-hidden rounded-xl shadow-lg">
                            <div class="w-full h-[600px] overflow-auto">
                                <table class="w-full">
                                    <thead class="sticky top-0">
                                        <tr class="text-md font-semibold tracking-wide text-left text-white bg-red-500 border-b border-gray-600">
                                            <th class="px-4 py-2 ">ID</th>
                                            <th class="px-4 py-2">PŘÍJMENÍ</th>
                                            <th class="px-4 py-2">JMÉNO</th>
                                            <th class="px-4 py-2">EMAIL</th>
                                            <th class="px-4 py-2">TELEFONNÍ ČÍSLO</th>
                                            <th class="px-4 py-2">ROLE</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class=" bg-white">';
                                        $pripojeni = mysqli_init();
                                        if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
                                            die("Chyba při připojování k databázi");
                                        }
                                        else {
                                            $sql = "SELECT * FROM uzivatele";
                                            $seznamUzivatelu = mysqli_query($pripojeni, $sql);
        
                                            if(mysqli_num_rows($seznamUzivatelu) > 0) {
                                                while (($uzivatel = mysqli_fetch_array($seznamUzivatelu)) != NULL) {
                                                    echo '
                                                    <tr class="text-gray-800 hover:bg-gray-100 transition-all">
                                                        <td class="px-4 py-3 text-ms font-semibold border">' . $uzivatel["id_u"] . '</td>
                                                        <td class="px-4 py-3 text-sm border font-bold">' . $uzivatel["prijmeni"] . '</td>
                                                        <td class="px-4 py-3 text-sm border font-bold">' . $uzivatel["jmeno"] . '</td>
                                                        <td class="px-4 py-3 text-sm border">' . $uzivatel["email"] . '</td>
                                                        <td class="px-4 py-3 text-sm border">' . $uzivatel["telcislo"] . '</td>';
                                                        if($uzivatel["role"] == '1') {
                                                            echo '<td class="px-4 py-3 text-sm border">Admin</td>';
                                                        } 
                                                        else {
                                                            echo '<td class="px-4 py-3 text-sm border">Uživatel</td>';
                                                        }
                                                        echo '
                                                        <td class="px-4 py-3 border">
                                                            <div class="flex justify-center">
                                                                <a href="uzivatele-smazani.php?uzivatel=' . $uzivatel["id_u"] . '" class="mr-5">
                                                                    <i class="ri-delete-bin-6-fill text-2xl transition-all hover:text-red-500"></i>
                                                                </a>
                                                                <a href="uzivatele-edit.php?uzivatel=' . $uzivatel["id_u"] . '">
                                                                    <i class="ri-more-fill text-2xl transition-all hover:text-gray-400"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>';
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
    }
?>
</html>
