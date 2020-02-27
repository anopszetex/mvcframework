<?php  
	namespace Core;
	
	/*	
		class with functions geral useful used in system
	*/

	class Container {

		public static function newController($controller) {
			$objController = 'App\\Controllers\\'.$controller;
			return new $objController;
		}

		public static function getModel($model) {
			$objModel = 'App\\Models\\'.$model;
			return new $objModel(DataBase::connect());
		}

		public static function pageNotFound() {
			if(file_exists(__DIR__.'/../app/Views/404.phtml'))
				return require_once(__DIR__.'/../app/Views/404.phtml');
			else
				echo 'Error: route path not found';
		}

		public static function isNotEmpty($input) {
			return isset($input) && !empty($input);
		}

		public static function checkInput($input) {
			return htmlspecialchars(trim(stripcslashes($input)));
		}

	}

?>