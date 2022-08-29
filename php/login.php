<?php
    require_once 'session_manager.php';
    $user = login($_POST['email'],$_POST['psw']);
    
    if ($_SESSION['ID'] == -1){
        $_SESSION['login_error'] = true;
        header('Location: login_page.php');
        exit();
    } else {
        unset($_SESSION['login_error']);
        header('Location: index.php');
        exit();
    }
?>