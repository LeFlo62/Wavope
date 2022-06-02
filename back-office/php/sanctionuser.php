<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once $_SERVER["DOCUMENT_ROOT"]. '/phpmailer/src/Exception.php';
    require_once $_SERVER["DOCUMENT_ROOT"]. '/phpmailer/src/PHPMailer.php';
    require_once $_SERVER["DOCUMENT_ROOT"]. '/phpmailer/src/SMTP.php';

    include_once $_SERVER["DOCUMENT_ROOT"]. '/php/variables.php';

    include_once $_SERVER["DOCUMENT_ROOT"]. '/php/model.php';

    if(is_ajax()){
        if(!isset($_SESSION)) { 
            session_start(); 
        }
    
        if(!isset($_SESSION['id'])) { 
            header("Location: /login.php");
            exit;
        }
    
        if(RANK_POWER[$_SESSION['user_rank']] < 1){
            header("Location: /");
            exit;
        }
    
        define('ACTIONS', array("delete", "ban"));
    
        if(isset($_POST) && isset($_POST['user_id']) && isset($_POST['action'])){
            if(in_array($_POST['action'], ACTIONS)){
                $user_id = sanitize($_POST['user_id']);
                $action = sanitize($_POST['action']);

                include_once '../../php/mysql.php';
    
                $bdh = new DBHandler();

                $reqinfo = $bdh->getInstance()->prepare("SELECT user_rank,firstname,lastname,banned FROM user_data WHERE user_id = :user_id");
                $reqinfo->bindparam('user_id', $user_id, PDO::PARAM_INT);
                $reqinfo->execute();
                $userexists = $reqinfo->rowCount();


                
                if($userexists == 1){
                    $userinfo = $reqinfo->fetch();

                    $reqemail = $bdh->getInstance()->prepare("SELECT email FROM users WHERE id = :user_id");
                    $reqemail->bindparam('user_id', $user_id, PDO::PARAM_INT);
                    $reqemail->execute();

                    $rank = $userinfo['user_rank'];
                    $email = $reqemail->fetch()['email'];
                    $name = $userinfo['firstname'] . ' ' . $userinfo['lastname'];

                    if(RANK_POWER[$rank] >= RANK_POWER[$_SESSION['user_rank']]){
                        echo json_encode(array('return_type' => 'error', 'message' => 'Vous n\'avez pas la permission de faire cela.'));
                        exit;
                    }
        
                    if($action === 'delete'){
                        $reqresetreq = $bdh->getInstance()->prepare('DELETE FROM register_confirmation WHERE user_id = :user_id');
                        $reqresetreq->bindparam('user_id', $user_id, PDO::PARAM_STR);
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

                        sendSanctionMail($email, $name, 'supprimé');

                        echo json_encode(array('return_type' => 'success', 'message' => 'Utilisateur supprimé.'));
                    } else if($action === 'ban'){
                        $banned = !$userinfo['banned'];

                        $reqban = $bdh->getInstance()->prepare("UPDATE user_data SET banned = :banned WHERE user_id = :user_id");
                        $reqban->bindparam('user_id', $user_id, PDO::PARAM_INT);
                        $reqban->bindparam('banned', $banned, PDO::PARAM_BOOL);
                        $reqban->execute();

                        sendSanctionMail($email, $name, (!$banned ? 'dé' : '') . 'banni');

                        echo json_encode(array('return_type' => 'success', 'message' => 'Utilisateur '. (!$banned ? 'dé' : '') .'banni.'));
                    }
        
                } else {
                    echo json_encode(array('return_type' => 'error', 'message' => 'L\'utilisateur n\'existe pas.'));
                }
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

    function sendSanctionMail($email, $name, $namedAction){
        sendMail($email, $name, "Votre compte Wavope a été ". $namedAction, '<link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
            <center style="
                    font-family: "Roboto", sans-serif;
                    font-size: 1rem;
                    padding: 0px;
                    margin: 0px;
                    background-color: white;">
                <img style="width: 150px; height: auto;" src="https://i.imgur.com/6CFLqM7.png" />
                <br/>
                <br/>
                <br/>
                <p>Votre compte Wavope a été '. $namedAction .' par un membre du staff de Wavope. '. ($namedAction === "débanni" ? "" : "Cette action est irrévocable.") .'</p>
                <br/>
                <br/>
                <br/>
                <br/>
                <img src="https://i.imgur.com/C5sVWQi.png" />
            </center>',
            'Votre Wavope compte a été ' . $namedAction);
   }
?>