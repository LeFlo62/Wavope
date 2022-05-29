<?php
    require_once $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';

    check_user(0, false, true);

    require $_SERVER["DOCUMENT_ROOT"]. '/vues/login.php';
?>