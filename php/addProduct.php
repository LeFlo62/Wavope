<?php
    require $_SERVER["DOCUMENT_ROOT"]. '/php/model.php';
    require $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';

    check_user(0, false, true);


   
    if(isset($_POST) && isset($_POST['forminscription'])){
        if(isset($_POST['ownerId']) && isset($_POST['productNumber'])  && !empty($_POST['ownerId']) && !empty($_POST['productNumber'])){
            $ownerId=sanitize($_POST['ownerId']);
            $productNumber=sanitize($_POST['productNumber']);
            if (verify_product_number($productNumber)){

                createProduct($ownerId, $productNumber);
                header("Location: /product.php?message='Ajout terminé'");
               
            }else{
                header("Location: /product.php?message='Numéro non compatible'");
                exit;
            }

            
        }else{
            header("Location: /product.php?message='Champ Incomplet'");
            exit;
        }

    }else{
        header("Location: /product.php?message='Mauvais protocol'");
        exit;
    }

    function verify_product_number($productNumber){
        return ctype_digit($productNumber) && intval($productNumber) % (6917*5717) == 443;
    }

    function sanitize($donne){
        $donne = trim($donne);
        $donne = stripslashes($donne);
        $donne = strip_tags($donne);
        $donne = htmlspecialchars($donne);
        return $donne;
    }
?>