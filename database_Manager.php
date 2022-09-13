<?php 
class database_Manager{
    private $DB_HOST = "localhost";
    private $DB_NAME = "msold";
    private $USER = "msold";
    private $PWD = "orojaiCailaithu4";
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
        $query = "SELECT * FROM evento,indirizzo WHERE evento.id_Evento='$id_Evento' AND indirizzo.id_Indirizzo=evento.indirizzo;";
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
        $query = "SELECT * FROM evento ORDER BY data ASC;";
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
        $query = "SELECT * FROM veicolo, asta Where asta.targa_Veicolo = veicolo.Targa";
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
            "SELECT id_Indirizzo FROM indirizzo 
            WHERE via = '$via' AND citta = '$città'
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
        $query = "SELECT * FROM indirizzo";
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
        $query = "SELECT * FROM veicolo, asta Where asta.targa_Veicolo = veicolo.Targa ORDER BY veicolo.data_Aggiunta DESC LIMIT 2";
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
        $current_Date = date("Y-m-d H:i:s");
        $query = "SELECT * FROM evento WHERE evento.data >= '$current_Date'  ORDER BY evento.data LIMIT 1;";
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
        $query = "SELECT* FROM utente, account WHERE utente.Email='$email' AND utente.Email=account.email;";
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
        $query = "SELECT * FROM biglietto WHERE biglietto.utente='$email';";
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
        $query = "SELECT * FROM veicolo, asta WHERE Targa='$targa' AND asta.targa_Veicolo='$targa'";
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
        $query = "SELECT Targa FROM veicolo";
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