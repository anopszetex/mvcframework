<?php  
	namespace Core;

	/*
		classe that manipulate a session
	*/

	class Session {

		public static function set($key, $value) {
			$_SESSION[$key] = $value;
		}

		public static function get($key) {
			return isset($_SESSION[$key]) ? $_SESSION[$key] : NULL;
		}

		public static function destroy($keys = []) {
			foreach($keys as $key)
				unset($_SESSION[$key]);
		}


	}

?>