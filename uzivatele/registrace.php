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
                    header("Location: prihlaseni.php?registrace=1");
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
    $title = "Registrace";
    $index = 0;
    require_once '../soubory/header.php';
?>
<body class="font-exo scroll-smooth overflow-x-hidden bg-red-50" >
    <?php
        require_once '../soubory/menu.php';
    ?>
    <div class="container mx-auto min-h-screen flex justify-center items-center">
        <form action="registrace.php"  method="post" class="flex flex-col bg-white shadow-xl rounded-xl p-14 space-y-6">
            <h1 class="text-gray-900 text-3xl title-font font-semibold text-center">Registrace uživatele</h1>
            <div class="text-center text-red-400 ">
                <?php
                    if($zprava != "") {
                        echo $zprava;
                    }
                ?>
            </div>
            <div class="justify-center  space-y-5 w-full md:flex md:space-x-10 md:space-y-0">
                <div class="flex items-center justify-evenly px-4 border-2 shadow rounded-lg w-full">
                    <i class="ri-user-3-fill text-xl mr-1"></i>
                    <input type="text" name="jmeno" placeholder="Jméno *" class="w-full p-2 focus:outline-none" required>
                </div>
                <div class="flex items-center px-4 border-2 shadow rounded-lg w-full">
                    <i class="ri-user-3-fill text-xl mr-1"></i>
                    <input type="text" name="prijmeni" placeholder="Příjmení *" class="w-full p-2 focus:outline-none" required>
                </div>
            </div>

            <div class="flex items-center px-4 border-2 shadow rounded-lg w-full">
                <i class="ri-mail-fill text-xl mr-1"></i>
                <input type="email" name="email" placeholder="E-mail *" class="w-full p-2 focus:outline-none" required>
            </div>

            <div class="flex items-center px-4 border-2 shadow rounded-lg w-full">
                <i class="ri-phone-fill text-xl mr-1"></i>
                <select name="telcislopredvolba" id="telcislopredvolba">
                    <option value="+420" selected>(+420)</option>
                    <option value="+421">(+421)</option>
                </select>
                <input type="tel" name="telcislo" pattern="[0-9]{9}" placeholder="Telefonní číslo *" class="w-full p-2 focus:outline-none" required>
            </div>

            <div class="flex items-center px-4 border-2 shadow rounded-lg w-full">
                <i class="ri-lock-fill text-xl mr-1"></i>
                <input type="password" name="heslo" placeholder="Heslo *" class="w-full p-2 focus:outline-none" required>
            </div>

            <div class="flex items-center px-4 border-2 shadow rounded-lg w-full">
                <i class="ri-lock-fill text-xl mr-1"></i>
                <input type="password" name="heslo2" placeholder="Potvrzení hesla *" class="w-full p-2 focus:outline-none" required>
            </div>
            <button type="submit" class="w-full px-6 py-2 font-medium tracking-wide text-white transition duration-200 rounded-full shadow-md bg-red-500 hover:bg-red-400">Registrovat se</button>
            <div class="flex w-full justify-center">
                <p class="mr-5 font-light tracking-wide transition duration-200 rounded-full text-gray-300">Již máte účet?</p>
                <a href="prihlaseni.php" class="font-medium tracking-wide transition duration-200 rounded-full text-red-500">Přihlásit se</a>
            </div>

        </form>
    </div>

    <?php
      require_once '../soubory/footer.php';
    ?>

    <script src="https://unpkg.com/aos@next/dist/aos.js" ></script>
    <script>AOS.init();</script>
</body>
</html>
