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
            $sql = "UPDATE kategorie SET nazev='" . $_POST["nazev"] . "', sleva='" . $_POST["sleva"] . "' WHERE id_k = " . $_POST["id_k"];

            if(mysqli_query($pripojeni, $sql)) {
                header("Location: kategorie.php");
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
    $title = "Kategorie úprava";
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
                            if(isset($_GET["kategorie"])) {
                                $sql = "SELECT * FROM kategorie WHERE id_k=" . $_GET["kategorie"];
                                $kategorie = mysqli_query($pripojeni, $sql);
        
                                if(mysqli_num_rows($kategorie) > 0) {
                                    $kategorie = mysqli_fetch_array($kategorie);
                                    echo '
                                    <div class="container mx-auto">
                                        <h1 class="font-bold text-3xl text-gray-800 mb-10 underline underline-offset-8">
                                            Kategorie: úprava kategorie č. ' . $kategorie["id_k"] . '
                                        </h1>
                                    </div>
                                    <div class="container mx-auto w-full mb-8 overflow-hidden rounded-xl shadow-lg bg-white p-20 px-32">
                                        <form action="kategorie-edit.php?kategorie=' . $kategorie["id_k"] . '" method="post" class="grid grid-cols-2 w-[1000px]">
                                            <p class="font-bold mb-2">ID: </p>
                                            <input type="text" name="id_k" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value=' . $kategorie["id_k"] . ' required readonly>
            
                                            <p class="font-bold mb-2">Jméno: </p>
                                            <input type="text" name="nazev" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value=' . $kategorie["nazev"] . ' required>
            
                                            <p class="font-bold mb-2">Sleva [Kč]: </p>
                                            <input type="number" name="sleva" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value=' . $kategorie["sleva"] . ' min="0" required>
                                            
                                            <p></p>
                                            <div>
                                                <button type="submit" class="py-2 w-52 mr-8 bg-red-500 hover:bg-red-400 rounded-full transition-all duration-200 text-white">Uložit</button>
                                                <a href="kategorie.php" class="text-red-500">Zpět</a>
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
