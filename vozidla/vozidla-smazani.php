<?php
    session_start();
    $server = "localhost";
    $uzivatel = "root";
    $heslo = "";
    $db = "carlend";

    $zprava = "";
    $pripojeni = mysqli_init();
    if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
        die("Chyba při připojování k databázi");
    }
    if(isset($_SESSION["role"])) {
        if($_SESSION["role"] == 1) {
            if(isset($_GET["vozidlo"])) {
                $sql = "DELETE FROM vozidla WHERE id_v=" . $_GET["vozidlo"];

                try {
                    mysqli_query($pripojeni, $sql);
                    header("Location: vozidla.php");
                } catch (Exception $e) {
                    header("Location: vozidla.php?chyba=1");
                }
            }
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