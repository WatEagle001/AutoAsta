<?php
    require_once "database_Manager.php";

    // Leggere il risultato dal database e stamparlo a schermo (impaginandolo)

    $paginaHTML= file_get_contents("../html/veicoli_home.html");
    $connessione = new database_Manager();
    $connessioneOK = $connessione->connectToDatabase();
    $veicoli = ""; /* DATI  DAL DB */ 
    $listaVeicoli = ""; /* CODICE DI HTML DA DARE IN OUTPUT */

    if($connessioneOK){
        $veicoli = $connessione->getNewVeicoli();
        $connessione->releaseDB();

        if($veicoli != null){
            foreach($veicoli as $veicolo ){
                $listaVeicoli .='<article class = "carArticle">';
                $listaVeicoli .= '<h3 > ' . $veicolo['marca'].' '.$veicolo['modello'] .'</h3>';
                $listaVeicoli .= '
                    <img class="imgListaAuto" alt="'.$veicolo['marca'].''.$veicolo['modello'].'" src="../img/' . $veicolo['url_Immagine'] . '"/>
                <a aria-label="Ottieni maggiori informazioni riguardanti il veicolo" href="scheda_veicolo.php?Targa='.$veicolo['Targa'].'">MAGGIORI INFORMAZIONI</a>
                <p class="publish_date"> Pubblicato il giorno: '.$veicolo['data_Aggiunta'].'</p>
                </article>';
            }
        }
        else{
            $listaVeicoli = "<p> Non ci sono informazioni relative ai veicoli </p>";
        }
    }
    else{
        $listaVeicoli = "<p> I Sistemi sono Attualmente Fuori Uso </p>";
    }
    echo str_replace("{auto-list}", $listaVeicoli, $paginaHTML);
?>