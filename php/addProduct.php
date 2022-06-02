<?php
    require $_SERVER["DOCUMENT_ROOT"]. '/php/model.php';
    require $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';

    check_user(0, false, true);


   
    if(isset($_POST) && isset($_POST['forminscription'])){
        if(isset($_POST['ownerId']) && isset($_POST['productNumber'])  && !empty($_POST['ownerId']) && !empty($_POST['productNumber'])){
            $ownerId=sanitize($_POST['ownerId']);
            $productNumber=sanitize($_POST['productNumber']);
            createProduct($ownerId, $productNumber);
        }
        else{
            header("Location: /product.php?error='echec'");
        }

    }else{
        header("Location: /product.php?error='echec'");
    }



    function sanitize($donne){
        $donne = trim($donne);
        $donne = stripslashes($donne);
        $donne = strip_tags($donne);
        $donne = htmlspecialchars($donne);
        return $donne;
    }
?>