<?php

    require './php/model.php';
    require './php/check_user.php';

    check_user(0, true);

    $userdata = getUserData($_SESSION['id']);

    require './vues/modifyprofile.php';

?>