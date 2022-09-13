<?php 
    require_once('utente.php');

class utente_Registrato extends utente{
    private $ID = null;
    private $username = null;
    private $password = null;
    private $email = null;
    private $nome = null;
    private $cognome = null;
    private $data_Creazione = null;
    private $url_Immagine = null;
    private $data_Nascita = null;
    private $isAdmin = 0;

    public function __construct($email_user) {
		parent::__construct();

		$query = $this->getDB()->query("SELECT * FROM utente, account WHERE utente.Email = '$email_user' AND utente.Email = account.email");
		if ($query->num_rows>0) {
			$result = $query->fetch_assoc();
			$this->ID = $result['id_Account'];
			$this->username = $result['username'];
			$this->password = $result['password'];
			$this->email = $email_user;
            $this->nome = $result['nome'];
            $this->cognome = $result['cognome'];
            $this->data_Creazione = $result['data_Creazione'];
            $this->url_Immagine = $result['url_Immagine'];
            $this->data_Nascita = $result['data_nascita'];
            $this->isAdmin = $result['isAdmin'];
		} else {
			throw new Exception("Utente non esistente");
		}
	}

    public function isReg(){
        return true;
    }

    public function checkPassword($psw){
        echo($psw . '  ' . $this->password);
        //return sha1($psw) == $this->password;
        return $psw == $this->password;
    }

    public function getID(){
        return $this->ID;
    }

    function getUsername(){
        return $this->username;
    }

    function getEmail(){
        return $this->email;
    }
    
    private function getPassword(){
        return $this->password;
    }

    private function getNome(){
        return $this->nome;
    }

    private function getCognome(){
        return $this->cognome;
    }

    public function getDataCreazione(){
        return $this->data_Creazione;
    }

    public function getUrlImmagine(){
        return $this->url_Immagine;
    }

    private function getDataNascita(){
        return $this->data_Nascita;
    }

    public function getIsAdmin(){
        return $this->isAdmin;
    }

    public function setSessionVars(){
        $_SESSION['email'] = $this->getEmail();
        $_SESSION['ID'] = $this->getID();
        $_SESSION['isAdmin'] = $this->getIsAdmin();
    }

    public function addAstaEmpty ($base_Asta,$targa_Veicolo){
        $targa = strtoupper($targa_Veicolo);
        $dataAcquisto = date("Y-m-d");

        $this->getDB()->query(
            "INSERT INTO asta (id_Asta,base_Asta,venduto,prezzo_Finale,targa_Veicolo,data,email_Acquirente)
            VALUES (NULL,'$base_Asta','0','0','$targa_Veicolo','$dataAcquisto',NULL);"
        );

        return $this->getDBError() == 0;
    }

    public function addVeicolo($targa,$marca,$modello,$cilindrata,$anno,$posti,$cambio,$carburante,$colori_Esterni,$url_Immagine,$descrizione,$chilometri_Percorsi,$disponibile){
        date_default_timezone_set("Europe/Rome");
        $data_Aggiunta = date("Y-m-d");
        $targa = strtoupper($targa);

        $this->getDB()->query(
            "INSERT INTO veicolo (Targa, marca, modello, cilindrata, anno, posti, cambio,carburante, colore_Esterni, url_Immagine, descrizione, chilometri_Percorsi, disponibile, data_Aggiunta)
            VALUES ('$targa','$marca','$modello','$cilindrata','$anno','$posti','$cambio','$carburante','$colori_Esterni','$url_Immagine','$descrizione','$chilometri_Percorsi','$disponibile','$data_Aggiunta');"
        );

        return $this->getDBError() == 0;
    }

    public function addIndirizzo($via,$città,$cap,$num_Civico){
        $this->getDB()->query(
            "INSERT INTO indirizzo (id_Indirizzo,via,citta,cap, num_Civico)
            VALUES (NULL,'$via','$città','$cap','$num_Civico');"
        );
        return $this->getDBError() == 0;
    }

    public function editEvento($id,$capienza,$dataEvento,$nome,$descrizione,$prezzo){
        $this->getDB()->query(
            "UPDATE evento SET
            evento.capienza = '$capienza',
            evento.data ='$dataEvento',
            evento.nome='$nome',
            evento.descrizione ='$descrizione',
            evento.prezzo ='$prezzo'
            WHERE evento.id_Evento = '$id';"
        );

        return $this->getDBError() == 0;
    }

