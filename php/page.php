<?php 
require_once("database_Manager.php");
require_once("session_Manager.php");
class page {

    public $errors = null;

    public function __construct($errors = null){
		$this->errors = $errors;
	}

	public function addError($error) {
		if (!is_array($this->errors)) {
			$this->errors = $error;
		} else {
			if (!is_array($error)){
				array_push($this->errors,$error);
			} else {
				$this->errors = array_merge($this->errors,$error);
			}
		}
	}

    public function setErrors($errors){
        $this->errors = $errors;
    }

    public function hasErrors(){
        if($this->errors == null) return false;
        if(!is_array($this->errors)) return !empty($this->errors);
        $checkErr = false;
        foreach($this->errors as $error){
            $checkErr = $checkErr || !empty($error);
        }
        return $checkErr;
    }
    

    private static function checkFileName($name){
        return ($_SERVER['SCRIPT_NAME'] == "/progettowebtech/php/". $name);
    }

    private function checkUserLog(){
        if(isset($_SESSION["ID"]) && $_SESSION["ID"]!=-1){ //se ID è istanziato ed è diverso da -1 significa che l'utente è registrato
            //echo("$_SESSION[ID]");
            return true;
        }
        else{
            //echo("$_SESSION[ID]");
            return false;
        }
    }

    public function inserimentoNuovoUtente ($post, utente_Non_Registrato $utente){
        $utente -> iscrizione($post['email'],$post['username'], $post['psw'], 0,$post['nome'],$post['cognome']
        ,$post['url_immagine'],$post['data_nascita']);
        if($utente){
            return true;
        }
        else return false;
    }

    public function updateUserInfo($post, utente_Registrato $utente){
        if($post['psw'] == $post['password-repeat']){
            $utente->updateUserInfo($post['username'],$post['psw'],$post['url_immagine'],$post['data_nascita']);
            if($utente){
                return true;
            }
        }
        return false;
    }

    public function updateVeicoloInfo($post, utente_Registrato $utente){
        $utente->updateVeicolo($post['targa'],$post['marca'],$post['modello'],$post['cilindrata'],$post['anno'],$post['posti'],$post['cambio'],$post['carburante'],$post['colori_Esterni'],$post['url_Immagine'],$post['descrizione'],1,$post['prezzo_base']);
        if($utente){
            return true;
        }
        else return false;
    }

    public function printBreadcrumb(){
        if($this->checkFileName("index.php")){
            echo "<p lang=\"en\">Home</p>";
        }
        else if($this->checkFileName("chisiamo.php")){
            echo "<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt Chi Siamo </p>";
        }
        else if($this->checkFileName("eventi.php")){
            echo "<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt Eventi </p>";
        }
        else if($this->checkFileName("veicoli.php")){
            echo "<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt Veicoli </p>";
        }
        else if($this->checkFileName("login_page.php")){
            echo "<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
                    <a href=\"registrazione.php\">Registrazione Utente</a> &gt &gt
                <span lang=\"en\">Login </span> </p>";
        }
        else if($this->checkFileName("registrazione.php")){
            echo"<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
                Registrazione Utente </p>
            ";
        }
        else if($this->checkFileName("scheda_utente.php")){
            echo"<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
                Scheda Utente </p>
            "; 
        }
        else if($this->checkFileName("edit_profile.php")){
            echo"<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
                <a href=\"scheda_utente.php\">Scheda Utente</a> &gt &gt
                Modifica Profilo </p>
            ";
        }
        else if($this->checkFileName("scheda_veicolo.php")){
            echo"<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
                <a href=\"veicoli.php\">Veicoli</a> &gt &gt
                Scheda Veicolo </p>
            ";
        }
        else if($this->checkFileName("editorVeicoli.php")){
            echo"<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
                Modifica Veicoli </p>
            ";
        }
        else if($this->checkFileName("editSingleVeicolo.php")){
            echo"<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
                 <a href=\"editorVeicoli.php\">Modifica Veicoli</a> &gt &gt
                Veicolo Da Modificare </p>
            ";
        }
        else if($this->checkFileName("addVeicolo.php")){
            echo"<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
                Aggiungi Veicolo </p>
            ";
        }
        else if($this->checkFileName("addEvento.php")){
            echo"<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
                Aggiungi Evento </p>
            ";
        }
        else if($this->checkFileName("pagina_avvisi.php")){
            echo"<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
                Pagina Avvisi </p>
            ";
        }
	    
	    else if($this->checkFileName("listaBiglietti.php")){
            echo"<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
                Lista Biglietti </p>
            ";
        }
        else if($this->checkFileName("selectEventoToEdit.php")){
            echo"<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
            Modifica Evento </p>
            ";
        }
        else if($this->checkFileName("editorEventi.php")){
            echo"<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
            <a href=\"selectEventoToEdit.php\">Modifica evento</a> &gt &gt
            Modifica Singolo Evento </p>
            ";
        }
        else if($this->checkFileName("404.php")){
            echo"<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
                Errore 404 </p>
            ";
        }
    }

