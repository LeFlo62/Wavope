<?php
	if(!isset($_SESSION)) { 
		session_start(); 
	}
	
	include_once 'mysql.php';

	if(isset($_POST) && isset($_POST['login'])){
		if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])){
			$email = sanitize($_POST['email']);
			
			$bdh = new DBHandler();

			$requser = $bdh->getInstance()->prepare('SELECT * FROM users WHERE email = :email');
			$requser->bindparam('email', $email, PDO::PARAM_STR);
			$requser->execute();
			$userexist = $requser->rowCount();

			if($userexist == 1){
				$usercredits = $requser->fetch();
				$hashedPassword = $usercredits['password'];

				if(password_verify($_POST['password'], $hashedPassword)){
					$requserdata = $bdh->getInstance()->prepare('SELECT * FROM user_data WHERE user_id = :user_id');
					$requserdata->bindparam('user_id', $usercredits['id'], PDO::PARAM_INT);
					$requserdata->execute();
					$userdata = $requserdata->fetch();

					$_SESSION['id'] = $usercredits['id'];
                    $_SESSION['firstname'] = $userdata['firstname'];
					$_SESSION['user_rank'] = $userdata['user_rank'];

					header("Location: /?loginSuccess=1");
				} else {
					header("Location: /login.php?error=password");
				}
			} else {
				header("Location: /login.php?error=missing");
			}
		} else {
			header("Location: /login.php?error=completion");
		}
	} else {
		header("Location: /login.php?error=validation");
	}

	function login($username, $password){
		
		
		if (empty($username) OR empty($password)){
			return 'ER_empty';
		}
		
		$requser = $bdh->getInstance()->prepare("SELECT * FROM users WHERE username = ?");
		$requser->execute(array($username));
		$userexist = $requser->rowCount();
		
		if($userexist == 1){
			$userinfo = $requser->fetch();
			if(password_verify($password, $userinfo['password'])){
				$_SESSION['id'] = $userinfo['id'];
				$_SESSION['username'] = $userinfo['username'];

				return 'CONNECTED';
			} else {
				return 'ER_password';
			}
		} else {
			return 'ER_unknown';
		}
	}

	function sanitize($donne){   
        $donne = trim($donne);
        $donne = stripslashes($donne);
        $donne = strip_tags($donne);
        $donne = htmlspecialchars($donne);
        return $donne;
    }
?>

