<?php

	class Router {
		
		public static function rota($path, $callback) {
			$url = @$_GET['url'];

			if($path == $url) {
				$callback();
				die();
			}

			//'contato/?'
			$path = explode('/', $path);
			$url  = explode('/', @$_GET['url']);
			$par  = [];
			$ok   = true;
			
			if(count($path) == count($url)) {

				foreach($path as $key => $value) {

					if($value == '?') {
						$par[$key] = $url[$key];

					} else if($url[$key] != $value) {
						$ok = false;
						break;
					}

				}

				if($ok) {
					$callback($par);
					die();
				}

			}

		}


	}

?>