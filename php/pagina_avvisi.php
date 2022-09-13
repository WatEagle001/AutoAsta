<?php
    require_once('page.php');
    require_once ('session_Manager.php');
    $page = new page();
    $user = createSession ();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="icon" type="image/x-icon" href="../img/2061866.png"/>
        <title>Avviso - Auto Asta</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleAlternative.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="../css/mobile.css"/>
        <meta charset="UTF-8"/>
        <meta name="description" content="Homepage di Auto Asta"/>
        <meta name="keywords" content="auto, asta, homepage, principale, veicoli"/>
        <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>       
    </head>
    <body>
        <div class="globalDiv">     

        <?php require_once ('header.php')?>

            <main>
                <?php
                    if (isset($_SESSION['errorMsg']))
                        $page->printMessagge($_SESSION['errorMsg'],false);
                    elseif(isset($_SESSION['successMsg']))
                        $page->printMessagge($_SESSION['successMsg'],true);
                    unset($_SESSION['errorMsg']);
                    unset($_SESSION['successMsg']);
                ?>  
                <a id ="homeButton" class="WarningPageElement" href="../php/index.php">TORNA ALLA PAGINA INIZIALE</a>  
</main>   
        <?php require_once ('../html/footer.html')?>
        </div>
    </body>
</html>
