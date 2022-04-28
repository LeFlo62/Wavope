<?php
    session_start();

    include_once 'mysql.php';
    
    if(isset($_POST) && isset($_POST['forminscription'])){
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['birthdate']) && isset($_POST['productnumber']) && isset($_POST['cgu'])
            && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['productnumber']) && !empty($_POST['birthdate'])){
            
            $productNumber = handleText($_POST['productnumber']);
            
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
                    $reqcreate = $bdh->getInstance()->prepare("INSERT INTO users(email, password) VALUES (:email, :password)");
                    $reqcreate->bindparam('email', $email, PDO::PARAM_STR);
                    $reqcreate->bindparam('password', $password, PDO::PARAM_STR);
                    $reqcreate->execute();

                    $createdId = $bdh->getInstance()->lastInsertId();
                    $reqinfocreate = $bdh->getInstance()->prepare('INSERT INTO user_data VALUES (:user_id, :firstname, :lastname, :birthdate, :user_rank)');
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

                    $_SESSION['id'] = $createdId;
                    $_SESSION['firstname'] = $firstname;
                    $_SESSION['user_rank'] = $rank;

                    header("Location: /?registrationSuccess=1");
                } else {
                    header("Location: /inscription.php?error=exists");
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

?>