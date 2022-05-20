<?php
    include_once $_SERVER["DOCUMENT_ROOT"]. '/php/variables.php';
    require $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';
    require $_SERVER["DOCUMENT_ROOT"]. '/php/model.php';

    if(is_ajax()){
        check_user(1, true);
    
        define('DATA_TYPES', array("firstname", "lastname", "email", "birthdate", "user_rank"));
    
        if(isset($_POST) && isset($_POST['user_id']) && isset($_POST['data_type']) && isset($_POST['data'])){
            if(in_array($_POST['data_type'], DATA_TYPES)){
                $user_id = sanitize($_POST['user_id']);
                $data_type = sanitize($_POST['data_type']);
                $data = sanitize($_POST['data']);

                if($data_type == 'user_rank' && (in_array($data, RANK_POWER) && RANK_POWER[$_SESSION['user_rank']] <= RANK_POWER[$data])){
                    echo json_encode(array('return_type' => 'error', 'message' => 'Vous n\'avez pas la permission de changer cela.'));
                    exit;
                }
                
                updateUserData($user_id, $data_type, $data);
    
                echo json_encode(array('return_type' => 'success', 'message' => 'Donnée modifiée'));
            } else {
                echo json_encode(array('return_type' => 'error', 'message' => 'Cette donnée ne peut pas être modifiée.'));
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