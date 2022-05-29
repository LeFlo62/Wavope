<?php
    require_once $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';

    check_user(0, false, true);

    if(!isset($_GET['r'])){
        header("Location: ?r=r");
    }

    if(!isset($_GET['token'])) { 
        header("Location: /login.php");
        exit;
    }

    $token = $_GET['token'];

    require_once $_SERVER["DOCUMENT_ROOT"]. '/php/mysql.php';

    $bdh = new DBHandler();

    if($_GET['r'] === 'r'){
        $requserid = $bdh->getInstance()->prepare('SELECT user_id FROM register_confirmation WHERE token = :token');
        $requserid->bindparam('token', $token, PDO::PARAM_STR);
        $requserid->execute();
        
        if($requserid->rowCount() == 1){
            $reqresetreq = $bdh->getInstance()->prepare('DELETE FROM register_confirmation WHERE token = :token');
            $reqresetreq->bindparam('token', $token, PDO::PARAM_STR);
            $reqresetreq->execute();

            $success = true;
        }
    } else if($_GET['r'] === 'c'){
        $requserid = $bdh->getInstance()->prepare('SELECT user_id FROM register_confirmation WHERE token = :token');
        $requserid->bindparam('token', $token, PDO::PARAM_STR);
        $requserid->execute();
        if($requserid->rowCount() == 1){
            $user_id = $requserid->fetch()['user_id'];

            $reqresetreq = $bdh->getInstance()->prepare('DELETE FROM register_confirmation WHERE token = :token');
            $reqresetreq->bindparam('token', $token, PDO::PARAM_STR);
            $reqresetreq->execute();

            $reqdeluserdata = $bdh->getInstance()->prepare('DELETE FROM user_data WHERE user_id = :user_id');
            $reqdeluserdata->bindparam('user_id', $user_id, PDO::PARAM_INT);
            $reqdeluserdata->execute();

            $reqdelproduct = $bdh->getInstance()->prepare('DELETE FROM products WHERE user_id = :user_id');
            $reqdelproduct->bindparam('user_id', $user_id, PDO::PARAM_INT);
            $reqdelproduct->execute();

            $reqdeluser = $bdh->getInstance()->prepare('DELETE FROM users WHERE id = :id');
            $reqdeluser->bindparam('id', $user_id, PDO::PARAM_INT);
            $reqdeluser->execute();

            $cancel = true;
        }

        
    }

    require $_SERVER["DOCUMENT_ROOT"]. '/vues/registerconfirmation.php';
?>