<?php  
	namespace Core;

	/*
		class that will extends with a base for the controllers and where together 
		functionalities similiar
	*/

	abstract class BaseController {
		
		protected $view;
		
		private $viewPath;
		private $layoutPath;
		private $basePath = __DIR__.'/../app/Views/';

		private $pageTitle   = 'Home | MVC Framework';	
		private $keywords    = 'php, framework, mvc';
		private $description = 'MVC Framework';

		public function __construct() {
			$this->view = new \stdClass;
		}

		protected function renderView($viewPath, $layoutPath = null) {
			$this->viewPath   = $viewPath;
			$this->layoutPath = $layoutPath;

			return (($layoutPath) ? $this->layout() : $this->content());
		}

		protected function content() {
			if(file_exists($this->basePath.$this->viewPath.'.phtml'))
			    require_once($this->basePath.$this->viewPath.'.phtml');
			else
				die('Error: View path not found');
		}

		protected function layout() {
			if(file_exists($this->basePath.$this->layoutPath.'.phtml'))
			    return require_once($this->basePath.$this->layoutPath.'.phtml');
			else
				die('Error: Layout path not found');
		}

		protected function setPageTitle($pageTitle) {
			$this->pageTitle = $pageTitle;
		}

		protected function getPageTitle() {
			return $this->pageTitle;
		}

		protected function setPageKeywords($keywords) {
			$this->keywords = $keywords;
		}

		protected function getPageKeywords() {
			return $this->keywords;
		}

		protected function setPageDescription($description) {
			$this->description = $description;
		}

		protected function getPageDescription() {
			return $this->description;
		}

	}

?>