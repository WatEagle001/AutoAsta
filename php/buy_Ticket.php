<?php
    require_once 'session_Manager.php';
    require_once 'database_Manager.php';
    require_once 'page.php';
    $page = new page();
    $username = createSession();

    $id_Evento = $_GET['ID'];     
    if(isset($_SESSION['email']) && $_SESSION['email']!=-1){
        if($username->buyTicket($_SESSION['email'],$id_Evento)){
            $_SESSION['successMsg'] = "Acquisto avvenuto con successo";
        }
        else{
            $_SESSION['errorMsg'] = "Impossibile comprare il biglietto";
        }
    }
    else{
        $_SESSION['errorMsg'] = "Devi prima effettuare l'accesso per comprare il biglietto";
    }
    header("Location: pagina_avvisi.php");
    exit();
?>