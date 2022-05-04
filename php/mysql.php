<?php 
	class DBHandler{
		private $db;
		
		function __construct(){
			$this->connect();
		}
		
		private function connect(){
			try {
				$host = 'mysql:host=149.202.75.88;port=3306;dbname=wavope;charset=utf8';
				$params = array(
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
				);
				
				$this->db = new PDO($host, 'wavope', '07modIXrejFX9d!c0d^ysb9WHAH#daBw', $params);
			} catch (PDOException $e) {
				die('Erreur de connexion à la base de données ! '. $e->getMessage());
			}
		}
		
		public function getInstance(){
			return $this->db;
		}
	}
?>