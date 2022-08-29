<?php 
class database_Manager{
    private $DB_HOST = "localhost";
    private $DB_NAME = "AutoAsta_merge";
    private $USER = "root";
    private $PWD = "";
    private $connection;

    public function __construct(){
		if (!$this->connectToDatabase($this->DB_NAME))
			throw new Exception();
	}

	public function DatabaseConnection($host,$username,$password,$connection) {
		$this->DB_HOST = $host;
		$this->USER = $username;
		$this->PWD = $password;
		if (!$this->connectToDatabase($this->DB_NAME))
			throw new Exception();
	}

	public function connectToDatabase() {
		$this->connection = mysqli_connect($this->DB_HOST,$this->USER,$this->PWD,$this->DB_NAME);
		if (!$this->connection)
			return false;
		else
			return true;
	}
    
    public function releaseDB(){
        mysqli_close($this->connection);
    }
    
    public function getEventoInfo($id_Evento){
        $query = "SELECT * FROM Evento,Indirizzo WHERE Evento.id_Evento=$id_Evento AND Indirizzo.id_Indirizzo=Evento.indirizzo;";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore in getEventoInfo:" . mysqli_error($this->connection));

        if(mysqli_num_rows($queryResult) == 0){
            return null;
        }
        else{
            $result = array();
            while($row = mysqli_fetch_assoc($queryResult)){
                array_push($result, $row);
            }
            
            $queryResult->free();
            return $result;
        }
    }

    public function getEventiList(){
        $query = "SELECT * FROM Evento ORDER BY data DESC;";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore in getEventiList:" . mysqli_error($this->connection));

        if(mysqli_num_rows($queryResult) == 0){
            return null;
        }
        else{
            $result = array();
            while($row = mysqli_fetch_assoc($queryResult)){
                array_push($result, $row);
            }
            
            $queryResult->free();
            return $result;
        }
    }

    public function checkEventiDate($eventi){
        $checkEventiDate = array();
        
        $date = date("Y-m-d");
        foreach($eventi as $evento){
            if($evento['data'] <  $date){
                array_push($checkEventiDate,true);
            }
            else array_push($checkEventiDate,false);
        }
        return $checkEventiDate;
    }

    public function getVeicoliList(){
        $query = "SELECT * FROM Veicolo, Asta Where Asta.targa_Veicolo = Veicolo.Targa";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore in getVeicoliList:" . mysqli_error($this->connection));

        if(mysqli_num_rows($queryResult) == 0){
            return null;
        }
        else{
            $result = array();
            while($row = mysqli_fetch_assoc($queryResult)){
                array_push($result, $row);
            }
            
            $queryResult->free();
            return $result;
        }
    }

    public function getIdIndirizzo($via,$città,$cap,$num_Civico){
        $query = 
            "SELECT id_Indirizzo FROM Indirizzo 
            WHERE via = '$via' AND città = '$città'
            AND cap = '$cap' AND num_Civico = '$num_Civico' LIMIT 1;";
        
        $queryResult = mysqli_query($this->connection, $query) or die("Errore in getIndirizzi:" . mysqli_error($this->connection));

        if(mysqli_num_rows($queryResult) == 0){
            return null;
        }
        else{
            $result = array();
            while($row = mysqli_fetch_assoc($queryResult)){
                array_push($result, $row);
            }
            
            $queryResult->free();
            return $result;
        }    }

    public function getIndirizzi(){
        $query = "SELECT * FROM Indirizzo";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore in getIndirizzi:" . mysqli_error($this->connection));

        if(mysqli_num_rows($queryResult) == 0){
            return null;
        }
        else{
            $result = array();
            while($row = mysqli_fetch_assoc($queryResult)){
                array_push($result, $row);
            }
            
            $queryResult->free();
            return $result;
        }
    }

    public function getNewVeicoli(){
        $query = "SELECT * FROM Veicolo, Asta Where Asta.targa_Veicolo = Veicolo.Targa ORDER BY data_Aggiunta ASC LIMIT 2";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore in getNewVeicoli:" . mysqli_error($this->connection));

        if(mysqli_num_rows($queryResult) == 0){
            return null;
        }
        else{
            $result = array();
            while($row = mysqli_fetch_assoc($queryResult)){
                array_push($result, $row);
            }
            
            $queryResult->free();
            return $result;
        }
    }

    public function getNextEvento(){
        $query = "SELECT * FROM Evento WHERE data >= CURRENT_TIMESTAMP  LIMIT 1;";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore in getNextEvento:" . mysqli_error($this->connection));

        if(mysqli_num_rows($queryResult) == 0){
            return null;
        }
        else{
            $result = array();
            while($row = mysqli_fetch_assoc($queryResult)){
                array_push($result, $row);
            }
            
            $queryResult->free();
            return $result;
        }
    }

    public function getUserInfo($email){
        $query = "SELECT* FROM Utente,Account WHERE Utente.Email='$email' AND Utente.Email=Account.email;";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore in getUserInfo:" . mysqli_error($this->connection));
        if(mysqli_num_rows($queryResult) == 0){
            return null;
        }
        else{
            $result = array();
            while($row = mysqli_fetch_assoc($queryResult)){
                array_push($result, $row);
            }
            $queryResult->free();
            return $result;
        }
    }

    public function getListaBiglietti($email){
        $query = "SELECT * FROM Biglietto WHERE Biglietto.utente='$email';";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore in getUserInfo:" . mysqli_error($this->connection));
        if(mysqli_num_rows($queryResult) == 0){
            return null;
        }
        else{
            $result = array();
            while($row = mysqli_fetch_assoc($queryResult)){
                array_push($result, $row);
            }
            $queryResult->free();
            return $result;
        }    
    } 

    public function query($query) {
		return mysqli_query($this->connection,$query);
	}

    public function getError() {
		return $this->connection->errno;
	}

    public function getInfoVeicolo($targa){
        $query = "SELECT * FROM Veicolo,Asta WHERE Targa='$targa' AND Asta.targa_Veicolo='$targa'";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore nel recupero dei dati del veicolo:" . mysqli_error($this->connection));
        if(mysqli_num_rows($queryResult) == 0){
            return null;
        }
        else{
            $result = array();
            while($row = mysqli_fetch_assoc($queryResult)){
                array_push($result, $row);
            }
            $queryResult->free();
            return $result;
        }
    }

    public function getAllTarghe(){
        $query = "SELECT Targa FROM Veicolo";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore in getAllTarghe:" . mysqli_error($this->connection));
        if(mysqli_num_rows($queryResult) == 0){
            return null;
        }
        else{
            $result = array();
            while($row = mysqli_fetch_assoc($queryResult)){
                array_push($result, $row);
            }
            $queryResult->free();
            return $result;
        }
    }
}
?>