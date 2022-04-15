<?php
    session_start();
    include_once 'mysql.php';
    if(isset($_POST) && isset($_POST['forminscription'])){
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['birthdate']) && isset($_POST['cgu'])
            && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['birthdate'])){
            $email = handleText($_POST['email']);
            $firstname = handleText($_POST['firstname']);
            $lastname = handleText($_POST['lastname']);
            $birthdate = handleText($_POST['birthdate']);

            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $bdh = new DBHandler();

            $requser = $bdh->getInstance()->prepare("SELECT * FROM users WHERE email = :email");
            $requser->bindparam("email", $email, PDO::PARAM_STR);
		    $requser->execute();
		    $userexist = $requser->rowCount();

            if($userexist == 0){
                $reqcreate = $bdh->getInstance()->prepare("INSERT INTO users(email, password) VALUES (?, ?)");
                $reqcreate->execute(array($email, $password));

                $createdId = $bdh->getInstance()->lastInsertId();
                $reqinfocreate = $bdh->getInstance()->prepare('INSERT INTO user_data(user_id, firstname, lastname, birthdate, user_rank) VALUES (:user_id, :firstname, :lastname, :birthdate, :user_rank)');
                $reqinfocreate->bindparam("user_id", $createdId, PDO::PARAM_INT);
                $reqinfocreate->bindparam("firstname", $createdId, PDO::PARAM_STR);
                $reqinfocreate->bindparam("lastname", $createdId, PDO::PARAM_STR);
                $reqinfocreate->bindparam("birthdate", $createdId, PDO::PARAM_STR);
                $reqinfocreate->bindparam("rank", $createdId, PDO::PARAM_STR);
                $reqinfocreate->execute(array($createdId, $firstname, $lastname, $birthdate, 'user'));

                $_SESSION['id'] = $createdId;
				$_SESSION['firstname'] = $firstname;

                header("Location: /?registrationSuccess=1");
            } else {
                header("Location: /inscription.php?error=exists");
            }
        } else {
            header("Location: /inscription.php?error=completion");
        }
    } else {
        header("Location: /inscription.php?error=validation");
    }

    function handleText($donne){   
        $donne = trim($donne);
        $donne = stripslashes($donne);
        $donne = strip_tags($donne);
        $donne = htmlspecialchars($donne);
        return $donne;
    }

?>