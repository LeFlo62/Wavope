<?php
    session_start();
    include_once 'mysql.php';
    if(isset($_POST) && isset($_POST['forminscription'])){
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['birthdate'])){
            $email = handleText($_POST['email']);
            $firstname = handleText($_POST['firstname']);
            $lastname = handleText($_POST['lastname']);
            $birthdate = handleText($_POST['birthdate']);

            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $bdh = new DBHandler();

            $requser = $bdh->getInstance()->prepare("SELECT * FROM users WHERE email = ?");
		    $requser->execute(array($email));
		    $userexist = $requser->rowCount();

            if($userexist == 0){
                $reqcreate = $bdh->getInstance()->prepare("INSERT INTO users VALUES (?, ?)");
                $reqcreate->execute(array($email, $password));

                $createdId = $bdh->getInstance()->lastInsertId();
                $reqinfocreate = $bdh->getInstance()->repare('INSERT INTO user_data VALUES (?, )');
            }
        }
    }

    function handleText($donne){   
        $donne =trim($donne);
        $donne=stripslashes($donne);
        $donne=strip_tags($donne);
        $donne=htmlspecialchars($donne);
        return $donne;
    }

?>