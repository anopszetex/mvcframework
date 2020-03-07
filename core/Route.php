<?php
	namespace Core;
	
	/*
		class that will handle routes system
	*/

	class Route {

		private $routes = [];

		public function __construct(array $routes) {
			$this->setRoutes($routes);
			$this->run();
		}

		private function setRoutes($routes) {
			$newRoute = array();

			foreach($routes as $route) {
				$getRoute   = explode('@', $route[1]);
				$newRoute[] = [$route[0], $getRoute[0], $getRoute[1]];
			}

			$this->routes = $newRoute;
		}

		private function getRequest() {
			$obj = new \stdClass;

			if(Container::isNotEmpty($_GET))
				$obj->get  = (object)$_GET;

			if(Container::isNotEmpty($_POST))
				$obj->post = (object)$_POST;

			return $obj;
		}

		private function instanceMethods($params, $controller, $action) {
			$controller = Container::newController($controller);
				
			if(Container::isNotEmpty($params)) {
				$sizeParams = count($params);
				$oldString  = '';
				$getValue   = [];

				for($y = 0; $y < $sizeParams; $y++) {
					$oldString .= $params[$y].',';
					$newString  = substr($oldString, 0, strlen($oldString) - 1);
				}

				print_r($getValue);

				$getValue   = explode(',', $newString);
				$getValue[] = $this->getRequest();
				
				call_user_func_array(array($controller, $action), $getValue);

			} else {
				$controller->$action($this->getRequest());	
			}

		}

		private function getUrl() {
			return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		}

		private function run() {
			$url 	  = $this->getUrl();
			$urlPath  = explode('/', $url);
			
			$found      = false;
			$params     = [];
			$controller = '';
			$action     = '';

			foreach($this->routes as $route) {
				$routePath = explode('/', $route[0]);

				if(count($urlPath) === count($routePath)) {

					foreach($routePath as $key => $value) {
						if(strpos($value, '{') !== false) {
							$routePath[$key] = $urlPath[$key];
							$params[]	     = $urlPath[$key];
						}

						$route[0] = implode('/', $routePath);
					}
				}

				if($url === $route[0]) {
					$found 	    = true;
					$controller = $route[1];
					$action	    = $route[2];
					break;
				}

				$params = [];
			}

			($found) ? $this->instanceMethods($params, $controller, $action) : Container::pageNotFound();

		}


	}


?>