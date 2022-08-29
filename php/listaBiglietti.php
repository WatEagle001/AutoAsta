<?php
    require_once 'session_Manager.php';
    require_once 'database_Manager.php';
    require_once 'page.php';
    $page = new page();
    $username = createSession();

    if(!isset($_SESSION['email']) || $_SESSION['email']==-1){
        $_SESSION['errorMsg'] = "Devi prima effettuare l'accesso per visualizzare i tuoi biglietti";
        header("Location: pagina_avvisi.php");
        exit();
    }
    
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="icon" type="image/x-icon" href="../img/2061866.png"/>
        <title>Biglietti - Auto Asta</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleAlternative.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="../css/mobile.css"/>
        <link rel="stylesheet" type="text/css" media="print" href="../css/print.css"/>
        <meta charset="UTF-8"/>
        <meta name="description" content="Biglietti di Auto Asta"/>
        <meta name="keywords" content="auto, asta, homepage, principale, veicoli"/>
        <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>       
    </head>
    <body>
        <div class="globalDiv">     

        <?php require_once ('header.php')?>

            <div id="content" tabindex="8">
            <?php
                require_once "database_Manager.php";
                
                $paginaHTML= file_get_contents("../html/biglietti.html");
                $connessione = new database_Manager();
                $connessioneOK = $connessione->connectToDatabase();
                $eventi = ""; /* DATI FREZZI DAL DB */ 
                $listaEventi = ""; /* CODICE DI HTML DA DARE IN OUTPUT */

                if($connessioneOK){
                    $biglietti = $connessione->getListaBiglietti($_SESSION['email']);
                    if($biglietti != null){
                        $index = 0;
                        foreach($biglietti as $biglietto){
                            $evento = $connessione->getEventoInfo($biglietto['evento']);
                            $dataEvento = new DateTime($evento[0]['data']);
                            $dataAcquisto = new DateTime($biglietto['data_Acquisto']);
                            $listaEventi .= '<dt class = "eventTitle" > Biglietto valido per la fiera di: ' . $evento[0]['nome'] .'</dt>';
                            $listaEventi .= '<dd class= "eventDescription">';
                            $listaEventi .= '<img class="eventImg" src="../img/' . $evento[0]['url_immagine'] . '"/>
                                <ul class="eventParagraph">
                                <li>INTESTATO A: ' . $biglietto['utente'] . '</li>
                                <li>ACQUISTATO IL GIORNO: <p>' . $dataAcquisto->format('d-m-Y').'</p></li>
                                <li>VALIDO IL GIORNO: <p>' . $dataEvento->format('d-m-Y'). '</p></li>
                                <li>LUOGO SVOLGIMENTO: <p>' . $evento[0]['via'] .' '. $evento[0]['num_Civico'] .' '.$evento[0]['cap'].'</p></li>
                                </ul>';
                            $listaEventi .='<a class="eventButton" href="../php/delete_Ticket.php?Id_Biglietto='.$biglietto['Id_Biglietto'].'">Elimina Biglietto</a></dd>';
                            $listaEventi .='<p class="idBiglietto">IDENTIFICATIVO BIGLIETTO: '. $biglietto['Id_Biglietto'].'</p>';
                        }
                        $connessione->releaseDB();
                    }
                    else{
                        $listaEventi = "<p> Non hai biglietti per i nostri eventi </p>";
                    }
                }
                else{
                    $listaEventi = "<p> I Sistemi sono Attualmente Fuori Uso </p>";
                }
                echo str_replace("{event-list}", $listaEventi, $paginaHTML);
            ?>
            </div>   
        <?php require_once ('../html/footer.html')?>
        </div>
    </body>
</html>


