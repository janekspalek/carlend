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
        try {
            if($_POST["heslo"] == $_POST["heslo2"]) {

                $cislo = preg_match('@[0-9]@', $_POST["heslo"]); // kontrola hesla, jestli obsahuje cisla 0-9 atd.
                $pismeno = preg_match('@[a-z]@', $_POST["heslo"]);
                $pismenoVelke = preg_match('@[A-Z]@', $_POST["heslo"]);

                if(strlen($_POST["heslo"]) < 6 || !$cislo || !$pismeno || !$pismenoVelke) { // Pokud bude mit heslo mene jak 6 znaku
                    $zprava = "Heslo musí obsahovat minimálně jedno číslo, malé a velké písmeno a mít délku alespoň 6 znaků";
                }
                else {
                    $heslo = sha1($_POST["heslo"]);

                    $telcislo = $_POST["telcislopredvolba"] . $_POST["telcislo"];

                    $sql = "INSERT INTO uzivatele (jmeno, prijmeni, email, telcislo, heslo, role) VALUES('{$_POST["jmeno"]}', '{$_POST["prijmeni"]}', '{$_POST["email"]}', '{$telcislo}', '{$heslo}', '2');";
                    mysqli_query($pripojeni, $sql);
                    header("Location: uzivatele.php");
                }
            }
            else {
                $zprava = "Hesla se neshodují";
            }
        }
        catch(Exception $e) {
            $zprava = "Zadaný email se již používá";
        }
    }
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth ">
<?php
    $title = "Uživatelé přidání";
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
                    <div class="container mx-auto">
                        <h1 class="font-bold text-3xl text-gray-800 mb-10 underline underline-offset-8">
                            Uživatelé: přidání uživatele
                        </h1>';
                        if($zprava != "") {
                            echo $zprava;
                        }
                        echo '
                    </div>
                    <div class="container mx-auto w-full mb-8 overflow-hidden rounded-xl shadow-lg bg-white p-20 px-3">
                        <form action="uzivatele-pridani.php" method="post" class="grid grid-cols-2 w-[1000px]">
    
                            <p class="font-bold mb-2">Jméno: </p>
                            <input type="text" name="jmeno" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" required>
                            
                            <p class="font-bold mb-2">Příjmení: </p>
                            <input type="text" name="prijmeni" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" required>
                            
                            <p class="font-bold mb-2">Email: </p>
                            <input type="email" name="email" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" required>
                            
                            <p class="font-bold mb-2">Telefonní číslo: </p>
                            <input type="tel" name="telcislo" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" required>
    
                            <p class="font-bold mb-2">Heslo: </p>
                            <input type="password" name="heslo" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" required>
    
                            <p class="font-bold mb-2">Potvrzení hesla: </p>
                            <input type="password" name="heslo2" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" required>
                            
                            <p class="font-bold mb-2">Role: </p>
                            <select name="role" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full">
                                <option value="1">Admin</option>
                                <option value="2" selected>Uživatel</option>
                            </select>
                            <p></p>
                            <div>
                                <button type="submit" class="py-2 w-52 mr-8 bg-red-500 hover:bg-red-400 rounded-full transition-all duration-200 text-white">Uložit</button>
                                <a href="uzivatele.php" class="text-red-500">Zpět</a>
                            </div>
                        </form>    
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
