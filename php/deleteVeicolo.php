
<?php
    require_once 'session_Manager.php';
    $username = createSession();

    $targa_Veicolo = $_GET['Targa'];     
    if(isset($_SESSION['email']) && $_SESSION['email']!=-1){
        if($username->deleteVeicolo($targa_Veicolo)){
            $_SESSION['successMsg'] = "Eliminazione avvenuta con successo";
        }
        else{
            $_SESSION['errorMsg'] = "Impossibile eliminare il veicolo selezionato";
        }
    }
    else{
        $_SESSION['errorMsg'] = "Devi prima effettuare l'accesso per eliminare un veicolo";
    }
    header("Location: pagina_avvisi.php");
    exit();
?>