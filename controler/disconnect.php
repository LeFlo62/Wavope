<?php
	session_start();
	$_SESSION = array();
	session_destroy();

	echo 'Déconnexion en cours...';

	header('Location: /');
    exit;
?>