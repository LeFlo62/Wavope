<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once $_SERVER["DOCUMENT_ROOT"]. '/phpmailer/src/Exception.php';
    require_once $_SERVER["DOCUMENT_ROOT"]. '/phpmailer/src/PHPMailer.php';
    require_once $_SERVER["DOCUMENT_ROOT"]. '/phpmailer/src/SMTP.php';

    include_once $_SERVER["DOCUMENT_ROOT"]. '/php/mysql.php';
    $bdh = new DBHandler();

    function getCards(){
        global $bdh;
        $reqdata = $bdh->getInstance()->prepare("SELECT title, date, content FROM cards ORDER BY date desc"); 
        $reqdata->execute();
        $data = $reqdata->fetchAll();
        return $data;
    }

    function getUserData($user_id){
        global $bdh;
        $requserdata = $bdh->getInstance()->prepare('SELECT * FROM user_data WHERE user_id = :user_id');
        $requserdata->bindparam('user_id', $user_id, PDO::PARAM_INT);
        $requserdata->execute();
        $userdata = $requserdata->fetch();
        return $userdata;
    }

    function getUsers(){
        global $bdh;
        $reqdata = $bdh->getInstance()->prepare("SELECT id,firstname,lastname,email,birthdate,user_rank,banned FROM users JOIN user_data ON users.id = user_data.user_id GROUP BY users.id;");
        $reqdata->execute();
        $data = $reqdata->fetchAll();
        return $data;
    }

    function getDevices(){
        global $bdh;
        $reqdata = $bdh->getInstance()->prepare("SELECT product_number,name,firstname,lastname,user_rank,products.user_id FROM products JOIN user_data ON products.user_id = user_data.user_id");
        $reqdata->execute();
        $data = $reqdata->fetchAll();
        return $data;
    }

    function getFAQ(){
        global $bdh;
        $reqfaq = $bdh->getInstance()->prepare("SELECT * FROM faq ORDER BY ordering");
        $reqfaq->execute();
        $faq = $reqfaq->fetchAll();
        return $faq;
    }

    function userExistsByMail($email){
        global $bdh;
        $requser = $bdh->getInstance()->prepare('SELECT * FROM users WHERE email = :email');
        $requser->bindparam('email', $email, PDO::PARAM_STR);
        $requser->execute();
        return $requser->rowCount() !== 0;
    }

    function productExists($productNumber){
        global $bdh;
        $reqproduct = $bdh->getInstance()->prepare('SELECT * FROM products WHERE product_number = :product_number');
        $reqproduct->bindparam('product_number', $productNumber, PDO::PARAM_INT);
        $reqproduct->execute();
        return $reqproduct->rowCount() !== 0;
    }

    function createUser($email, $password, $firstname, $lastname, $birthdate, $rank){
        global $bdh;

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

        return $createdId;
    }

    function createProduct($ownerId, $productNumber){
        global $bdh;
        $reqproductcreate = $bdh->getInstance()->prepare('INSERT INTO products(product_number, user_id) VALUES (:product_number, :user_id)');
        $reqproductcreate->bindparam('product_number', $productNumber, PDO::PARAM_INT);
        $reqproductcreate->bindparam('user_id', $ownerId, PDO::PARAM_INT);
        $reqproductcreate->execute();

        return $bdh->getInstance()->lastInsertId();
    }

    function updateProductName($productNumber, $productName){
        global $bdh;
        $reqmodify = $bdh->getInstance()->prepare("UPDATE products SET name = :user_data WHERE product_number = :product_number");

        $reqmodify->bindparam('user_data', $productName, PDO::PARAM_STR);
        $reqmodify->bindparam('product_number', $productNumber, PDO::PARAM_INT);
        $reqmodify->execute();
    }

    function updateUserData($userId, $dataType, $data){
        global $bdh;
        if($dataType === 'email'){
            $reqmodify = $bdh->getInstance()->prepare("UPDATE users SET email = :user_data WHERE id = :id");
        } else {
            $reqmodify = $bdh->getInstance()->prepare("UPDATE user_data SET ". $dataType ." = :user_data WHERE user_id = :id");
        }
        $reqmodify->bindparam('user_data', $data, PDO::PARAM_STR);
        $reqmodify->bindparam('id', $userId, PDO::PARAM_INT);
        $reqmodify->execute();
    }

    function createRegisterConfirmation($userId){
        global $bdh;
        $rand_token = openssl_random_pseudo_bytes(64);
        $token = bin2hex($rand_token);

        $reqconfirmation = $bdh->getInstance()->prepare('INSERT INTO register_confirmation(token, user_id) VALUES (:token, :user_id)');
        $reqconfirmation->bindparam('token', $token, PDO::PARAM_STR);
        $reqconfirmation->bindparam('user_id', $createdId, PDO::PARAM_INT);
        $reqconfirmation->execute();

        return $token;
    }

    function switchFAQElements($elemId, $switchId){
        global $bdh;

        $requpdate = $bdh->getInstance()->prepare("UPDATE faq
                                                    SET ordering = ( SELECT SUM(ordering) 
                                                                FROM (SELECT * FROM faq) AS faqq
                                                                WHERE id IN (:id_elem, :id_switch)
                                                            ) - ordering
                                                    WHERE id IN (:id_elem, :id_switch)");
        $requpdate->bindparam('id_elem', $elemId, PDO::PARAM_INT);
        $requpdate->bindparam('id_switch', $switchId, PDO::PARAM_INT);
        $requpdate->execute();
    }

    function removeFAQElement($elemId){
        global $bdh;

        $reqchangeorder = $bdh->getInstance()->prepare("UPDATE faq SET ordering = ordering-1 WHERE ordering > (SELECT ordering FROM (SELECT * FROM faq) AS faqq WHERE id = :id)");
        $reqchangeorder->bindparam('id', $elemId, PDO::PARAM_INT);
        $reqchangeorder->execute();

        $reqremove = $bdh->getInstance()->prepare("DELETE FROM faq WHERE id = :id");
        $reqremove->bindparam('id', $elemId, PDO::PARAM_INT);
        $reqremove->execute();
    }

    function sendMail($email, $name, $subject, $body, $altBody){
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
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = $altBody;

            $mail->send();
        } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }
    }

?>