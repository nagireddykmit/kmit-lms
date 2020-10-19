<?php 
	class DbConnect {
		private $host = 'localhost:3306';
		private $dbName = 'finalelms';
		private $user = 'admin';
		private $pass = 'kmit@3306';

		public function connect() {
			try {
				$conn = new PDO('mysql:host=' . $this->host . ';port=3306; dbname=' . $this->dbName, $this->user, $this->pass);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;
			} catch( PDOException $e) {
				echo 'Database Error: ' . $e->getMessage();
			}
		}
	}
 ?>