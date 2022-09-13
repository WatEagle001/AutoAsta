<?php
    require_once 'session_Manager.php';
    require_once 'database_Manager.php';
    require_once 'page.php';
    
    $username = createSession();
    $page = new page();
    
    
    if (!empty($_POST)){
        $user = login($_POST['email'], $_POST['psw']);
        $page->setErrors(!$user->isReg());
        if (!$page->hasErrors()){
            header("Location: scheda_utente.php");
            exit();
        }
        else {
            $_SESSION['errorMSG'] = "Devi prima effettuare l\'accesso per visualizzare questa pagina";
            header("Location: pagina_avvisi.php");
            exit();
        }
    }
    
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="icon" type="image/x-icon" href="img/2061866.png"/>
        <title>Scheda utente - Auto Asta</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/styleAlternative.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="css/mobile.css"/>
        <link rel="stylesheet" type="text/css" media="print" href="css/print.css"/>
        <meta charset="UTF-8"/>
        <meta name="description" content="Scheda utente di Auto Asta"/>
        <meta name="keywords" content="auto, asta, utente, scheda, profilo, personale, area riservata"/>
        <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>     
    </head>
    <body>
        <div class="globalDiv">     
            <?php require_once ('header.php')?>
            <main>
                <?php 
                    $paginaHTML = file_get_contents('html/scheda_utente.html');
                    $connessione = new database_Manager();
                    $connessioneOK = $connessione->connectToDatabase();
                    $utenti = ""; /* DATI  DAL DB */ 
                    $output = $paginaHTML; /* CODICE DI HTML DA DARE IN OUTPUT */

                    if($connessioneOK){
                        $utenti = $connessione->getUserInfo($_SESSION['email']);
                        $connessione->releaseDB();
                        if($utenti != null){
                            foreach($utenti as $utente){
                                $output = str_replace("{user_name}", $utente["nome"],$output);
                                $output = str_replace("{user_surname}",$utente["cognome"],$output);
                                $output = str_replace("{username}",$utente['username'],$output);
                                $output = str_replace("{user_email}",$utente['Email'],$output);
                                $output = str_replace("{user_birthday}",$utente['data_nascita'],$output);
                                $output = str_replace("{user_reg_day}",$utente['data_Creazione'],$output);
                                $output = str_replace("{user_img}",
                                    '<img class="eventImg" alt="" src="img/' .$utente['url_Immagine'] . '"/>',$output);
                            }
                        }
                        else{
                            $output = "<p> Non ci sono informazioni relative agli utenti </p>";
                        }
                    }
                    else{
                        $output = "<p> I Sistemi sono Attualmente Fuori Uso </p>";
                    }
                    echo $output;
                    ?>

                </main>
            <?php require_once ('html/footer.html')?>
        </div>
    </body>
</html>