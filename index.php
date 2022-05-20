<?php
    require_once $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';
    check_user();
    
    require './php/model.php';

    $cards = getCards();

    require './vues/index.php';

?>