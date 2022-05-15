<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once $_SERVER["DOCUMENT_ROOT"]. '/phpmailer/src/Exception.php';
    require_once $_SERVER["DOCUMENT_ROOT"]. '/phpmailer/src/PHPMailer.php';
    require_once $_SERVER["DOCUMENT_ROOT"]. '/phpmailer/src/SMTP.php';

    if(!isset($_SESSION)) { 
		session_start(); 
	}

    if(isset($_SESSION['id'])) { 
		header("Location: /");
        exit;
	}

    include_once 'mysql.php';
    
    if(isset($_POST) && isset($_POST['forminscription'])){
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['birthdate']) && isset($_POST['productnumber']) && isset($_POST['cgu']) && isset($_POST['password_check'])
            && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_check']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['productnumber']) && !empty($_POST['birthdate'])){
            
            if($_POST['password'] != $_POST['password_check']){
                header("Location: /inscription.php?error=passwords");
                exit;
            }

            $productNumber = sanitize($_POST['productnumber']);
            
            if(verify_product_number($productNumber)){
                $email = sanitize($_POST['email']);
                $firstname = sanitize($_POST['firstname']);
                $lastname = sanitize($_POST['lastname']);
                $birthdate = sanitize($_POST['birthdate']);
                $rank = 'user';

                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                $bdh = new DBHandler();

                $requser = $bdh->getInstance()->prepare('SELECT * FROM users WHERE email = :email');
                $requser->bindparam('email', $email, PDO::PARAM_STR);
                $requser->execute();
                $userexist = $requser->rowCount();

                if($userexist == 0){
                    $reqproduct = $bdh->getInstance()->prepare('SELECT * FROM products WHERE product_number = :product_number');
                    $reqproduct->bindparam('product_number', $productNumber, PDO::PARAM_INT);
                    $reqproduct->execute();
                    $productregistered = $reqproduct->rowCount();

                    if($productregistered == 0){
                        $reqcreate = $bdh->getInstance()->prepare("INSERT INTO users(email, password) VALUES (:email, :password)");
                        $reqcreate->bindparam('email', $email, PDO::PARAM_STR);
                        $reqcreate->bindparam('password', $password, PDO::PARAM_STR);
                        $reqcreate->execute();

                        $createdId = $bdh->getInstance()->lastInsertId();
                        $reqinfocreate = $bdh->getInstance()->prepare('INSERT INTO user_data(user_id,firstname,lastname,birthdate,user_rank) VALUES (:user_id, :firstname, :lastname, :birthdate, :user_rank)');
                        $reqinfocreate->bindparam('user_id', $createdId, PDO::PARAM_INT);
                        $reqinfocreate->bindparam('firstname', $firstname, PDO::PARAM_STR);
                        $reqinfocreate->bindparam('lastname', $lastname, PDO::PARAM_STR);
                        $reqinfocreate->bindparam('birthdate', $birthdate, PDO::PARAM_STR);
                        $reqinfocreate->bindparam('user_rank', $rank, PDO::PARAM_STR);
                        $reqinfocreate->execute();

                        $reqproductcreate = $bdh->getInstance()->prepare('INSERT INTO products(product_number, user_id) VALUES (:product_number, :user_id)');
                        $reqproductcreate->bindparam('product_number', $productNumber, PDO::PARAM_INT);
                        $reqproductcreate->bindparam('user_id', $createdId, PDO::PARAM_INT);
                        $reqproductcreate->execute();

                        $rand_token = openssl_random_pseudo_bytes(64);
                        $token = bin2hex($rand_token);

                        $reqconfirmation = $bdh->getInstance()->prepare('INSERT INTO register_confirmation(token, user_id) VALUES (:token, :user_id)');
                        $reqconfirmation->bindparam('token', $token, PDO::PARAM_STR);
                        $reqconfirmation->bindparam('user_id', $createdId, PDO::PARAM_INT);
                        $reqconfirmation->execute();

                        sendRegisterConfirmationMail($email, $firstname . ' ' . $lastname, $token);

                        header("Location: /login.php?registrationSuccess=1");
                    } else {
                        header("Location: /inscription.php?error=number_registered");
                    }
                } else {
                    header("Location: /inscription.php?error=user_exists");
                }
            } else {
                header("Location: /inscription.php?error=product_number");
            }
        } else {
            header("Location: /inscription.php?error=completion");
        }
    } else {
        header("Location: /inscription.php?error=validation");
    }

    function sanitize($donne){   
        $donne = trim($donne);
        $donne = stripslashes($donne);
        $donne = strip_tags($donne);
        $donne = htmlspecialchars($donne);
        return $donne;
    }

    function verify_product_number($productNumber){
        return ctype_digit($productNumber) && intval($productNumber) % (6917*5717) == 443;
    }

    function sendRegisterConfirmationMail($email, $name, $token){
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
             $mail->Subject = "Confirmation d'inscription sur Wavope.";
             $mail->Body = '<link rel="preconnect" href="https://fonts.googleapis.com">
             <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
             <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
             <center>
                 <img style="width: 150px; height: auto;" src="https://i.imgur.com/6CFLqM7.png" />
                 <p>Vous venez de cr&#233;er votre compte sur Wavope. Cliquez sur le bouton pour poursuivre.
                 </p><br/>
                 <a href="http://localhost/registerconfirmation.php?r=r&token='. $token .'" id="confirm">CONFIRMER INSCRIPTION</a><br/>
                 <br/>
                 <br/>
                 <p style="font-size: 0.75rem;">Cette demande ne vient pas de vous ? <a href="http://localhost/registerconfirmation.php?r=c&token='. $token .'">Cliquez ici</a><br/></p><br/>
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
             
                 #confirm{
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
             $mail->AltBody = 'Vous venez de cr&#233;er votre compte sur Wavope. Allez &#224; l\'adresse http://localhost/registerconfirmation.php?r=r&token='. $token .' pour poursuivre.
             \n Si ce n\'est pas vous, allez &#224; l\'adresse http://localhost/registerconfirmation.php?r=c&token='. $token .'';

             $mail->send();
         } catch (Exception $e) {
             echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
         }
    }

?>