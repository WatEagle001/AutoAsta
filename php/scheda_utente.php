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
        <link rel="icon" type="image/x-icon" href="../img/2061866.png"/>
        <title>Scheda utente - Auto Asta</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleAlternative.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="../css/mobile.css"/>
        <link rel="stylesheet" type="text/css" media="print" href="../css/print.css"/>
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
                    $paginaHTML = file_get_contents('../html/scheda_utente.html');
                    $connessione = new database_Manager();
                    $connessioneOK = $connessione->connectToDatabase();
                    $personaggi = ""; /* DATI  DAL DB */ 
                    $listaPersonaggi = $paginaHTML; /* CODICE DI HTML DA DARE IN OUTPUT */

                    if($connessioneOK){
                        $personaggi = $connessione->getUserInfo($_SESSION['email']);
                        $connessione->releaseDB();
                        if($personaggi != null){
                            foreach($personaggi as $personaggio){
                                $listaPersonaggi = str_replace("{user_name}", $personaggio["nome"],$listaPersonaggi);
                                $listaPersonaggi = str_replace("{user_surname}",$personaggio["cognome"],$listaPersonaggi);
                                $listaPersonaggi = str_replace("{username}",$personaggio['username'],$listaPersonaggi);
                                $listaPersonaggi = str_replace("{user_email}",$personaggio['Email'],$listaPersonaggi);
                                $listaPersonaggi = str_replace("{user_birthday}",$personaggio['data_nascita'],$listaPersonaggi);
                                $listaPersonaggi = str_replace("{user_reg_day}",$personaggio['data_Creazione'],$listaPersonaggi);
                                $listaPersonaggi = str_replace("{user_img}",
                                    '<img class="eventImg" alt="" src="../img/' .$personaggio['url_Immagine'] . '"/>',$listaPersonaggi);
                            }
                        }
                        else{
                            $listaPersonaggi = "<p> Non ci sono informazioni relative agli utenti </p>";
                        }
                    }
                    else{
                        $listaPersonaggi = "<p> I Sistemi sono Attualmente Fuori Uso </p>";
                    }
                    echo $listaPersonaggi;
                    ?>

                </main>
            <?php require_once ('../html/footer.html')?>
        </div>
    </body>
</html>