<?php
    session_start();
    $server = "localhost";
    $uzivatel = "root";
    $heslo = "";
    $db = "carlend";

    $zprava = "";

    if(isset($_POST["heslo"])) {
        $pripojeni = mysqli_init();
        if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
            die("Chyba při připojování k databázi");
        }
        try {
            $sql = "SELECT * FROM uzivatele WHERE id_u=" . $_SESSION["id"];
            $uzivatelZmena = mysqli_query($pripojeni, $sql);
            $uzivatelZmena = mysqli_fetch_array($uzivatelZmena);

            $stareHeslo = sha1($_POST["stare-heslo"]);
            if(($_POST["heslo"] != $_POST["heslo2"])) {
                $zprava = "Hesla se neshodují";
            }
            else if(($stareHeslo != $uzivatelZmena["heslo"])) {
                $zprava = "Špatně zadané staré heslo";
            }
            else {
                $cislo = preg_match('@[0-9]@', $_POST["heslo"]); // kontrola hesla, jestli obsahuje cisla 0-9 atd.
                $pismeno = preg_match('@[a-z]@', $_POST["heslo"]);
                $pismenoVelke = preg_match('@[A-Z]@', $_POST["heslo"]);

                if(strlen($_POST["heslo"]) < 6 || !$cislo || !$pismeno || !$pismenoVelke) { // Pokud bude mit heslo mene jak 6 znaku
                    $zprava = "Heslo musí obsahovat minimálně jedno číslo, malé a velké písmeno a mít délku alespoň 6 znaků";
                }
                else {
                    $heslo = sha1($_POST["heslo"]);

                    $sql = "UPDATE uzivatele SET heslo='" . $heslo . "' WHERE id_u = " . $_SESSION["id"];
                    mysqli_query($pripojeni, $sql);
                    header("Location: admin-prihlaseni.php?zmena=1");
                }
            }
        }
        catch(Exception $e) {
            $zprava = "Chyba změny hesla";
        }
    }
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth ">
<?php
    $title = "Admin přihlášení";
    $index = 0;
    require_once '../soubory/header.php';
?>

<body class="font-exo scroll-smooth overflow-x-hidden">
    <div class="flex w-full">
        <?php
            require_once 'admin-panel.php';
        ?>
        <div class="flex-1 bg-red-50 p-20">
        <?php
            $pripojeni = mysqli_init();
            if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
                die("Chyba při připojování k databázi");
            }
            else {
                if(isset($_SESSION["id"])) {
                    $sql = "SELECT * FROM uzivatele WHERE id_u=" . $_SESSION["id"];
                    $uzivatel = mysqli_query($pripojeni, $sql);

                    if(mysqli_num_rows($uzivatel) > 0) {
                        $uzivatel = mysqli_fetch_array($uzivatel);

                        echo '
                        <div class="container mx-auto">
                            <h1 class="font-bold text-3xl text-gray-800 mb-10 underline underline-offset-8">
                                Admin: změna hesla
                            </h1>
                            ';
                            
                        echo '
                        </div>
                        <div class="container mx-auto w-full mb-8 overflow-hidden rounded-xl shadow-lg bg-white p-20 px-32">';
                            if($zprava != "") {
                                echo '
                                <div class="text-center bg-red-100 text-red-500 rounded-full py-2 mb-5">
                                    ' . $zprava . '
                                </div>';
                            }
                            else if(isset($_GET["zmena"])) {
                                echo '
                                <div class="text-center bg-green-100 text-green-500 rounded-full py-2 mb-5">
                                    Heslo bylo úspěšně změněno
                                </div>';
                            }
                            echo '
                            <form action="admin-prihlaseni.php" method="post" class="grid grid-cols-2 w-[1000px]">
                                <p class="font-bold mb-2">Staré heslo: </p>
                                <input type="password" name="stare-heslo" class="p-2 mb-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" required>

                                <p class="font-bold mb-2">Nové heslo: </p>
                                <input type="password" name="heslo" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" required>

                                <p class="font-bold mb-2">Potvrzení hesla: </p>
                                <input type="password" name="heslo2" class="p-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full" required>
                                
                                <p></p>
                                <div>
                                    <button type="submit" class="py-2 w-52 mr-8 bg-red-500 hover:bg-red-400 rounded-full transition-all duration-200 text-white">Uložit</button>
                                </div>
                            </form>    
                        </div>';
                    }
                }
            }
        ?>
        </div>
    </div>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
