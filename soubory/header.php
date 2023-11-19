<?php
    if($index) {
        $cesta = "";
    }
    else {
        $cesta = "../";
    }
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@300;400;500;600;700&display=swap" rel="stylesheet">   
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <?php
        echo '
        <script src="' . $cesta . 'soubory/main.js" defer></script>
        <script src="' . $cesta . 'soubory/main.js" defer></script>';
    ?>  
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="soubory/main.js" defer></script>
    <title>
        CARLEND | <?php echo $title;?>
    </title>
    <?php
        echo '<link rel="icon" href="' . $cesta . 'soubory/ikona-auto.png">';
    ?>
</head>

  