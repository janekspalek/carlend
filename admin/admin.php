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
    $title = "Nástěnka";
    $index = 0;
    require_once '../soubory/header.php';

    if(isset($_SESSION["role"])) {
        if($_SESSION["role"] == 1) {
            echo '
            <body class="font-exo scroll-smooth overflow-x-hidden">
                <div class="flex w-full">';
                    require_once 'admin-panel.php';

                    echo '
                    <div class="flex-1 bg-red-50 p-20">
                        <div>
                            <h1 class="font-bold text-3xl text-gray-800 mb-10 underline underline-offset-8">Nástěnka</h1>
                        </div>
                        <div class="grid grid-cols-3 gap-8 ">
                            <a href="../rezervace/rezervace.php" class=" bg-white shadow-xl py-16 px-32 text-center rounded-xl flex items-center justify-center transition-all hover:bg-gray-100">
                                <i class="ri-loader-2-line pr-5 text-6xl text-red-500"></i>
                                <div>';
                                    $pripojeni = mysqli_init();
                                    if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
                                        die("Chyba při připojování k databázi");
                                    }
                                    else {
                                        $sql = "SELECT COUNT(*) FROM rezervace WHERE stav=2";
                                        $pocetRezervaci = mysqli_query($pripojeni, $sql)->fetch_column();
                                        echo '<p class="font-bold text-4xl">' . $pocetRezervaci . '</p>
                                        <p>Čekajících rezervací</p>';
                                    }
                                    echo '
                                </div>
                            </a>
                            <a href="../rezervace/rezervace.php" class=" bg-white shadow-xl py-16 px-32 text-center rounded-xl flex items-center justify-center transition-all hover:bg-gray-100">
                                <i class="ri-price-tag-3-fill pr-5 text-6xl text-red-500"></i>
                                <div>';
                                    $pripojeni = mysqli_init();
                                    if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
                                        die("Chyba při připojování k databázi");
                                    }
                                    else {
                                        $sql = "SELECT COUNT(*) FROM rezervace";
                                        $pocetRezervaci = mysqli_query($pripojeni, $sql)->fetch_column();
                                        echo '<p class="font-bold text-4xl">' . $pocetRezervaci . '</p>
                                        <p>Rezervací celkem</p>';
                                    }
                                    echo '
                                </div>
                            </a>
                            <a href="../vozidla/vozidla.php" class=" bg-white shadow-xl py-16 px-32 text-center rounded-xl flex items-center justify-center transition-all hover:bg-gray-100">
                                <i class="ri-car-fill pr-5 text-6xl text-red-500"></i>
                                <div>';
                                    $pripojeni = mysqli_init();
                                    if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
                                        die("Chyba při připojování k databázi");
                                    }
                                    else {
                                        $sql = "SELECT COUNT(*) FROM vozidla";
                                        $pocetVozidel = mysqli_query($pripojeni, $sql)->fetch_column();
                                        echo '<p class="font-bold text-4xl">' . $pocetVozidel . '</p>
                                        <p>Vozidel</p>';
                                    }
                                    echo '
                                </div>
                            </a>
                            <a href="../uzivatele/uzivatele.php" class=" bg-white shadow-xl py-16 px-32 text-center rounded-xl flex items-center justify-center transition-all hover:bg-gray-100">
                                <i class="ri-user-3-fill pr-5 text-6xl text-red-500"></i>
                                <div>';
                                    $pripojeni = mysqli_init();
                                    if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
                                        die("Chyba při připojování k databázi");
                                    }
                                    else {
                                        $sql = "SELECT COUNT(*) FROM uzivatele";
                                        $pocetUzivatelu = mysqli_query($pripojeni, $sql)->fetch_column();
                                        echo '<p class="font-bold text-4xl">' . $pocetUzivatelu . '</p>
                                        <p>Uživatelů</p>';
                                    }
                                    echo '
                                </div>
                            </a>
                            <a href="../kategorie/kategorie.php" class=" bg-white shadow-xl py-16 px-32 text-center rounded-xl flex items-center justify-center transition-all hover:bg-gray-100">
                                <i class="ri-grid-fill pr-5 text-6xl text-red-500"></i>
                                <div>';
                                    $pripojeni = mysqli_init();
                                    if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
                                        die("Chyba při připojování k databázi");
                                    }
                                    else {
                                        $sql = "SELECT COUNT(*) FROM kategorie";
                                        $pocetKategorii = mysqli_query($pripojeni, $sql)->fetch_column();
                                        echo '<p class="font-bold text-4xl">' . $pocetKategorii . '</p>
                                        <p>Kategorií</p>';
                                    }
                                    echo '
                                </div>
                            </a>
                            <a href="../rezervace/rezervace.php" class=" bg-white shadow-xl py-16 px-32 text-center rounded-xl flex items-center justify-center transition-all hover:bg-gray-100">
                                <i class="ri-bank-card-fill pr-5 text-6xl text-red-500"></i>
                                <div>';
                                    $pripojeni = mysqli_init();
                                    if(!mysqli_real_connect($pripojeni, $server, $uzivatel, $heslo, $db)) {
                                        die("Chyba při připojování k databázi");
                                    }
                                    else {
                                        $sql = "SELECT SUM(cena) FROM rezervace WHERE stav = 3";
                                        $trzbyCelkem = mysqli_query($pripojeni, $sql)->fetch_column();
                                        echo '<p class="font-bold text-4xl">' . ($trzbyCelkem ?? 0) . '</p>
                                        <p>Tržby celkem [Kč]</p>';
                                    }
                                    echo '
                                </div>
                            </a>
                        </div>
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

<?php
    if(isset($_SESSION["role"])) {
        if($_SESSION["role"] == 1) {
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