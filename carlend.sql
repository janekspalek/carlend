-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 13. bře 2023, 17:46
-- Verze serveru: 10.4.27-MariaDB
-- Verze PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `carlend`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `kategorie`
--

CREATE TABLE `kategorie` (
  `id_k` int(11) NOT NULL,
  `nazev` varchar(30) NOT NULL,
  `sleva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `kategorie`
--

INSERT INTO `kategorie` (`id_k`, `nazev`, `sleva`) VALUES
(1, 'SUV', 200),
(2, 'Dodávka', 100),
(4, 'Osobní vůz', 200);

-- --------------------------------------------------------

--
-- Struktura tabulky `opravneni`
--

CREATE TABLE `opravneni` (
  `id_o` int(11) NOT NULL,
  `nazev` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `opravneni`
--

INSERT INTO `opravneni` (`id_o`, `nazev`) VALUES
(1, 'admin'),
(2, 'uzivatel');

-- --------------------------------------------------------

--
-- Struktura tabulky `rezervace`
--

CREATE TABLE `rezervace` (
  `id_r` int(11) NOT NULL,
  `datum_rezervace` date NOT NULL,
  `rezervace_zacatek` date NOT NULL,
  `rezervace_konec` date NOT NULL,
  `uzivatel` int(11) NOT NULL,
  `vozidlo` int(11) NOT NULL,
  `stav` int(11) NOT NULL,
  `popis` varchar(255) DEFAULT NULL,
  `cas_vyzvednuti` time NOT NULL,
  `cena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `rezervace`
--

INSERT INTO `rezervace` (`id_r`, `datum_rezervace`, `rezervace_zacatek`, `rezervace_konec`, `uzivatel`, `vozidlo`, `stav`, `popis`, `cas_vyzvednuti`, `cena`) VALUES
(92, '2023-02-05', '2023-02-05', '2023-02-08', 16, 19, 3, '', '15:00:00', 18000),
(93, '2023-02-05', '2023-02-26', '2023-03-05', 12, 11, 4, '', '07:30:00', 33950),
(94, '2023-02-05', '2023-04-06', '2023-05-26', 11, 15, 1, '', '16:45:00', 420000),
(95, '2023-02-05', '2023-03-16', '2023-03-19', 11, 12, 2, '', '20:00:00', 6000),
(96, '2023-02-06', '2023-02-08', '2023-02-09', 1, 17, 2, '', '13:00:00', 10000),
(97, '2023-03-09', '2023-03-09', '2023-03-12', 7, 9, 1, '', '03:12:00', 7200),
(98, '2023-03-09', '2023-03-29', '2023-04-02', 7, 13, 2, 'Platba hotově', '23:13:00', 13600),
(104, '2023-03-12', '2023-03-13', '2023-03-20', 1, 10, 4, '', '13:22:00', 67900),
(105, '2023-03-12', '2023-03-29', '2023-03-31', 1, 7, 2, '', '14:53:00', 8000),
(106, '2023-03-12', '2023-03-27', '2023-03-31', 1, 15, 2, '', '15:53:00', 35200);

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

CREATE TABLE `uzivatele` (
  `id_u` int(11) NOT NULL,
  `jmeno` varchar(30) NOT NULL,
  `prijmeni` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telcislo` varchar(13) NOT NULL,
  `heslo` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT INTO `uzivatele` (`id_u`, `jmeno`, `prijmeni`, `email`, `telcislo`, `heslo`, `role`) VALUES
(1, 'Jonatan', 'Lepík', 'jonatan.lepik@gmail.com', '702009724', '66cac5df6a9889fb4d16e0815f10a636bcfa9bc5', 1),
(7, 'Jan', 'Novák', 'jan.novak@gmail.com', '777888999', 'b5906bb2f07b2f525aabb8b546e562b634472892', 2),
(8, 'Petr', 'Nový', 'petr.novy@gmail.com', '+420748547965', '98eacd83e5a5b388beaa2eb620d084c56fc2697f', 2),
(9, 'Milan', 'Tomek', 'milan.tomek@gmail.com', '+421748547854', '10eff3944924a441b250cf97eeec5a4815a2a235', 2),
(10, 'Jan', 'Javorský', 'jan.javorsky@gmail.com', '+420752143929', '05dec2930346c9b8de0b4fd3f7ac09bcf478db04', 2),
(11, 'Radim', 'Řezník', 'radim.reznik@gmail.com', '+420512685357', '9db32f36dc134a563c26f888949fdf909cbafe92', 2),
(12, 'Svatoslav', 'Matula', 'svatoslav.matula@gmail.com', '+420745985365', 'a9566ad09b3070bc5a921fdee6fbcf20048a4fda', 2),
(13, 'Jakub', 'Fous', 'jakub.fous@gmail.com', '+420512654365', '541d0c035ab9d4d709db0fdb4ce18cb2ff3f7d7c', 2),
(14, 'David', 'Hejduk', 'david.hejduk@gmail.com', '+420312658731', 'b064ae50d22b22ac5dc8f72cb79a0b0d077ded9b', 2),
(15, 'Michal', 'Škoda', 'michal.skoda@gmail.com', '+420526953123', '8b2044959db07379ae2dcdaf1f670373f92cf4de', 2),
(16, 'Igor', 'Klouda', 'igor.klouda@gmail.com', '+421659874123', 'de5cc8bab2717d62f492dea1ce35caa756d7a2ad', 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `vozidla`
--

CREATE TABLE `vozidla` (
  `id_v` int(11) NOT NULL,
  `nazev` varchar(50) NOT NULL,
  `popis` varchar(700) NOT NULL,
  `motor` varchar(30) NOT NULL,
  `pocetmist` int(2) NOT NULL,
  `obrazek` varchar(1000) NOT NULL,
  `dostupnost` tinyint(4) NOT NULL,
  `palivo` varchar(15) NOT NULL,
  `prevodovka` varchar(15) NOT NULL,
  `kategorie` int(11) NOT NULL,
  `rok` varchar(4) NOT NULL,
  `cena` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `vozidla`
--

INSERT INTO `vozidla` (`id_v`, `nazev`, `popis`, `motor`, `pocetmist`, `obrazek`, `dostupnost`, `palivo`, `prevodovka`, `kategorie`, `rok`, `cena`) VALUES
(6, 'Mercedes Třída T', 'Nová Třída T – třída sama pro sebe a pro Vás: objevte nyní první prémiovou malou dodávku značky Mercedes-Benz. Tento multitalent je ideálním společníkem pro každodenní rodinný život i dobrodružství ve volném čase. Těšte se na prostornost a funkčnost, komf', '2.0 TDI 96 kW', 5, 'https://assets.oneweb.mercedes-benz.com/bbd/images/v1/5095/2/f4/71402a0165b2f2964b2e7cf143087b827ff39.png?im=Crop,rect=(70,35,460,260);Resize,width=700', 1, 'Diesel', 'Automatická', 2, '2022', 700000),
(7, 'Mercedes EQV', 'Od ikonického designu až po dechberoucí MBUX Hyperscreen: EQE je spojení smyslné estetiky. a průkopnického inženýrskému umu na nejvyšší úrovni. Zažijte novou éru elektromobility. Akční nabídky. AMG. Služby: Compact, Excellent, Advance.', 'Elektrický 215 kW', 8, 'https://assets.oneweb.mercedes-benz.com/iris/iris.jpg?COSY-EU-100-1713d0VXq7xoqtyO67PobzIr3eWsrrCsdRRzwQZUOBJGE1UHFm9hNF9QC%25NjDd9wig8E9VSeJdfqxVz4cR1q4c%25xXGmqW1J0hR1wOB%25xBZbAyPxFI5zIu9QC7QkDkzK0kWm7vwhdhKL59f%25vassEyLHUrlYa7zV2rHK7opn8vKZuoiL6x3M4a30NTgHHCj6PyDAVSeYS7qtsrtXRcUnc8xXGoY71J0M12wOBd6wZbAD3gFI5WN39QCdh2DkzfDDWm7EZPdhKloef%25vXxDEyLJxxlYaOFl2rHb9Hpn8fJ8uoiELx3M4zl8NTg39Dj6PNdtVSejdFqtsVqfRcUjcUxXGVNG1J0Oj1wOBbXfZbAIUQFI5QGP9QCk0ADkzmBjWm7PXWdhKeJyf%25vs2vEyLUMUlYaGlV2rHaropn8HnCuoi8IF3M4iL5NTg4lij6PqLAVSeRcFqtyKmg3w507RKpL%251W6sdRUe4JJBLwaGpUax2HL7o7dedIP%25Yb4QPXAJaNUa&imgt=P27&bkgnd=9&pov=BE040&uni=cs&im=Crop,rect=(380,240,1200,600);Resize,width=700', 1, 'Elektřina', 'Automatická', 2, '2022', 2000000),
(8, 'Mercedes CLA', 'CLA kupé s technologií plug-in hybrid spojuje dynamiku a účinnost elektromotoru s dojezdem spalovacího motoru pro dosažení celkového výkonu až 160 kW a maximálního točivého momentu 450 Nm. Středem pozornosti je stejnou měrou radost z dynamické jízdy a vhodnost pro každodenní použití, které se navzájem doplňují novým, napínavým způsobem. Elektromotor poskytuje dodatečný výkon při zrychlování nebo také zcela samostatně pohání vozidlo při jízdě ve městě na vzdálenost až 78 kilometrů, takže velkou část svých každodenních cest můžete pohodlně vyřídit bez lokálních emisí.', '1.95 TSI 160 kW', 5, 'https://assets.oneweb.mercedes-benz.com/iris/iris.jpg?COSY-EU-100-1713d0VXqNEFqtyO67PobzIr3eWsrrCsdRRzwQZxkIZbMw3SGtGyStsd2sDcUfp8qXGEubXJ0l3ofOB2NbFbApRTyI5ux6ZQC30gTkzNBUnm7jAyvhKViSF%25vq4vZyLRgY6Yax%250qrH1yM%25n8w0zEoiZB%25YM4FAOMTg9LQT6PDa%25mSeWFyutsdBY%25cUfAyYXOc6VRjIcrH1CHln8w5EyLJwGlYa%25u12rHAgMpn8obMuoiMIH3M4TW9NTg6apj6hzQipxBUCVzh3nrsSPDVeg8ccGKxvslevqELKCrCDgDO4m%25J8b4t0cvuev&imgt=P27&bkgnd=9&pov=BE040&uni=c&im=Crop,rect=(50,-25,1370,770),gravity=Center;Resize,width=700', 1, 'Benzín, hybrid', 'Automatická', 4, '2023', 1500000),
(9, 'Mercedes C kupé', 'CLA kupé s technologií plug-in hybrid spojuje dynamiku a účinnost elektromotoru s dojezdem spalovacího motoru pro dosažení celkového výkonu až 160 kW a maximálního točivého momentu 450 Nm. Středem pozornosti je stejnou měrou radost z dynamické jízdy a vhodnost pro každodenní použití, které se navzájem doplňují novým, napínavým způsobem. Elektromotor poskytuje dodatečný výkon při zrychlování nebo také zcela samostatně pohání vozidlo při jízdě ve městě na vzdálenost až 78 kilometrů, takže velkou část svých každodenních cest můžete pohodlně vyřídit bez lokálních emisí.', '1.95 TSI 150 kW', 5, 'https://assets.oneweb.mercedes-benz.com/iris/iris.jpg?COSY-EU-100-1713d0VXqNEFqtyO67PobzIr3eWsrrCsdRRzwQZQ9vZbMw3SGtGyStsd2sDcUfp8qXGEubYJ0lVYrOB2qrubApRTyI5ux6ZQC31SWkzNBPnm7jAyZhKViSF%25vq4tayLRgLFYaxPrWrH1yC%25n8w0z3oiZB7IM4FAyrTg95Ye6PDak6SeWHXutsd8Y%25cUfiM0XGE5nYJ0lCrnOIJtR1qkJoiZCkuM4F8CQTg9ivO6PD4cDSeWgXhtsdPZVcUfx9zXGE0ySJ0lBYrOB2A8cbAp5iCI5uC4MQCPFi2J%25xVZkF7p8G3i3MkNulKKqD%25WjcNWmtdDZGZMuMapgeLlHp7RKWONW&imgt=P27&bkgnd=9&pov=BE040&uni=c&im=Crop,rect=(75,-25,1370,770),gravity=Center;Resize,width=700', 1, 'Benzín, hybrid', 'Automatická', 4, '2020', 1200000),
(10, 'Mercedes SL Roadster', 'Nový vůz Mercedes-AMG SL Roadster dělá čest své historii: výkonné hnací ústrojí se čtyřválcovým motorem pro SL 43 a motorem V8 pro SL 55 4MATIC+ a SL 63 4MATIC+, prvotřídní aerodynamika a inteligentní odlehčená konstrukce formují efektivní jednotku. V kombinaci s vysoce moderním podvozkem se sportovní charakter a komfort transformuje v unikátní zážitek z jízdy.', '4.4 V8 430 kW', 2, 'https://assets.oneweb.mercedes-benz.com/iris/iris.jpg?COSY-EU-100-1713d0VXqrWFqtyO67PobzIr3eWsrrCsdRRzwQZgk4ZbMw3SGtGyStsd2HdcUfpOyXGEuTRJ0lVYrOB2qBEbApRTyI5uGoIQC30hQkzNBlNm7j86ohKViKw%25vq4yjyLRsGWYaxUoWrH1zJrn8w78foiZKq1M4FvyMTg9LY96PDaSbSeWHthtsd8BQcUfiA1XGEWbSJ0lCrnOIJtR1qkJoiZ7MEM4FzR0Tg9jiX6PDecNSeWswhtsdUcDcUaqKDTb32VXq0Y3If3f%25XEd9BBpxb1loE1JnwxV4V%25d%25CWLH59zW0uB16E1&imgt=P27&bkgnd=9&pov=BE040,DZO&uni=c&im=Crop,rect=(0,-25,1370,770),gravity=Center;Resize,width=700', 1, 'Benzín', 'Automatická', 4, '2023', 5000000),
(11, 'Mercedes Třída V', 'Třída V může sloužit jako vůz pro komerční účely, ale i jako rodinná dodávka. S možností výběru ze tří délek. Místo k sezení až pro 8 osob. Prostorná. upoutává pozornost. Luxusní sedadla. soundsystém Burmester.', '2.5 TDI 174 kW', 8, 'https://assets.oneweb.mercedes-benz.com/iris/iris.jpg?COSY-EU-100-1713d0VXq77LqtyO67PobzIr3eWsrrCsdRRzwQZUVB%25GE1UHFm9h3N9WF184HfFj6PXWdVRjCitqxViedRcUbgDxXGmNG1J0hRdwOB%25xwZbAy1AFI5Ye19QCrpCDkz5czWm7vmjdhKLh%25f%25va5sEyLHCylYa87d2rHi00pn84BMuoigTH3M4aL5NTgHaSj6P8HWVSeip3qts4fNRcUgdJxXGPxO1J0eeawOBsIGZbAQDZFI5Sua9QCt34DkzcNsWm7XmPdhKJhyf%25vOcgEyLbELlYaInA2rHVkfpn8NFZuoij6x3M4V33NTgq2Cj6PR8ZVSe%25f3qtsy29RcUYpUxXGruL1J0n3bwOBolRZbAM2AFI5x5B9QC1zmDkzwBpWm7Z3CdhKF74f%25vmKgEyLhUPlYaBWV2rHAd2pn82kCuoip9x3M4uD2NTg3WSj6PNQAVSejkFqtsVmsRcUqhvxXGRbW1J0xIqwOB1wpZbAwQQFI51I59QCwQNDkzZqgWm7FR%25dhK9ZKf%25vyFfEyLYhjlYar7n2rHnK5pn8ovauoiMLF3M45h3NTgC%25Sj6PzRPVSe783qtsKbfRcUvRDxXGL5s1J0GJbwOB0O4ZbABouFI5AU59QC5GADkzC18Wm7fGidhKEy3f%25v1rfEyJUt7Dug8slUF0XpqvLRlavznni0uBHFaB2ZA0sQsRvRTKXOMz6Kr4nBWaB&imgt=P27&bkgnd=9&pov=BE040&uni=c&im=Crop,rect=(500,280,1050,520);Resize,width=700', 1, 'Diesel', 'Automatická', 2, '2021', 2500000),
(12, 'Mercedes Třída A', 'Třída sama pro sebe. Automobilní luxus pro každý den: Třída A Hatchback spojuje suverénní sportovní charakter s komfortem vyšší třídy a přináší do kompaktního segmentu novou dynamiku. Objevte flexibilního průvodce pro každodenní jízdy, který je připraven na jakoukoliv výzvu.', '1.5 TDI 135 kW', 5, 'https://assets.oneweb.mercedes-benz.com/iris/iris.jpg?COSY-EU-100-1713d0VXqNEFqtyO67PobzIr3eWsrrCsdRRzwQZxkIZbMw3SGtGyStsd2sDcUfp8cXGEuiRJ0l3DAOB2qM%25bApUnRI5uG62QC30STkzNHTwm7j87mhKViKw%25vq4yTyLRhGVYax%25ohrH1GCfn8w0hyoiZBJoM4FvIMTg9LhT6PDar6SeWHnRtsd8c%25cUfiA1XGEWnjJ0lCrnOIJtR1qkJoiZCkuM4F8SQTg9jfs6PDePmSeWsKMtsdUvGcUfGLyXGE0bRJ0lBorOB2AWcbA4wHEcmqN1Iw4jiM35pnIu2fzzjFm93Su9Q6DF1s1n2nvligKfLlCVz9Xu9&imgt=P27&bkgnd=9&pov=BE040&uni=c&im=Crop,rect=(0,-25,1370,770),gravity=Center;Resize,width=700', 1, 'Diesel', 'Automatická', 4, '2021', 1000000),
(13, 'Mercedes GLE', 'GLE jako aktuálně největší SUV s pohonem plug-in hybrid od Mercedes-Benz těží u obou motorů zejména z aktuálního stavu technologického pokroku. Ten se projevuje delším dojezdem na elektrický pohon, zvětšeným akumulátorem, rychlejším nabíjením na cestách a hlavně ještě větším požitkem z jízdy na elektrický pohon.', '4.4 V8 440 kW', 5, 'https://assets.oneweb.mercedes-benz.com/iris/iris.jpg?COSY-EU-100-1713d0VXq0WFqtyO35PobzIExXrItvsTQKkojUfGoo7GE11KFm9mWa9Q6FjcBXBUuXGEAJ3J0l5CNOB29QjbApDdVI5uWc1QC3dXRkzNRTxm7jx7DhKV10V%25vqwBdyLRZnmYaxFoYrH19MOn8wDQxoiZW%25EM4FdyMTg9fY36PDEGDSeWuyItsd3YVcUfNF6XGEj9RJ0lVDZOB2s8%25bApUtwI5uGQYQC30kTkzNHTwm7j86ohKViKh%25vq4BlyLRgnVYaxPbSrH1entn8wso3oiZUMdM4FnCwTg9otn6PDM1FSeWze3tsd7vdcUfKLjXGEvTSJ0lLCqOB2Pr%25bApekRI5usfzQC3UEpkzNGJkm7j0ODhKVBbL%25vqAykyLR5iDYaxC4prH1qJtn8wR82oiZx5NM4F1RwTg9wYO6PDG%25bSeW0h%25tXSMNV3OSyLRAnHYaxBdhKcJgf%25vmONEyLhpBlYa%25u12rHyFHpn8YK8uoirL93M4zF1NTg7Sqj6PSDZVSetWgqtsctCRcUXcjxXGJYV1J0OrUwOBb9vZbAIquFITin0xdL789iTSMcZA5u9CAGmmKgdPzqCPDVeg8c8uAuyBM6%25GYBkvmP1CP&imgt=P27&bkgnd=9&pov=BE040&uni=c&im=Crop,rect=(75,-25,1370,770),gravity=Center;Resize,width=700', 1, 'Benzín, hybrid', 'Automatická', 1, '2022', 1800000),
(15, 'Mercedes Třída G', 'Před dlouhým časem vyvinuli inženýři ve Štýrském Hradci zcela nový druh DNA. DNA terénního vozidla: ikonického, robustního a téměř nezničitelného. Navrhli díly, jejichž funkce dodnes beze změny splňují svůj účel. Součásti, které po celé generace vytvářely zcela vlastní charakter. Silný terénní výkon výchozím bodem i cílem Třídy G. Již od nepaměti stanovuje měřítka v oblasti stoupavosti, hloubky brodění a náklonu.', '4.0 V8 twin-turbo', 5, 'https://assets.oneweb.mercedes-benz.com/iris/iris.jpg?COSY-EU-100-1713d0VXq0WFqtyO67PobzIr3eWsrrCsdRRzwQZQ9vZbMw3SGt0h%25tXSMNV3OSyLRPOVYaxe4SrH1sbtn8wFNnoiZ9gNM4FDPwTg91Y36PDwmbSeWZg9tsdFGDcUfOLqXGEHnwJ0lUOtOB2ZnnbApFcXI5uJQuQC3FSWkzN9Sbm7jDbShKVWnh%25vqVIkyLRrGmYaBEUVmMDZfrEQ5fA4zxXr1RjiiF2MpwQ1pnIu2fzfXRXPq0Agjeq89iph1p&imgt=P27&bkgnd=9&pov=BE040&uni=c&im=Crop,rect=(-50,-25,1370,770),gravity=Center;Resize,width=700', 1, 'Benzín', 'Automatická', 1, '2020', 4500000),
(17, 'Mercedes Maybach Třída S', 'V zadní části First Class cestujete stejně komfortně jako v soukromém letadle. Business středová konzola nabízí cestujícím v zadní části vizuální a funkční výhodu. Rozmazluje například temperovanými držáky nápojů a odkládacími prostory pod elektricky odklopným krytem. Svůj chytrý telefon nabijete induktivně, a tudíž bezdrátově pod loketní opěrkou.', '6.0 V12 450 kW', 4, 'https://assets.oneweb.mercedes-benz.com/iris/iris.jpg?COSY-EU-100-1713d0VXqbSFqtyO67PobzIr3eWsrrCsdRRzwQZgk4ZbMw3SGtGyStsd2spcUfpLcXGEuiXJ0l34AOB2NQnbApjtwI5uVczQC3qkOkzNRLkm7jxafhKVFSQ%25vq9tayLRDLVYaxW0SrH1dBln8wfQcoiZLbXM4FaIrTg9HgT6PD8LoSeWiahtsd4JtcUfgOqXGEPbwJ0leohOB2sMcbApUTbI5uLoYQC3aMQkzNH%25wm7j8ymhKVipM%25vq4ukyLRgYmYaxPrprH1yHDn8w0A4oiZB5lM4FAKuTg95Yp6PDCSuSeWHmStsd8s3cUfiONXGE49dJ0lg6lOB2PSEbApeIyI5usQJQC3Uk3kzNGm6m7j0aohKVBHN%25vqNtayLRjc2YaxVohrH1gJln8wPbIoTnylpESnQC3sMOkzNeZbAMoaFI5OMl9QCbV9Dkze0pWm7hjUdhK%25hKf%25vy%25REyLYXUlYarIG2rb0XvdNe4Gp0oxGSz0H1p8aKMMgAN5iD85u9CAGmG1a1SLOI6KtLoPM5f85&imgt=P27&bkgnd=9&pov=BE040&uni=c&im=Crop,rect=(25,-25,1370,770),gravity=Center;Resize,width=700', 1, 'Benzín', 'Automatická', 4, '2023', 5000000),
(18, 'Mercedes Třída E kombi', 'Kombi Třídy E je vytvořeno tak, aby zvládalo všechny výzvy všedního dne. S veskrze dynamickým designem, intuitivním plně digitálním kokpitem a zavazadlovým prostorem, který nemůže být velkorysejší. Kombi Třídy E poskytuje dostatek prostoru kvalitním materiálům a inteligentním inovacím.', '3.0 TDI 243 kW', 5, 'https://assets.oneweb.mercedes-benz.com/iris/iris.jpg?COSY-EU-100-1713d0VXq5WFqtyO67PobzIr3eWsrrCsdRRzwQZgk4ZbMw3SGtGyStsd1YbcUfpUWXGEuiEJ0l34xOB2NQnbApjI9I5uxoMQC31MjkzNwtnm7jAhShKViSF%25vq4v%25yLRhcVYax%255hrH1GBln8w0z3oiZKboM4FvRwTg9LYT6PDaSlSeWH0utsd8BQcUfiA1XGE5YrJbXSqxVQXn8wzTcoiZC5lM4F84FTg9ig36PD4cmSeWgwjtsdUsTcUfGLqXGE0aYJ0lBOtOBi1aftkV3xb15Xx4JA2rbpldCCNZkFu6pFIT9ZxexrlrKE847dvE5jCFcpF&imgt=P27&bkgnd=9&pov=BE040&uni=c&im=Crop,rect=(25,-25,1370,770),gravity=Center;Resize,width=700', 1, 'Diesel', 'Automatická', 4, '2022', 2000000),
(19, 'Mercedes GLS', 'Nové GLS je přesně takovým autem, jaké automobilka potřebovala. Jde o super moderní SUV, které hravě předčí vaše očekávání. Ať už ohromným výkonem, jízdními vlastnostmi, terénními dovednostmi nebo opravdovým luxusem.', '4.0 V8 360 kW', 4, 'https://assets.oneweb.mercedes-benz.com/iris/iris.jpg?COSY-EU-100-1713d0VXq0WFqtyO67PobzIr3eWsrrCsdRRzwQZQ9vZbMw3SGtGyStsd2vGcUfp8cXGEuiRJ0l34pOB2NQcbApjkoI5uVfzQC3qXFkzNwL6m7jA6ohKV5Kh%25vqCBayLRzYXYaxPXWrH1eJtn8ws8noiZUMXM4FGTjTg906E6PDM7FSeWTXMtsd7vtcUfKLjXGE4yXJ0lg0VOB2PQqbApekwI5uscuQC3UX7kzNGm6m7j0aZhKV3SM%25vqNtkyLRjnMYax4a8rH1gObnMr%25E2f6rI5ue52QC3PswkzN5zdm7jC2jhKVvSM%25vqLtjyLRaLmYaBEUVmMDZfrEB50PxJxXr1RjiiF2MpwQ1pnIu2fzfXRXPq0Agjeq89iph1p&imgt=P27&bkgnd=9&pov=BE040&uni=c&im=Crop,rect=(75,-25,1370,770),gravity=Center;Resize,width=700', 1, 'Benzín', 'Automatická', 1, '2022', 3000000);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id_k`);

--
-- Indexy pro tabulku `opravneni`
--
ALTER TABLE `opravneni`
  ADD PRIMARY KEY (`id_o`);

--
-- Indexy pro tabulku `rezervace`
--
ALTER TABLE `rezervace`
  ADD PRIMARY KEY (`id_r`),
  ADD KEY `vozidlo` (`vozidlo`),
  ADD KEY `uzivatel` (`uzivatel`);

--
-- Indexy pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`id_u`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`role`);