    public function printMenu() {
        if ($this->checkFileName("index.php")){
            echo "<li class='shome' id='active' lang=\"en\">Home</li>";
            echo "<li class='schisiamo'><a href=\"chisiamo.php\">Chi Siamo</a></li>";
            echo "<li class='seventi'><a href=\"eventi.php\">Eventi</a></li>";
            echo "<li class='sveicoli'><a href=\"veicoli.php\">Veicoli</a></li>";
        } 
        else if ($this->checkFileName("chisiamo.php")){
            echo "<li class='shome'><a href=\"index.php\" lang=\"en\">Home</a></li>";
            echo "<li class='schisiamo' id='active'>Chi Siamo</li>";
            echo "<li class='seventi'><a href=\"eventi.php\">Eventi</a></li>";
            echo "<li class='sveicoli'><a href=\"veicoli.php\">Veicoli</a></li>";
        } 
        else if ($this->checkFileName("eventi.php")){
            echo "<li class='shome'><a href=\"index.php\" lang=\"en\">Home</a></li>";
            echo "<li class='schisiamo'><a href=\"chisiamo.php\">Chi Siamo</a></li>";
            echo "<li class='seventi' id='active'>Eventi</li>";
            echo "<li class='sveicoli'><a href=\"veicoli.php\">Veicoli</a></li>";
        } 
       else if ($this->checkFileName("veicoli.php")){
            echo "<li class='shome'><a href=\"index.php\" lang=\"en\">Home</a></li>";
            echo "<li class='schisiamo'><a href=\"chisiamo.php\">Chi Siamo</a></li>";
            echo "<li class='seventi'><a href=\"eventi.php\">Eventi</a></li>";
            echo "<li class='sveicoli' id='active'>Veicoli</li>";
        }

        else{
            echo "<li class='shome'><a href=\"index.php\" lang=\"en\">Home</a></li>";
            echo "<li class='schisiamo'><a href=\"chisiamo.php\">Chi Siamo</a></li>";
            echo "<li class='sevento'><a href=\"eventi.php\">Eventi</a></li>";
            echo "<li class='sveicoli'><a href=\"veicoli.php\">Veicoli</a></li>";
        } 

        if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1){
            
            if($this->checkFileName("addVeicolo.php")){
                echo "<li>Aggiungi Veicolo</li>";
            }
            else {
                echo "<li><a href=\"addVeicolo.php\">Aggiungi veicolo</a></li>";
            }
            
            if($this->checkFileName("editorVeicoli.php")){
                echo "<li>Modifica Veicolo</li>";
            }
            else {
                echo "<li><a href=\"editorVeicoli.php\">Modifica Veicolo</a></li>";
            }

            if($this->checkFileName("editorEventiPage.php")){
                echo "<li>Modifica Evento</li>";
            }
            else {
                echo "<li><a href=\"selectEventoToEdit.php\">Modifica Evento</a></li>";
            }


            if($this->checkFileName("addEvento.php")){
                echo "<li>Aggiungi Evento</li>";
            }
            else {
                echo "<li><a href=\"addEvento.php\">Aggiungi Evento</a></li>";
            }
        }
        if(isset($_SESSION['email']) && $_SESSION['email']!='-1'){
            if($this->checkFileName("listaBiglietti.php")){
                echo "<li>Lista Biglietti</li>";
            }
            else {
                echo "<li><a href=\"listaBiglietti.php\">Lista Biglietti</a></li>";
            }
        }
    }

    public function printMessagge($msg,$success){
        if($success){
            echo"<div class=\"success-msg\">";
        }
        else{
            echo"<div class=\"failed-msg\">";
        }
        echo"
            <p>$msg</p>
            </div>";
    }

    public function printLogin(){
        if (!$this->checkFileName("scheda_utente.php")){
            if(!$this->checkUserLog()){ 
                if($this->checkFileName("registrazione.php")){
                    echo "<a>ACCEDI/REGISTRATI</a>";
                } else        
                    echo "<a href=\"registrazione.php\">ACCEDI/REGISTRATI</a>";

            }
            else{
                echo "<a href=\"scheda_utente.php\">VISITA IL TUO PROFILO</a>";
            }
        }
        else {
            echo "SEI NEL TUO PROFILO";
        }   
    }

    
}
?>
