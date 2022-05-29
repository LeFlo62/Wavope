<?php
    require_once $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';

    check_user();

    require $_SERVER["DOCUMENT_ROOT"]. '/vues/formulaire.php';
?>