<?php
    include_once $_SERVER["DOCUMENT_ROOT"]. '/php/variables.php';
    require $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';
    require $_SERVER["DOCUMENT_ROOT"]. '/php/model.php';

    if(is_ajax()){
        check_user(1, true);
    
        define('ACTIONS', array("delete", "modify", "add"));
    
        if(isset($_POST) && isset($_POST['action']) && in_array($_POST['action'], ACTIONS)){
            if($_POST['action'] === 'delete'){
                if(isset($_POST['id']) && !empty($_POST['id'])){
                    removeCardElement(sanitize($_POST['id']));

                    echo json_encode(array('return_type' => 'success', 'message' => 'Carte supprimée'));
                } else {
                    echo json_encode(array('return_type' => 'error', 'message' => 'Données manquantes'));
                }
            } else if($_POST['action'] === 'modify'){
                if(isset($_POST['id']) && isset($_POST['title']) && isset($_POST['preview']) && !empty($_POST['id']) && !empty($_POST['title']) && !empty($_POST['preview'])){
                    modifyCardElement(sanitize($_POST['id']), sanitize($_POST['title']), sanitize($_POST['preview']));

                    echo json_encode(array('return_type' => 'success', 'message' => 'Carte modifiée'));
                } else {
                    echo json_encode(array('return_type' => 'error', 'message' => 'Données manquantes'));
                }
            } else if($_POST['action'] === 'add'){
                if(isset($_POST['title']) && isset($_POST['preview']) && !empty($_POST['title']) && !empty($_POST['preview'])){
                    $id = addCardElement(sanitize($_POST['title']), sanitize($_POST['preview']));

                    echo json_encode(array('return_type' => 'success', 'message' => 'Carte ajoutée', 'data' => array($id)));
                } else {
                    echo json_encode(array('return_type' => 'error', 'message' => 'Données manquantes'));
                }
            } else {
                echo json_encode(array('return_type' => 'error', 'message' => 'Mauvaise action'));
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