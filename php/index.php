<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="icon" type="image/x-icon" href="../img/2061866.png"/>
        <title>Home Page - Auto Asta</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleAlternative.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="../css/mobile.css"/>
        <link rel="stylesheet" type="text/css" media="print" href="../css/print.css"/>
        <meta charset="UTF-8"/>
        <meta name="description" content="Homepage di Auto Asta"/>
        <meta name="keywords" content="auto, asta, homepage, principale, veicoli"/>
        <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>       
    </head>
    <body>
        <div class="globalDiv">     

        <?php require_once ('header.php')?>

            <main id="content">

                <?php require_once('veicoli_home.php')?>
                <?php require_once('eventi_home.php')?>
                
            </main>   
        <?php require_once ('../html/footer.html')?>
        </div>
    </body>
</html>
