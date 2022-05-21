<?php

    require $_SERVER["DOCUMENT_ROOT"]. '/php/model.php';
    require $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';

    check_user(0, true);

    $userdata = getUserData($_SESSION['id']);

    require $_SERVER["DOCUMENT_ROOT"]. '/vues/modifyprofile.php';

?>