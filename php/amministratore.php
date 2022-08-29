<?php 
require_once('utente_Registrato.php');
class amministratore extends utente_Registrato {
    public function __construct($user){
        parent::__construct($user);
        if(!$this->hasAdminRole()){
            throw new Exception("Utente".$user."selezionato non è amministratore");
        }
    }

    private function hasAdminRole(){
        $checkID = $this->getID();
        $query = $this->getDB()->query("SELECT IsAdmin FROM Account WHERE id_Account=$checkID");
        $isAdmin = $query->fetch_row()[0];
        return $isAdmin == 1;
    }

    public function isAdmin(){
        return true;
    }
}
?>