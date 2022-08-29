<?php 
    require_once "database_Manager.php"; 
 
    // Leggere il risultato dal database e stamparlo a schermo (impaginandolo) 
 
    $paginaHTML= file_get_contents("../html/eventi.html"); 
    $connessione = new database_Manager(); 
    $connessioneOK = $connessione->connectToDatabase(); 
    $eventi = ""; /* DATI FREZZI DAL DB */  
    $listaEventi = ""; /* CODICE DI HTML DA DARE IN OUTPUT */ 
 
    if($connessioneOK){ 
        $eventi = $connessione->getEventiList(); 
        $checkDate = $connessione->checkEventiDate($eventi); 
        $connessione->releaseDB(); 
 
        if($eventi != null){ 
            $index= 0; 
            foreach($eventi as $evento){ 
                $date = new DateTime($evento['data']); 
 
                $listaEventi .= '<dt class = "eventTitle" > ' . $evento['nome'] .' '.  $date->format('d-m-Y').'</dt>'; 
                $listaEventi .= '<dd class= "eventDescription"> 
                    <img class="eventImg" src="../img/' . $evento['url_immagine'] . '"/> 
                    <p class="eventParagraph"> ' . $evento['descrizione'] . '</p>'; 
                    if($checkDate[$index]){ 
                        $listaEventi.= '</dd><p class="notAvailable" >Evento già terminato, non è possibile modificarlo </p>';  
                    } 
                    else { 
                        $listaEventi .= '<a class="eventButton" href="editorEventi.php?id_Evento='.$evento['id_Evento'].'">Modifica Evento</a> </dd>'; 
                    } 
                $index++; 
            } 
 
        } 
        else{ 
            $listaEventi = "<p> Non ci sono informazioni relative ai eventi </p>"; 
        } 
    } 
    else{ 
        $listaEventi = "<p> I Sistemi sono Attualmente Fuori Uso </p>"; 
    } 
    echo str_replace("{event-list}", $listaEventi, $paginaHTML); 
?>