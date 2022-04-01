<?php
	session_start();
	
	include_once 'mysql.php';

	
	function login($username, $password){
		$bdh = new DBHandler();
		
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
?>

