<?php
    require_once ('session_Manager.php');
    require_once('page.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $gestione_Update = new  page();
    $user = createSession();
    $email = NULL;
    if($_SESSION['email']!=-1 && isset($_SESSION['email'])){
        $email = $_SESSION['email'];
    }

    if(!empty($_GET['Id_Biglietto']) && $email){
        $Id_Biglietto = $_GET['Id_Biglietto'];
        if($user->deleteTicket($_SESSION['email'],$Id_Biglietto)){
            $_SESSION['successMsg'] = "Cancellazione avvenuta con successo";
        }
        else {
            $_SESSION['errorMsg'] = "Impossibile cancellare il biglietto";
        }
    }
    else {
        $_SESSION['errorMsg'] = "Devi essere registrato per effettuare questa operazione";
    }
    header("Location: pagina_avvisi.php");
    exit();
?>