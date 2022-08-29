<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if ($_SESSION['ID'] != -1){
        session_start();
        session_destroy();
    }
    header("Location: index.php");
    exit();
?>