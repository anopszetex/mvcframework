<?php  
	namespace Core;

	use PDO, PDOException;

	class DataBase {

		public static function connect() {
			$config = require_once(__DIR__.'/../app/database.php');

			if(self::isDriverMysql($config['driver'])) {
				$host 	   = $config['mysql']['host'];
				$database  = $config['mysql']['database'];
				$user 	   = $config['mysql']['user'];
				$password  = $config['mysql']['password'];
				$charset   = $config['mysql']['charset'];
				$collation = $config['mysql']['collation'];
				$mysql     = 'mysql:host='.$host.';dbname='.$database.';charset='.$charset;

				try {
					$pdo = new PDO($mysql, $user, $password);
					$pdo->setAttribute(
						PDO::MYSQL_ATTR_INIT_COMMAND,
						'SET NAMES '.$charset.' COLLATE '.$collation
					);

					$pdo->setAttribute(
						PDO::ATTR_DEFAULT_FETCH_MODE, 
						PDO::FETCH_OBJ 
					);

					return $pdo;

				} catch (PDOException $exception) {
					die('failed to connect to database.');
				}
				
			} else {
				$sqlite = __DIR__.'/../storage/database/'.$config['sqlite']['host'];
				$sqlite = 'sqlite:'.$sqlite;
				
				try {
					$pdo = new PDO($sqlite);
					$pdo->setAttribute(
						PDO::ATTR_DEFAULT_FETCH_MODE, 
						PDO::FETCH_ASSOC
					);

					return $pdo;

				} catch (PDOException $exception) {
					die('failed to connect to database.');
				}

			}

		}

		public static function isDriverMysql($driver) {
			return Container::checkInput($driver) === 'mysql';
		}

	}

?>