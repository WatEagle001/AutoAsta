<?php 
    require_once ('session_Manager.php');
    require_once('page.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $gestione_Update = new  page();
    $user = createSession();

    if($_SESSION["isAdmin"] != 1){
        header('Location: index.php');
        exit;
    }

    if(!empty($_SESSION)){
        $user = getLoggedUser($_SESSION['email']);
        if(!empty($_POST)){
            $checkUpdate = $gestione_Update->updateVeicoloInfo($_POST,$user);
            if($checkUpdate){
            //UPDATE AVVENUTO CON SUCCESSO
            header("Location: editorVeicoli.php");
            exit();
            }else {
                $_SESSION['errorMsg'] = "Impossibile modificare il veicolo"; 
                header('Location: ../php/pagina_avvisi.php'); 
                exit;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="icon" type="image/x-icon" href="../img/2061866.png"/>
        <title>Modifica Veicolo - Auto Asta</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleAlternative.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="../css/mobile.css"/>
        <link rel="stylesheet" type="text/css" media="print" href="../css/print.css"/>
        <meta charset="UTF-8"/>
        <meta name="description" content="Pagina di Modifica dei Veicoli di Auto Asta"/>
        <meta name="keywords" content="auto, asta, edit, modifica, veicoli"/>
        <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>       
    </head>
    <body>
        <div class="globalDiv">     
        <?php require_once ('header.php')?>
        <main>
            <?php 
                $paginaHTML= file_get_contents("../html/editSingleVeicolo.html");
                $connessione = new database_Manager();
                $connessioneOK = $connessione->connectToDatabase();
                $personaggi = ""; /* DATI  DAL DB */ 
                $listaVeicoli = $paginaHTML; /* CODICE DI HTML DA DARE IN OUTPUT */

                if($connessioneOK){
                    $personaggi = $connessione->getInfoVeicolo($_GET['Targa']);
                    $connessione->releaseDB();
                    if($personaggi != null){
                        foreach($personaggi as $veicolo){
                            $listaVeicoli = str_replace("{placeholder-targa}", $veicolo["Targa"],$listaVeicoli);
                            $listaVeicoli = str_replace("{placeholder-marca}", $veicolo["marca"],$listaVeicoli);
                            $listaVeicoli = str_replace("{placeholder-modello}", $veicolo["modello"],$listaVeicoli);
                            $listaVeicoli = str_replace("{placeholder-cilindrata}", $veicolo["cilindrata"],$listaVeicoli);
                            $listaVeicoli = str_replace("{placeholder-anno}", $veicolo["anno"],$listaVeicoli);
                            $listaVeicoli = str_replace("{placeholder-posti}", $veicolo["posti"],$listaVeicoli);
                            $listaVeicoli = str_replace("{placeholder-cambio}", $veicolo["cambio"],$listaVeicoli);
                            $listaVeicoli = str_replace("{placeholder-carburante}", $veicolo["carburante"],$listaVeicoli);
                            $listaVeicoli = str_replace("{placeholder-colore}", $veicolo["colore_Esterni"],$listaVeicoli);
                            $listaVeicoli = str_replace("{placeholder-descrizione}", $veicolo["descrizione"],$listaVeicoli);
                            $listaVeicoli = str_replace("{placeholder-immagine}", $veicolo["url_Immagine"],$listaVeicoli);
                            $listaVeicoli = str_replace("{placeholder-chilometri}", $veicolo["chilometri_Percorsi"],$listaVeicoli);
                            $listaVeicoli = str_replace("{placeholder-prezzo}",$veicolo['base_Asta'],$listaVeicoli);
                        }
                    }
                    else{
                        $listaVeicoli = "<p> Non ci sono informazioni relative agli utenti </p>";
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