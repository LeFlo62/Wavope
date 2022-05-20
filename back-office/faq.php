<?php
    require_once $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';
    check_user(1, true);

    require $_SERVER["DOCUMENT_ROOT"] . '/php/model.php';

    $faq = getFAQ();

    require $_SERVER["DOCUMENT_ROOT"] . '/back-office/vues/faq.php';

?>