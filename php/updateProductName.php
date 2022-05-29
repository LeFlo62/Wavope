<?php
    require $_SERVER["DOCUMENT_ROOT"]. '/php/model.php';
    require $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';

    // check_user(0, false, true);
    
    if(isset($_POST) && isset($_POST['formProductName'])){
        if(isset($_POST['productName']) && (isset($_POST['actualProductName'])  && !empty($_POST['productName'])  && !empty($_POST['actualProductName']) )){
            
            updateProductName($_POST['actualProductName'], $_POST['productName'])
            header("Location: /product.php");
            }
        }
    
