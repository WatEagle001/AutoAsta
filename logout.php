<?php

    if ($_SESSION['ID'] != -1){
        session_start();
        session_destroy();
    }
    header("Location: index.php");
    exit();
?>