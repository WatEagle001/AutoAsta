<?php
    require_once ('session_Manager.php');
    require_once('page.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $user = createSession();
    $gestione_accessi = new  page();

    if(!empty($_POST)){
        $checkIns = $gestione_accessi->inserimentoNuovoUtente($_POST,$user);
        if($checkIns){
           $user = createSession();
           $enc_pswd = md5($_POST['psw']);
           $user = login($_POST['email'], $enc_pswd);
           header("Location: scheda_utente.php");
            exit();
        }
        else{
            $_SESSION['errorMsg'] = "Impossibile completare la registrazione";
            header("Location: pagina_avvisi.php");
            exit();
        }
    }

    if ($user->isReg()){
        header("Location: index.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="icon" type="image/x-icon" href="../img/2061866.png"/>
        <title>Registrazione Utente - Auto Asta</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleAlternative.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="../css/mobile.css"/>
        <meta charset="UTF-8"/>
        <meta name="description" content="Registrazione Utente di Auto Asta"/>
        <meta name="keywords" content="auto, asta, homepage, principale, veicoli"/>
        <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>       
        <script src="../JS/script.js"></script>
    </head>
    <body>
        <div class="globalDiv">
        <?php require_once ('header.php')?>
            <div id="content">
                <form name="registrazione" action="../php/registrazione.php" method="post">
                    <div class="registration_form">
                    <h2>FORM REGISTRAZIONE</h2>
                    <p>Compila i campi seguenti per poterti registrare </p>
                    <hr>

                    <fieldset form="registrazione" name="email">
                        <label for="email"><b>Email</b></label>
                        <input type="text" placeholder="Inserisci la tua email" name="email" id="email" onblur="return checkEmail()" required>
                    </fieldset>

                    <fieldset form="registrazione" name="password">
                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Inserisci la tua  password" name="psw" id="psw" required>  
                        <label for="psw-repeat"><b>Conferma Password</b></label>
                      <input type="password" placeholder="Ripeti la password scelta" name="password-repeat" id="password-repeat" onblur="return checkPassword()"required>
                    </fieldset>

                    <fieldset form="registrazione" name="username">
                    <label for="name"><b>Username</b></label>
                    <input type="text" placeholder="Inserisci il tuo username" name="username" id="username"  onblur="return checkText('username','Username non valido',/^[a-zA-Z0-9]+$/)" required">
                    </fieldset>

                    <fieldset form="registrazione" name="nome">
                        <label for="name"><b>Nome</b></label>
                        <input type="text" placeholder="Inserisci il tuo nome" name="nome" id="nome" onblur="return checkText('nome','Nome non valido',/^[a-zA-Z]+$/)" required>
                    </fieldset>

                    <fieldset form="registrazione" name="cognome">
                        <label for="cognome"><b>Cognome</b></label>
                        <input type="text" placeholder="Inserisci il tuo cognome" name="cognome" id="cognome" onblur="return checkText('cognome','Cognome non valido',/^[a-zA-Z]+$/)" required>
                    </fieldset>

                    <fieldset form="registrazione" name="data_nascita">
                        <label for="birthday"><b>Data nascita</b></label>
                        <input type="date" name="data_nascita" id="data_nascita" onblur="return checkDateProfile()" required>
                    </fieldset>

                    <fieldset form="registrazione" name="user_profile_picture">
                        <label for="profile_image"><b>Carica foto profilo</b></label>
                        <input type="file" name="url_immagine" id="url_immagine" accept=".jpg,.png,.jpeg">
                    </fieldset>
                    
                    <p>Creando un account accetti i nostri <a href="">Termini e Condizioni</a>.</p>
                    <input type="reset" class="reset_btn" value="CANCELLA DATI">
                    <button type="submit" class="register_btn">REGISTRATI</button>
                    </div>

                    <div class="login_form_section">
                    <p>Hai già un tuo account? <a href="../php/login_page.php">ACCEDI QUI</a>.</p>
                    </div>
                </form>
            </div>
            <?php require_once ('../html/footer.html')?>
        </div>
    </body>
</html>