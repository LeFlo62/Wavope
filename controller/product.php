<?php
    require_once $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';
    require_once $_SERVER["DOCUMENT_ROOT"]. '/php/model.php';

    check_user(true, 0);

    $sensors = getSensors($_SESSION['id']);

    require $_SERVER["DOCUMENT_ROOT"]. '/vues/product.php';
?>
