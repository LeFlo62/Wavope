<?php
    include_once $_SERVER["DOCUMENT_ROOT"]. '/php/variables.php';
    require $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';
    require $_SERVER["DOCUMENT_ROOT"]. '/php/model.php';

    if(is_ajax()){
        check_user(1, true);
    
        define('ACTIONS', array("order", "delete", "modify", "add"));
    
        if(isset($_POST) && isset($_POST['action']) && in_array($_POST['action'], ACTIONS)){
            if($_POST['action'] === 'order'){
                if(isset($_POST['elem_id']) && isset($_POST['switch_id']) && !empty($_POST['elem_id']) && !empty($_POST['switch_id'])){
                    switchFAQElements(sanitize($_POST['elem_id']), sanitize($_POST['switch_id']));

                    echo json_encode(array('return_type' => 'success', 'message' => 'Ordre changé'));
                } else {
                    echo json_encode(array('return_type' => 'error', 'message' => 'Données manquantes'));
                }
            } else if($_POST['action'] === 'delete'){
                if(isset($_POST['elem_id']) && !empty($_POST['elem_id'])){
                    removeFAQElement(sanitize($_POST['elem_id']));

                    echo json_encode(array('return_type' => 'success', 'message' => 'Question supprimée'));
                } else {
                    echo json_encode(array('return_type' => 'error', 'message' => 'Données manquantes'));
                }
            } else if($_POST['action'] === 'modify'){
                if(isset($_POST['id']) && isset($_POST['question']) && isset($_POST['answer']) && !empty($_POST['id']) && !empty($_POST['question']) && !empty($_POST['answer'])){
                    modifyFAQElement(sanitize($_POST['id']), sanitize($_POST['question']), sanitize($_POST['answer']));

                    echo json_encode(array('return_type' => 'success', 'message' => 'Question ajoutée'));
                } else {
                    echo json_encode(array('return_type' => 'error', 'message' => 'Données manquantes'));
                }
            } else if($_POST['action'] === 'add'){
                if(isset($_POST['question']) && isset($_POST['answer']) && !empty($_POST['question']) && !empty($_POST['answer'])){
                    $id = addFAQElement(sanitize($_POST['question']), sanitize($_POST['answer']));

                    echo json_encode(array('return_type' => 'success', 'message' => 'Question ajoutée', 'data' => array($id)));
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