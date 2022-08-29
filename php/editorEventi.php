<?php 
    require_once ('session_Manager.php'); 
    require_once('page.php'); 
 
    ini_set('display_errors', 0); 
    ini_set('display_startup_errors', 0); 
    error_reporting(E_ALL); 
 
    $user = createSession(); 
 
    if($_SESSION["isAdmin"] != 1){ 
        $_SESSION['errorMsg'] = "Devi essere un amministratore per accedere alla funzionalit&agrave; di aggiunta veicolo"; 
        header('Location: ../php/pagina_avvisi.php'); 
        exit; 
    } 

    if($_GET['id_Evento']){
        if(!empty($_POST)){ 
            $checkIns = $user->editEvento($_GET['id_Evento'],$_POST['capienza'],$_POST['data'],$_POST['nome'],$_POST['descrizione'],$_POST['prezzo']); 
            if($checkIns){ 
                $_SESSION['successMsg'] = "Evento modificato con successo"; 
            } 
            else $_SESSION['errorMsg'] = "Impossibile modificare l'evento richiesto"; 
            header('Location: ../php/pagina_avvisi.php'); 
            exit;
        } 
    }
 
    
         
?> 
 
<!DOCTYPE html> 
 <html lang="it"> 
     <head> 
         <link rel="icon" type="image/x-icon" href="../img/2061866.png"/> 
         <title>Login Utente - Auto Asta</title> 
         <link rel="stylesheet" type="text/css" media="screen" href="../css/styleAlternative.css"/> 
         <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="../css/mobile.css"/> 
         <meta charset="UTF-8"/> 
         <meta name="description" content="Login Utente di Auto Asta"/> 
         <meta name="keywords" content="auto, asta, homepage, principale, veicoli"/> 
         <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>   
         <script src="../JS/script.js"></script>      
     </head> 
     <body> 
         <div class="globalDiv"> 
         <?php require_once ('header.php')?> 
         <div id="content"> 
         <?php 
                $paginaHTML= file_get_contents("../html/editSingleEvento.html");
                $connessione = new database_Manager();
                $connessioneOK = $connessione->connectToDatabase();
                $personaggi = ""; /* DATI  DAL DB */ 
                $listaVeicoli = $paginaHTML; /* CODICE DI HTML DA DARE IN OUTPUT */

                if($connessioneOK){
                    $personaggi = $connessione->getEventoInfo($_GET['id_Evento']);
                    $connessione->releaseDB();
                    if($personaggi != null){
                        foreach($personaggi as $veicolo){
                            $listaVeicoli = str_replace("{value-capienza}", $veicolo["capienza"],$listaVeicoli);
                            $listaVeicoli = str_replace("{value-data}", $veicolo["data"],$listaVeicoli);
                            $listaVeicoli = str_replace("{value-nome}", $veicolo["nome"],$listaVeicoli);
                            $listaVeicoli = str_replace("{value-descrizione}", $veicolo["descrizione"],$listaVeicoli);
                            $listaVeicoli = str_replace("{value-prezzo}", $veicolo["prezzo"],$listaVeicoli);
                            $listaVeicoli = str_replace("{value-id_Evento}", $veicolo["id_Evento"],$listaVeicoli);
                        }
                    }
                    else{
                        $listaVeicoli = "<p> Non ci sono informazioni relative agli eventi </p>";
                    }
                }
                else{
                    $listaVeicoli = "<p> I Sistemi sono Attualmente Fuori Uso </p>";
                }
                echo $listaVeicoli;
            ?>    
         </div> 
         <?php require_once ('../html/footer.html')?> 
        </div> 
     </body> 
 </html>