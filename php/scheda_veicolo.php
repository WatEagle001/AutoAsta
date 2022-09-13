<?php
    require_once 'session_Manager.php';
    require_once 'database_Manager.php';
    require_once 'page.php';
    
    $username = createSession();
    $page = new page();
    
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="icon" type="image/x-icon" href="../img/2061866.png"/>
        <title>Scheda Veicolo - Auto Asta</title>
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
                    $paginaHTML = file_get_contents('../html/scheda_veicolo.html');
                    $connessione = new database_Manager();
                    $connessioneOK = $connessione->connectToDatabase();
                    $personaggi = ""; /* DATI  DAL DB */ 
                    $listaVeicoli = $paginaHTML; /* CODICE DI HTML DA DARE IN OUTPUT */

                    if($connessioneOK){
                        $personaggi = $connessione->getInfoVeicolo($_GET['Targa']);
                        $connessione->releaseDB();
                        if($personaggi != null){
                            foreach($personaggi as $veicolo){
                                $listaVeicoli = str_replace("{veicolo_targa}", $veicolo["Targa"],$listaVeicoli);
                                $listaVeicoli = str_replace("{veicolo-img}", '<img class="eventImg" alt="Immagine del veicolo su strada" src="../img/' .$veicolo['url_Immagine'] . '"/>',$listaVeicoli);
                                $listaVeicoli = str_replace("{marca}", $veicolo["marca"],$listaVeicoli);
                                $listaVeicoli = str_replace("{modello}", $veicolo["modello"],$listaVeicoli);
                                $listaVeicoli = str_replace("{cilindrata}", $veicolo["cilindrata"],$listaVeicoli);
                                $listaVeicoli = str_replace("{anno}", $veicolo["anno"],$listaVeicoli);
                                $listaVeicoli = str_replace("{posti}", $veicolo["posti"],$listaVeicoli);
                                $listaVeicoli = str_replace("{cambio}", $veicolo["cambio"],$listaVeicoli);
                                $listaVeicoli = str_replace("{carburante}", $veicolo["carburante"],$listaVeicoli);
                                $listaVeicoli = str_replace("{colore_Esterni}", $veicolo["colore_Esterni"],$listaVeicoli);
                                $listaVeicoli = str_replace("{descrizione}", $veicolo["descrizione"],$listaVeicoli);
                                $listaVeicoli = str_replace("{veicolo_targa}", $veicolo["Targa"],$listaVeicoli);
                                $listaVeicoli = str_replace("{chilometri_Percorsi}", $veicolo["chilometri_Percorsi"],$listaVeicoli);
                                $listaVeicoli = str_replace("{data_Aggiunta}", $veicolo["data_Aggiunta"],$listaVeicoli);
                                $listaVeicoli = str_replace("{base_Asta}",$veicolo['base_Asta'],$listaVeicoli);
                            }
                        }
                        else{
                            $listaVeicoli = "<p> Non ci sono informazioni relative al veicolo </p>";
                        }
                    }
                    else{
                        $listaVeicoli = "<p> I Sistemi sono Attualmente Fuori Uso </p>";
                    }
                    echo $listaVeicoli;
                    ?>

                </main>
            <?php require_once ('../html/footer.html')?>
        </div>
    </body>
</html>