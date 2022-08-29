<?php

require_once('utente_Non_Registrato.php');
require_once('utente_Registrato.php');
require_once('amministratore.php');

function getLoggedUser($email){
    try {
        return new amministratore($email);
    } catch (Exception $exc) {
        try {
            return new utente_Registrato($email);
        } catch (Exception $exc) {
            return new utente_Non_Registrato();
        }
    }
}

function login ($email, $password){
    $user = getLoggedUser($email);
    if($user -> isReg() && !$user->checkPassword($password)){
        $user = new utente_Non_Registrato();
    }
    $user->setSessionVars();
    return $user;
}

function createSession(){
    session_start();
    $user_mail = null;
    if(isset($_SESSION['email'])){
        $user_mail = $_SESSION['email'];
    }
    $user = getLoggedUser($user_mail);
    $user->setSessionVars();
    return $user;
}

?>