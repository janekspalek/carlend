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
        if(isset($_GET["rezervace"])) {
            $sql = "DELETE FROM rezervace WHERE id_r=" . $_GET["rezervace"] . " AND uzivatel=" . $_SESSION["id"];
        
            if(mysqli_query($pripojeni, $sql)) {
                header("Location: moje-rezervace.php");
            }
            else {
                echo "Chyba: " . mysqli_error($pripojeni);
            }
        }
    }
    else {
        echo '
        <h2 class="font-bold text-xl w-full text-center bg-red-500 py-5 text-white">Nejste přihlášen!</h2>
        <a href="../uzivatele/prihlaseni.php" class="w-full text-center ml-5 font-semibold text-xl">Přihlásit se</a>';
    }
?>