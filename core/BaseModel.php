<?php
	/*
		the ideal is that the class name should be the same as the table
	*/

	namespace Core;

	use PDO;

	abstract class BaseModel {

		private $pdo;
		protected $table;

		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}

		public function All() {
			$query   = "SELECT * FROM `{$this->table}`";
			$stmt    = $this->pdo->prepare($query);
			$stmt->execute();
			$results = $stmt->fetchAll();

			$stmt->closeCursor();
			return $results;
		}

		public function find($id) {
			$query  = "SELECT * FROM `{$this->table}` WHERE id = :id";
			$stmt   = $this->pdo->prepare($query);
			$stmt->execute(array(':id' => $id));
			$result = $stmt->fetch(); 

			$stmt->closeCursor();
			return $result;
		}

		public function create(array $data) {
			$data   = $this->prepareDataInsert($data);
			$query  = "INSERT INTO `{$this->table}` ({$data[0]}) VALUES ({$data[1]})";
			$stmt   = $this->pdo->prepare($query);
			$result = $stmt->execute($data[2]);
			$stmt->closeCursor();
			return $result;
		}

		public function update(array $data, $id) {
			$data   = $this->prepareDataUpdate($data, $id);
			$query  = "UPDATE `{$this->table}` SET {$data[0]} WHERE id = :id";
			$stmt   = $this->pdo->prepare($query);
			$result = $stmt->execute($data[1]);
			$stmt->closeCursor();
			return $result;
		}

		private function prepareDataUpdate(array $data, $id) {
			$columns = '';
			$i 		 = 1;

			foreach($data as $name => $value) {
				$columns .= "{$name} = :{$name}";

				if($i < count($data))
					$columns .= ', ';
					$i++;
			}

			foreach($data as $key => $value) {
				$getValues[':'.$key] = $value;
			}
				$getValues[':id'] 	 = $id;

			return [$columns, $getValues];
		}

		private function prepareDataInsert(array $data) {
			$columns    = implode(', ', array_keys($data));
			$values  	= ':'.implode(', :', array_keys($data));
			$getValues  = array();

			foreach($data as $key => $value) {
				$getValues[':'.$key] = $value;
			}

			return [$columns, $values, $getValues];
		}


	}


?>