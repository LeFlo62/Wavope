<?php
    require_once $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';

    check_user(0, false);

    if($_GET['r'] === 'r'){
        if(!isset($_SESSION['id']) && !isset($_GET['token'])) { 
            header("Location: /login");
            exit;
        }
    }

    require $_SERVER["DOCUMENT_ROOT"]. '/vues/resetpassword.php';
?>