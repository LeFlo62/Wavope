<?php
    if(is_ajax()){
        if(!isset($_SESSION)) { 
            session_start(); 
        }
    
        if(!isset($_SESSION['id'])) { 
            header("Location: /login.php");
            exit;
        }
    
        if($_SESSION['user_rank'] !== 'admin'){
            header("Location: /");
            exit;
        }
    
        define('DATA_TYPES', array("firstname", "lastname", "email"));
    
        if(isset($_POST) && isset($_POST['user_id']) && isset($_POST['data_type']) && isset($_POST['data'])){
            if(in_array($_POST['data_type'], DATA_TYPES)){
                include_once '../../php/mysql.php';
    
                $user_id = sanitize($_POST['user_id']);
                $data_type = sanitize($_POST['data_type']);
                $data = sanitize($_POST['data']);
    
                $bdh = new DBHandler();
    
                if($_POST['data_type'] === 'email'){
                    $reqmodify = $bdh->getInstance()->prepare("UPDATE users SET email = :user_data WHERE id = :id");
                } else {
                    $reqmodify = $bdh->getInstance()->prepare("UPDATE user_data SET ". $data_type ." = :user_data WHERE user_id = :id");
                }
                $reqmodify->bindparam('user_data', $data, PDO::PARAM_STR);
                $reqmodify->bindparam('id', $user_id, PDO::PARAM_INT);
                $reqmodify->execute();
    
                echo json_encode(array('return_type' => 'success', 'message' => 'Donnée modifiée'));
            } else {
                echo json_encode(array('return_type' => 'error', 'message' => 'Cette donnée ne peut être modifiée.'));
            }
        } else {
            echo json_encode(array('return_type' => 'error', 'message' => 'Aucune donnée transmise'));
        }
    } else {
        echo json_encode(array('return_type' => 'error', 'message' => 'Mauvais protocol'));
    }

    function sanitize($donne){   
        $donne = trim($donne);
        $donne = stripslashes($donne);
        $donne = strip_tags($donne);
        $donne = htmlspecialchars($donne);
        return $donne;
    }

    /**
     * 
     * @return BOOl, true if ajax, false if regular way
     */
    function is_ajax(){
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']);
    }
?>