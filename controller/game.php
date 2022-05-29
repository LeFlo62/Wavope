<?php
    require_once $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';

    check_user(0, true);

    require $_SERVER["DOCUMENT_ROOT"]. '/vues/game.php';
?>