<?php 
    require_once('utente.php');

class utente_Non_Registrato extends utente{

    public function __construct() {
		parent::__construct();
	}

    public function iscrizione ($email,$username, $password, $isAdmin, $nome, $cognome, $url_immagine, $data_nascita){

        date_default_timezone_set("Europe/Rome");
        $current_date = date("Y-m-d");
        $enc_pswd = md5($password);

        $this->getDB()->query(
            "INSERT INTO UTENTE (Email, nome, cognome, data_creazione, url_immagine, data_nascita)
            VALUES ('$email','$nome','$cognome','$current_date','$url_immagine','$data_nascita');"
        );

        $this->getDB()->query(
            "INSERT INTO ACCOUNT (id_Account, username, password, email, isAdmin)
            VALUES (NULL,'$username','$enc_pswd',
            (SELECT Email from UTENTE WHERE Utente.Email = '$email'),
            '$isAdmin');"
        );

        return $this->getDBError() == 0;
    }

    public function setSessionVars() {
		$_SESSION['ID'] = -1;
        $_SESSION['email'] = -1;
	}

    public function isReg(){
        return false;
    }
}
?>