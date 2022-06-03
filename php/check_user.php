<?php
    include_once $_SERVER["DOCUMENT_ROOT"]. '/php/variables.php';
    require_once $_SERVER["DOCUMENT_ROOT"]. '/php/mysql.php';

    if(!isset($_SESSION)) { 
        session_start(); 
    }

    function check_user($powerRequired = 0, $shouldBeConnected = false, $kickConnected = false){
        if(isset($_SESSION['id'])) { 
            $bdh = new DBHandler();
            $reqban = $bdh->getInstance()->prepare('SELECT banned FROM user_data WHERE user_id = :user_id');
            $reqban->bindparam('user_id', $_SESSION['id'], PDO::PARAM_INT);
            $reqban->execute();
            if($reqban->rowCount() === 0 || $reqban->fetch()['banned']){
                header("Location: /disconnect");
                exit;
            }
        }

        if($shouldBeConnected){
            if(!isset($_SESSION['id'])) { 
                header("Location: /login");
                exit;
            }

            if(RANK_POWER[$_SESSION['user_rank']] < $powerRequired){
                header("Location: /");
                exit;
            }
        } else {
            if(isset($_SESSION['id']) && $kickConnected) { 
                header("Location: /");
                exit;
            }
        }
    }

?>