<?php
    session_start();
    $server = "localhost";
    $uzivatel = "root";
    $heslo = "";
    $db = "carlend";

    $zprava = "";

    if(isset($_POST["jmeno"])) {
        $pripojeni = mysqli_init();
        if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
            die("Chyba při připojování k databázi");
        }
        else {
            $sql = "UPDATE uzivatele SET jmeno='" . $_POST["jmeno"] . "',prijmeni='" . $_POST["prijmeni"] . "',email='" . $_POST["email"] . "',telcislo='" . $_POST["telcislo"] . "',role='" . $_POST["role"] . "' WHERE id_u = " . $_POST["id_u"];

            if(mysqli_query($pripojeni, $sql)) {
                header("Location: uzivatele.php");
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
    $title = "Uživatelé úprava";
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
                            if(isset($_GET["uzivatel"])) {
                                $sql = "SELECT * FROM uzivatele WHERE id_u=" . $_GET["uzivatel"];
                                $uzivatel = mysqli_query($pripojeni, $sql);
            
                                if(mysqli_num_rows($uzivatel) > 0) {
                                    $uzivatel = mysqli_fetch_array($uzivatel);
            
                                    echo '
                                    <div class="container mx-auto">
                                        <h1 class="font-bold text-3xl text-gray-800 mb-10 underline underline-offset-8">
                                            Uživatelé: úprava uživatele č. ' . $uzivatel["id_u"] . '
                                        </h1>';
                                        if($zprava != "") {
                                            echo $zprava;
                                        }
                                        echo '
                                    </div>
                                    <div class="container mx-auto w-full mb-8 overflow-hidden rounded-xl shadow-lg bg-white p-20 px-3">
                                        <form action="uzivatele-edit.php?uzivatel=' . $uzivatel["id_u"] . '" method="post" class="grid grid-cols-2 w-[1000px]">
                                            <p class="font-bold mb-2">ID: </p>
                                            <input type="text" name="id_u" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value="' . $uzivatel["id_u"] . '" required readonly >

                                            <p class="font-bold mb-2">Jméno: </p>
                                            <input type="text" name="jmeno" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value="' . $uzivatel["jmeno"] . '" required>
                                            
                                            <p class="font-bold mb-2">Příjmení: </p>
                                            <input type="text" name="prijmeni" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value="' . $uzivatel["prijmeni"] . '" required>
                                            
                                            <p class="font-bold mb-2">Email: </p>
                                            <input type="email" name="email" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value="' . $uzivatel["email"] . '" required>
                                            
                                            <p class="font-bold mb-2">Telefonní číslo: </p>
                                            <input type="tel" name="telcislo" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" value="' . $uzivatel["telcislo"] . '" required>

                                            <p class="font-bold mb-2">Role: </p>
                                            <select name="role" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full">';
                                                if($uzivatel["role"] == 1) {
                                                    echo '
                                                        <option value="1" selected>Admin</option>
                                                        <option value="2">Uživatel</option>';
                                                }
                                                else {
                                                    echo '
                                                        <option value="1">Admin</option>
                                                        <option value="2" selected>Uživatel</option>';
                                                }
                                                echo '
                                            </select>
                                            <p></p>
                                            <div>
                                                <button type="submit" class="py-2 w-52 mr-8 bg-red-500 hover:bg-red-400 rounded-full transition-all duration-200 text-white">Uložit</button>
                                                <a href="uzivatele.php" class="text-red-500">Zpět</a>
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
    }
?>
</html>
