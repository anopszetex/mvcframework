<?php  

	namespace Core;

	class Redirect {

		public static function route($url) {
			header('Location: '.$url);
			die();
		}

	}

?>