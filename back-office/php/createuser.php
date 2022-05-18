<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once $_SERVER["DOCUMENT_ROOT"]. '/phpmailer/src/Exception.php';
    require_once $_SERVER["DOCUMENT_ROOT"]. '/phpmailer/src/PHPMailer.php';
    require_once $_SERVER["DOCUMENT_ROOT"]. '/phpmailer/src/SMTP.php';

    include_once $_SERVER["DOCUMENT_ROOT"]. '/php/variables.php';

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
    
        if(isset($_POST) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['birthdate']) && isset($_POST['rank'])
            && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['birthdate']) && !empty($_POST['rank'])){
            $firstname = sanitize($_POST['firstname']);
            $lastname = sanitize($_POST['lastname']);
            $email = sanitize($_POST['email']);
            $birthdate = sanitize($_POST['birthdate']);
            $rank = sanitize($_POST['rank']);
            
            if(RANK_POWER[$rank] >= RANK_POWER[$_SESSION['user_rank']]){
                echo json_encode(array('return_type' => 'error', 'message' => 'Vous n\'avez pas la permission de faire cela.'));
                exit;
            }

            include_once '../../php/mysql.php';

            $bdh = new DBHandler();

            $reqexists = $bdh->getInstance()->prepare("SELECT * FROM users WHERE email = :email");
            $reqexists->bindparam('email', $email, PDO::PARAM_STR);
            $reqexists->execute();
            $userexists = $reqinfo->rowCount();

            if($userexists == 0){
                $rand_token = openssl_random_pseudo_bytes(64);
                $password = password_hash(base_convert($rand_token, 2, 36), PASSWORD_BCRYPT);

                $reqcreateuser = $bdh->getInstance()->prepare("INSERT INTO users(email, password) VALUES (:email, :password)");
                $reqcreateuser->bindparam('email', $email, PDO::PARAM_STR);
                $reqcreateuser->bindparam('password', $password, PDO::PARAM_STR);
                $reqcreateuser->execute();

                $createdId = $bdh->getInstance()->lastInsertId();
                $reqinfocreate = $bdh->getInstance()->prepare('INSERT INTO user_data(user_id,firstname,lastname,birthdate,user_rank) VALUES (:user_id, :firstname, :lastname, :birthdate, :user_rank)');
                $reqinfocreate->bindparam('user_id', $createdId, PDO::PARAM_INT);
                $reqinfocreate->bindparam('firstname', $firstname, PDO::PARAM_STR);
                $reqinfocreate->bindparam('lastname', $lastname, PDO::PARAM_STR);
                $reqinfocreate->bindparam('birthdate', $birthdate, PDO::PARAM_STR);
                $reqinfocreate->bindparam('user_rank', $rank, PDO::PARAM_STR);
                $reqinfocreate->execute();

                sendCreationMail($email, $firstname . ' ' . $lastname);
            } else {
                echo json_encode(array('return_type' => 'error', 'message' => 'Un utilisateur existe déjà avec cette adresse e-mail.'));
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

    function sendCreationMail($email, $name){
        // passing true in constructor enables exceptions in PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->Username = 'noreply.wavope@gmail.com'; // YOUR gmail email
            $mail->Password = 'IJHqJl^BW8u5D6G9'; // YOUR gmail password

            // Sender and recipient settings
            $mail->setFrom('noreply.wavope@gmail.com', 'Wavope');
            $mail->addAddress($email, $name);
            $mail->addReplyTo('noreply.wavope@gmail.com', 'No Reply'); // to set the reply to

            // Setting the email content  
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->IsHTML(true);
            $mail->Subject = "Création de compte sur Wavope. Changez votre mot de passe.";
            $mail->Body = '<link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
            <center>
                <img style="width: 150px; height: auto;" src="https://i.imgur.com/6CFLqM7.png" />
                <p>Un compte sur Wavope vous a été créé. Vous devez changer votre mot de passe afin d\'y accéder</p><br/>
                <a href="http://localhost/resetpassword.php?r=f" id="changePassword">DEMANDER LE CHANGEMENT DE MOT DE PASSE</a><br/>
                <br/>
                <br/>
                <p style="font-size: 0.75rem;">Cette demande ne vient pas de vous ? <a href="http://localhost/resetpassword.php?r=c&token='. $token .'">Cliquez ici</a><br/></p><br/>
                <br/>
                <br/>
                <img src="https://i.imgur.com/C5sVWQi.png" />
                </center>
            <style type="text/css">
                center{
                    font-family: "Roboto", sans-serif;
                    font-size: 1rem;
                    padding: 0px;
                    margin: 0px;
                    background-color: white;
                }
            
                #changePassword{
                    padding: 12px 20px;
                    margin: 15px 15px;
                    border-radius: 25px;
                    text-decoration: none;
                    font-family: sans-serif;
                    border-color: #3a3a3a;
                    color: white;
                    background-color: rgb(118, 177, 100);
                }
            </style>';
            $mail->AltBody = 'Vous avez demandé à changer de mot de passe. Allez à l\'adresse http://localhost/resetpassword.php?r=r&token='. $token .' pour poursuivre.
            \n Si ce n\'est pas vous, allez à l\'adresse http://localhost/resetpassword.php?r=c&token='. $token .'';

            $mail->send();
        } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }
   }
?>