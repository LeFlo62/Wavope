<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once $_SERVER["DOCUMENT_ROOT"]. '/phpmailer/src/Exception.php';
    require_once $_SERVER["DOCUMENT_ROOT"]. '/phpmailer/src/PHPMailer.php';
    require_once $_SERVER["DOCUMENT_ROOT"]. '/phpmailer/src/SMTP.php';

    require_once $_SERVER["DOCUMENT_ROOT"]. '/php/model.php';


	if(!isset($_SESSION)) { 
		session_start(); 
	}
	
	include_once 'mysql.php';

	if(isset($_POST)){
        if(isset($_POST['method']) && $_POST['method'] === 'c' && isset($_POST['token'])){
            $bdh = new DBHandler();

            $token = sanitize($_POST['token']);

            $reqremoveold = $bdh->getInstance()->prepare("DELETE FROM reset_password WHERE date < SUBTIME(NOW(), '00:15:00')");
            $reqremoveold->execute();

            $reqresetreq = $bdh->getInstance()->prepare('DELETE FROM reset_password WHERE token = :token');
            $reqresetreq->bindparam('token', $token, PDO::PARAM_STR);
            $reqresetreq->execute();

            echo json_encode(array('return_type' => 'success', 'message' => 'La requête a été annulée.'));
        } else if(isset($_POST['method']) && $_POST['method'] === 'r'){
            $bdh = new DBHandler();

            $reqremoveold = $bdh->getInstance()->prepare("DELETE FROM reset_password WHERE date < SUBTIME(NOW(), '00:15:00')");
            $reqremoveold->execute();

            if(isset($_POST['id'])){
                $id = sanitize($_POST['id']);
            } else if(isset($_POST['token'])){
                $token = sanitize($_POST['token']);

                $reqresetreq = $bdh->getInstance()->prepare('SELECT * FROM reset_password WHERE token = :token');
                $reqresetreq->bindparam('token', $token, PDO::PARAM_STR);
                $reqresetreq->execute();

                $reqresetreqexist = $reqresetreq->rowCount();

                if($reqresetreqexist != 0){
                    $id = $reqresetreq->fetch()['user_id'];
                } else {
                    echo json_encode(array('return_type' => 'error', 'message' => 'Requête inexistante ou expirée. '. $reqresetreqexist));
                    exit;
                }
            }

            $reqremovereq = $bdh->getInstance()->prepare("DELETE FROM reset_password WHERE user_id = :user_id");
            $reqremovereq->bindparam('user_id', $id, PDO::PARAM_INT);
            $reqremovereq->execute();

            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $requpdatepassword = $bdh->getInstance()->prepare("UPDATE users SET password = :password WHERE id = :id");
            $requpdatepassword->bindparam('id', $id, PDO::PARAM_INT);
            $requpdatepassword->bindparam('password', $password, PDO::PARAM_STR);
            $requpdatepassword->execute();
            echo json_encode(array('return_type' => 'success', 'message' => 'Votre mot de passe a été modifié !'));
        } else if(isset($_POST['method']) && $_POST['method'] === 'f'){
			$email = sanitize($_POST['email']);
			
			$bdh = new DBHandler();

			$requser = $bdh->getInstance()->prepare('SELECT * FROM users WHERE email = :email');
			$requser->bindparam('email', $email, PDO::PARAM_STR);
			$requser->execute();
			$userexist = $requser->rowCount();

            
			if($userexist == 1){ 
                $userinfo = $requser->fetch();
                
                $reqdata = $bdh->getInstance()->prepare('SELECT * FROM user_data WHERE user_id = :user_id');
                $reqdata->bindparam('user_id', $userinfo['id'], PDO::PARAM_INT);
                $reqdata->execute();
                $data = $reqdata->fetch();
				
                $rand_token = openssl_random_pseudo_bytes(64);
                $token = bin2hex($rand_token);

                $reqremoveprevious = $bdh->getInstance()->prepare("DELETE FROM reset_password WHERE user_id = :user_id");
                $reqremoveprevious->bindparam('user_id', $userinfo['id'], PDO::PARAM_STR);
			    $reqremoveprevious->execute();

                $reqreset = $bdh->getInstance()->prepare("INSERT INTO reset_password(user_id, token) VALUES (:user_id, :token)");
                $reqreset->bindparam('user_id', $userinfo['id'], PDO::PARAM_INT);
                $reqreset->bindparam('token', $token, PDO::PARAM_STR);
			    $reqreset->execute();

               sendPasswordResetMail($email, $data['firstname'] . ' ' . $data['lastname'], $token);
			}

            echo json_encode(array('return_type' => 'success', 'message' => 'Si le compte existe, un e-mail a été envoyé.'));
		} else {
			echo json_encode(array('return_type' => 'error', 'message' => 'Veuillez compléter tous les champs.'));
		}
	} else {
		echo json_encode(array('return_type' => 'error', 'message' => 'Aucune donnée envoyée.'));
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

    function sendPasswordResetMail($email, $name, $token){
         sendMail($email, $name, "Changement de mot de passe Wavope.", '<link rel="preconnect" href="https://fonts.googleapis.com">
             <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
             <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
             <center style="
                    font-family: "Roboto", sans-serif;
                    font-size: 1rem;
                    padding: 0px;
                    margin: 0px;
                    background-color: white;">
                 <img style="width: 150px; height: auto;" src="https://i.imgur.com/6CFLqM7.png" />
                 <p>Vous avez demand&#233; &#224; changer votre mot de passe. Cliquez sur le bouton pour poursuivre. Vous avez 15 minutes avant que la requ&#234;te n\'expire.
                 </p><br/>
                 <a href="https://www.wavope.fr/resetpassword.php?r=r&token='. $token .'" style="
                        padding: 12px 20px;
                        margin: 15px 15px;
                        border-radius: 25px;
                        text-decoration: none;
                        font-family: sans-serif;
                        border-color: #3a3a3a;
                        color: white;
                        background-color: rgb(118, 177, 100);">CHANGER DE MOT DE PASSE</a><br/>
                 <br/>
                 <br/>
                 <p style="font-size: 0.75rem;">Cette demande ne vient pas de vous ? <a href="https://www.wavope.fr/resetpassword.php?r=c&token='. $token .'">Cliquez ici</a><br/></p><br/>
                 <br/>
                 <br/>
                 <img src="https://i.imgur.com/C5sVWQi.png" />
                 </center>', 'Vous avez demandé à changer de mot de passe. Allez à l\'adresse https://www.wavope.fr/resetpassword.php?r=r&token='. $token .' pour poursuivre.
             \n Si ce n\'est pas vous, allez à l\'adresse https://www.wavope.fr/resetpassword.php?r=c&token='. $token);
    }
?>

