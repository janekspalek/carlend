<?php
    session_start();
    $server = "localhost";
    $uzivatel = "root";
    $heslo = "";
    $db = "carlend";

    $zprava = "";

    if(isset($_POST["nazev"])) {
        $pripojeni = mysqli_init();
        if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
            die("Chyba při připojování k databázi");
        }
        else {
            $sql = "UPDATE vozidla SET nazev='" . $_POST["nazev"] . "', rok='" . $_POST["rok"] . "', kategorie='" . $_POST["kategorie"] . "', prevodovka='" . $_POST["prevodovka"] . "', pocetmist='" . $_POST["pocetmist"] . "', motor='" . $_POST["motor"] . "', palivo='" . $_POST["palivo"] . "', popis='" . $_POST["popis"] . "', dostupnost='" . $_POST["dostupnost"] . "', obrazek='" . $_POST["obrazek"] . "', cena='" . $_POST["cena"] . "' WHERE id_v = " . $_POST["id_v"];

            if(mysqli_query($pripojeni, $sql)) {
                header("Location: vozidla.php");
                exit;
            }
            else {
                $zprava = "Chyba při vkládání dat do databáze";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<?php
    $title = "Vozidla úprava";
    $index = 0;
    require_once '../soubory/header.php';

    if(isset($_SESSION["role"])) {
        if($_SESSION["role"] == 1) {
            echo '
            <body class="font-exo scroll-smooth overflow-x-hidden">
                <div class="flex w-full">';

                    require_once '../admin/admin-panel.php';
        
                    echo '
                    <div class="flex-1 bg-red-50 p-20">';
                        $pripojeni = mysqli_init();
                        if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
                            die("Chyba při připojování k databázi");
                        }
                        else {
                            if(isset($_GET["vozidlo"])) {
                                $sql = "SELECT * FROM vozidla WHERE id_v=" . $_GET["vozidlo"];
                                $vozidla = mysqli_query($pripojeni, $sql);
            
                                if(mysqli_num_rows($vozidla) > 0) {
                                    $vozidlo = mysqli_fetch_array($vozidla);
                                
                                    echo '
                                    <div class="container mx-auto">
                                        <h1 class="font-bold text-3xl text-gray-800 mb-10 underline underline-offset-8">
                                            Vozidla: úprava vozidla č. ' . $vozidlo["id_v"] . '
                                        </h1>
                                    </div>
                                    <div class="container mx-auto w-full mb-8 overflow-hidden rounded-xl shadow-lg bg-white p-20 px-32">
                                        <form action="vozidla-edit.php" method="post" class="grid grid-cols-2 w-[1000px]">
                                            <p class="font-bold mb-2">ID: </p>
                                            <input type="number" name="id_v" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value="' . $vozidlo["id_v"] . '" required readonly>
                                            
                                            <p class="font-bold mb-2">Název: </p>
                                            <input type="text" name="nazev" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value="' . $vozidlo["nazev"] . '" required>
                                            
                                            <p class="font-bold mb-2">Rok: </p>
                                            <input type="number" name="rok" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value="' . $vozidlo["rok"] . '" min="1950" required>
                                            
                                            <p class="font-bold mb-2">Kategorie: </p>';

                                            $sql = "SELECT * FROM kategorie";
                                            $seznamKategorii = mysqli_query($pripojeni, $sql);
                                            
                                            echo '<select name="kategorie" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full">';
            
                                            if(mysqli_num_rows($seznamKategorii) > 0) {
                                                while (($kategorie = mysqli_fetch_array($seznamKategorii)) != NULL) {
                                                    if($kategorie["id_k"] == $vozidlo["kategorie"]) {
                                                        echo '<option selected value="' . $kategorie["id_k"] . '">' . $kategorie["nazev"] . '</option>';
                                                    }
                                                    else {
                                                        echo '<option value="' . $kategorie["id_k"] . '">' . $kategorie["nazev"] . '</option>';
                                                    }
                                                }
                                            }
                                            echo '
                                            </select>
                                            
                                            <p class="font-bold mb-2">Převodovka: </p>
                                            <input type="text" name="prevodovka" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value="' . $vozidlo["prevodovka"] . '" required>
                                            
                                            <p class="font-bold mb-2">Počet míst: </p>
                                            <input type="number" name="pocetmist" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value="' . $vozidlo["pocetmist"] . '" min="1" required>
                                            
                                            <p class="font-bold mb-2">Motor: </p>
                                            <input type="text" name="motor" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value="' . $vozidlo["motor"] . '" required>
                                            
                                            <p class="font-bold mb-2">Typ paliva: </p>
                                            <input type="text" name="palivo" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value="' . $vozidlo["palivo"] . '" required>
                                            
                                            <p class="font-bold mb-2">Popis: </p>
                                            <input type="textarea" name="popis" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value="' . $vozidlo["popis"] . '" required>
                                            
                                            <p class="font-bold mb-2">Dostupnost: </p>
                                            <select name="dostupnost" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full">';
                                            if($vozidlo["dostupnost"]) {
                                                echo '
                                                <option selected value="1">Dostupné</option>
                                                <option value="0">Nedostupné</option>';
                                            }
                                            else {
                                                echo '
                                                <option value="1">Dostupné</option>
                                                <option selected value="0">Nedostupné</option>';
                                            }
                                            echo '
                                            </select>
            
                                            <p class="font-bold mb-2">Obrázek: </p>
                                            <input type="text" name="obrazek" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value="' . $vozidlo["obrazek"] . '" required>
                                            
                                            <p class="font-bold mb-2">Cena (Kč): </p>
                                            <input type="number" name="cena" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value="' . $vozidlo["cena"] . '" min="0" required>
            
                                            <p></p>
                                            <div>
                                                <button type="submit" class="py-2 w-52 mr-8 bg-red-500 hover:bg-red-400 rounded-full transition-all duration-200 text-white">Uložit</button>
                                                <a href="vozidla.php" class="text-red-500">Zpět</a>
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
            </body>
            ';
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