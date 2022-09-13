<?php
    require_once ('session_Manager.php');
    require_once('page.php');



    $gestione_Update = new  page();
    $session = createSession();

    if(!empty($_POST)){
        $user = getLoggedUser($_SESSION['email']);
        if(!empty($_POST)){
            if($_FILES['url_immagine']['size'] != 0){
                $checkIMG = $gestione_Update->upload($_POST,$_FILES);
                if($checkIMG){
                    $checkUpdate = $gestione_Update->updateUserInfo($_POST,$user,$_FILES);
                    if($checkUpdate){
                        header("Location: scheda_utente.php");
                        exit();
                    }else{
                        $_SESSION['errorMsg'] = "Impossibile aggiornare le informazioni, ti preghiamo di riprovare.";
                        
                    }
                }
            }
            else{
                $checkUpdate = $gestione_Update->updateUserInfo($_POST,$user,$_FILES);
                if($checkUpdate){
                    header("Location: scheda_utente.php");
                    exit();
                }else{
                    $_SESSION['errorMsg'] = "Impossibile aggiornare le informazioni, ti preghiamo di riprovare.";
                    
                }
            }
        }
        header("Location: pagina_avvisi.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="icon" type="image/x-icon" href="img/2061866.png"/>
        <title>Modifica Profilo - Auto Asta</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/styleAlternative.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="css/mobile.css"/>
        <meta charset="UTF-8"/>
        <meta name="description" content="Registrazione Utente di Auto Asta"/>
        <meta name="keywords" content="auto, asta, homepage, principale, veicoli"/>
        <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>   
        <script src="JS/miniscript.js"></script>    
    </head>
    <body>
        <div class="globalDiv">
        <?php require_once ('header.php')?>
            <main>
                <form action="edit_profile.php" method="post" enctype="multipart/form-data">
                    <div class="registration_form">
                    <h2>FORM MODIFICA DATI UTENTE </h2>
                    <p>Compila solamente i campi dati che vuoi modificare </p>
                    <hr>
                    <fieldset name="password">
                        <label for="psw"><b>Nuova Password</b></label>
                        <input type="password" placeholder="Inserisci la tua nuova password" name="psw" id="psw" onblur="return checkPassword()">  
                        <label for="password-repeat"><b>Ripeti Nuova Password</b></label>
                        <input type="password" placeholder="Ripeti la nuova password scelta" name="password-repeat" id="password-repeat" onblur="return checkPassword()">
                    </fieldset>

                    <fieldset name="username" >
                        <label for="username"><b>Username</b></label>
                        <input type="text" placeholder="Inserisci il tuo nuovo username" name="username" id="username" onblur="return checkText('username','Username non valido',/^[a-zA-Z0-9]+$/)">
                    </fieldset>
                 
                    <label for="url_immagine"><b>Cambia la tua foto profilo</b></label>
                    <input type="file" name="url_immagine" id="url_immagine" accept=".jpg,.png,.jpeg">

                    <button type="submit" class="register_btn">AGGIORNA DATI</button>
                    </div>
                </form>
</main>
            <?php require_once ('html/footer.html')?>
      </div>
    </body>
</html>