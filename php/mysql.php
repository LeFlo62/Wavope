<?php

	require_once $_SERVER["DOCUMENT_ROOT"]. '/php/passwords.php';

	class DBHandler{
		private $db;
	
		private $address = '149.202.75.88';
		private $database = 'wavope';
		private $username = 'wavope';

		function __construct(){
			$this->connect();
		}
		
		private function connect(){
			global $databasePassword;
			try {
				$host = 'mysql:host='. $this->address .';port=3306;dbname='. $this->database .';charset=utf8';
				$params = array(
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
				);
				
				$this->db = new PDO($host, $this->username, $databasePassword, $params);
			} catch (PDOException $e) {
				die('Erreur de connexion à la base de données ! '. $e->getMessage());
			}
		}
		
		public function getInstance(){
			return $this->db;
		}
	}
?>