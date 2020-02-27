<?php
	/*
		the ideal is that the class name should be the same as the table
	*/

	namespace Core;

	use PDO;

	class BaseModel {

		private $pdo;
		protected $table;

		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}

		public function All() {
			$query   = "SELECT * FROM {$this->table}";
			$stmt    = $this->pdo->prepare($query);
			$stmt->execute();
			$results = $stmt->fetchAll();

			$stmt->closeCursor();
			return $results;
		}

		public function find($id) {
			$query  = "SELECT * FROM {$this->table} WHERE id = :id";
			$stmt   = $this->pdo->prepare($query);
			$stmt->execute(array(':id' => $id));
			$result = $stmt->fetch(); 

			$stmt->closeCursor();
			return $result;
		}

	}


?>