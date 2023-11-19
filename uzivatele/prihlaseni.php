<?php
    session_start();
    $server = "localhost";
    $uzivatel = "root";
    $heslo = "";
    $db = "carlend";

    $zprava = "";

    if(isset($_POST["email"])) {
        $pripojeni = mysqli_init();
        if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
            die("Chyba při připojování k databázi");
        }
        else {
            $sql = "SELECT * FROM uzivatele WHERE email = '{$_POST["email"]}'";
            $vys = mysqli_query($pripojeni, $sql);

            if(mysqli_num_rows($vys) == 1) {
                $radek = mysqli_fetch_array($vys);

                if(sha1($_POST["heslo"]) == $radek["heslo"]) {
                    $_SESSION["id"] = $radek["id_u"];
                    $_SESSION["jmeno"] = $radek["jmeno"];
                    $_SESSION["uzivatel"] = $radek["email"];
                    $_SESSION["role"] = $radek["role"];
                    header("Location: ../index.php");
                    exit;
                }
                else {
                    $zprava = "Chybně zadané přihlašovací údaje";
                }
            }
            else {
                $zprava = "Chybně zadané přihlašovací údaje";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth ">
    <?php
        $title = "Přihlášení";
        $index = 0;
        require_once '../soubory/header.php';
    ?>
    
<body class="font-exo scroll-smooth overflow-x-hidden bg-red-50" >
    <?php
        require_once '../soubory/menu.php';
    ?>

  <div class="container mx-auto min-h-screen flex justify-center items-center">
    
    <form action="prihlaseni.php" method="post" class="flex flex-col bg-white shadow-xl rounded-xl p-14 space-y-6 ">
        <h1 class="text-gray-900 text-3xl title-font font-semibold text-center">Přihlášení uživatele</h1>

        <div class="text-center text-red-400 ">
            <?php
                if($zprava != "") {
                    echo $zprava;
                }
            ?>
        </div>
        <?php
            if(isset($_GET["registrace"])) {
                echo '
                <div class="text-center bg-green-200 text-green-500 rounded-full py-1">
                    Registrace byla úspěšná
                </div>';
            }
        ?>
        <div class="flex items-center px-4 border-2 shadow rounded-lg w-full">
            <i class="ri-mail-fill text-xl mr-1"></i>
            <input name="email" type="email" placeholder="E-mail" class="w-full p-2 focus:outline-none" required>
        </div>
        <div class="flex items-center px-4 border-2 shadow rounded-lg w-full">
            <i class="ri-lock-fill text-xl mr-1"></i>
            <input name="heslo" type="password" placeholder="Heslo" class="w-full p-2 focus:outline-none" required>
        </div>
        <button type="submit" class="w-full px-6 py-2 font-medium tracking-wide text-white transition duration-200 rounded-full shadow-md bg-red-500 hover:bg-red-400">Přihlásit se</button>
        <div class="flex w-full justify-center">
            <p class="mr-5 font-light tracking-wide transition duration-200 rounded-full text-gray-300">Ještě nemáte účet?</p>
            <a href="registrace.php" class="font-medium tracking-wide transition duration-200 rounded-full text-red-500">Zaregistrovat se</a>
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