--
-- Indexy pro tabulku `vozidla`
--
ALTER TABLE `vozidla`
  ADD PRIMARY KEY (`id_v`),
  ADD KEY `kategorie` (`kategorie`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id_k` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pro tabulku `opravneni`
--
ALTER TABLE `opravneni`
  MODIFY `id_o` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `rezervace`
--
ALTER TABLE `rezervace`
  MODIFY `id_r` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pro tabulku `vozidla`
--
ALTER TABLE `vozidla`
  MODIFY `id_v` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `rezervace`
--
ALTER TABLE `rezervace`
  ADD CONSTRAINT `rezervace_ibfk_1` FOREIGN KEY (`vozidlo`) REFERENCES `vozidla` (`id_v`),
  ADD CONSTRAINT `rezervace_ibfk_2` FOREIGN KEY (`uzivatel`) REFERENCES `uzivatele` (`id_u`);

--
-- Omezení pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD CONSTRAINT `uzivatele_ibfk_1` FOREIGN KEY (`role`) REFERENCES `opravneni` (`id_o`);

--
-- Omezení pro tabulku `vozidla`
--
ALTER TABLE `vozidla`
  ADD CONSTRAINT `vozidla_ibfk_1` FOREIGN KEY (`kategorie`) REFERENCES `kategorie` (`id_k`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