    public function deleteVeicolo($targa){
        $this->getDB()->query(
            "DELETE FROM veicolo 
            WHERE veicolo.Targa = '$targa';"
        );
        
        $this->getDB()->query(
            "DELETE FROM asta 
            WHERE asta.targa_Veicolo = '$targa';"
        );

        return $this->getDBError() == 0;
    }

    public function addEvento($Capienza,$DataEvento,$Indirizzo,$nome,$Descrizione,$Prezzo,$url_immagine){
        $this->getDB()->query(
            "INSERT INTO evento (id_Evento,capienza,data,indirizzo,nome, descrizione, prezzo, url_immagine)
            VALUES (NULL,'$Capienza','$DataEvento','$Indirizzo','$nome','$Descrizione','$Prezzo','$url_immagine');"
        );

        return $this->getDBError() == 0;
    }

    public function updateVeicolo($targa,$marca,$modello,$cilindrata,$anno,$posti,$cambio,$carburante,$colori_Esterni,$url_Immagine,$descrizione,$chilometri_Percorsi,$disponibile,$prezzo){
      
        $this->getDB()->query(
            "UPDATE veicolo SET
            veicolo.marca = '$marca',
            veicolo.modello = '$modello',
            veicolo.cilindrata = '$cilindrata',
            veicolo.anno = '$anno',
            veicolo.posti = '$posti',
            veicolo.cambio = '$cambio',
            veicolo.carburante = '$carburante',
            veicolo.colore_Esterni = '$colori_Esterni',
            veicolo.url_Immagine = '$url_Immagine',
            veicolo.descrizione = '$descrizione',
            veicolo.chilometri_Percorsi = '$chilometri_Percorsi',
            veicolo.disponibile = '$disponibile'
            WHERE veicolo.Targa='$targa';"
            );
        $this->getDB()->query(
            "UPDATE asta SET
            asta.base_Asta = '$prezzo'
            WHERE asta.targa_Veicolo='$targa';"
            );
        return $this->getDBError() == 0;
    }

    public function buyTicket($email_user,$id_Evento){
        date_default_timezone_set("Europe/Rome");
        $data_Acquisto = date("Y-m-d");        

        $this->getDB()->query(
            "INSERT INTO biglietto (Id_Biglietto, evento, utente,data_Acquisto)
            VALUES (NULL,'$id_Evento','$email_user','$data_Acquisto');"
        );
                
        $this->getDB()->query(
            "UPDATE evento SET 
             evento.capienza=evento.capienza-1
             WHERE evento.id_Evento='$id_Evento' AND evento.capienza > 1;"
        );
        return $this->getDBError()==0;
    }

    public function deleteTicket($email_user,$id_Biglietto){
        date_default_timezone_set("Europe/Rome");
        $data_Acquisto = date("Y-m-d");        

        $this->getDB()->query(
            "DELETE FROM biglietto WHERE biglietto.Id_Biglietto = '$id_Biglietto' AND biglietto.utente='$email_user';"
        );
                
        return $this->getDBError()==0;
    }

    public function updateUserInfo ($username, $password, $url_immagine, $data_Nascita){

        $enc_pswd = md5($password);
        if($username!="" && $this->getUsername()!=$username){
            $this->username=$username;
        }
        if($password!="" && $this->getPassword()!=$enc_pswd){
            $this->password=$enc_pswd;
        }
        if($url_immagine!="" && $this->getUrlImmagine()!=$url_immagine){
            $this->url_Immagine = $url_immagine;
        }
        if($data_Nascita!="" && $this->getDataNascita()!=$data_Nascita){
            $this->data_Nascita = $data_Nascita;
        }

        $this->getDB()->query(
            "UPDATE utente SET 
             utente.url_Immagine='".$this->getUrlImmagine()."',
             utente.data_nascita='".$this->getDataNascita()."'
             WHERE utente.Email='".$this->getEmail()."';"
        );

        $this->getDB()->query(
            "UPDATE account SET account.username = '".$this->getUsername()."', account.password='".$this->getPassword()."'
            WHERE account.email = '".$this->getEmail()."';"
        );


        return $this->getDBError() == 0;
    }
    
}
?>