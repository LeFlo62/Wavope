<?php

    include_once 'mysql.php';
    
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['id'])){
        header("Location: /login.php");
        exit;
    }

    if(isset($_POST)){
        if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['birthdate'])
            && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['birthdate'])){
                $firstname = sanitize($_POST['firstname']);
                $lastname = sanitize($_POST['lastname']);
                $birthdate = sanitize($_POST['birthdate']);

                $bdh = new DBHandler();
                $requpdatedata = $bdh->getInstance()->prepare('UPDATE user_data SET firstname = :firstname, lastname = :lastname, birthdate = :birthdate WHERE user_id = :user_id');
                $requpdatedata->bindparam('user_id', $_SESSION['id'], PDO::PARAM_INT);
                $requpdatedata->bindparam('firstname', $firstname, PDO::PARAM_STR);
                $requpdatedata->bindparam('lastname', $lastname, PDO::PARAM_STR);
                $requpdatedata->bindparam('birthdate', $birthdate, PDO::PARAM_STR);
                $requpdatedata->execute();

                header("Location: /modifyprofile.php?success=1");
        } else {
            header("Location: /modifyprofile.php?error=completion");
            exit;
        }
    } else {
        header("Location: /modifyprofile.php?error=validation");
        exit;
    }

    function sanitize($donne){   
        $donne = trim($donne);
        $donne = stripslashes($donne);
        $donne = strip_tags($donne);
        $donne = htmlspecialchars($donne);
        return $donne;
    }

?>