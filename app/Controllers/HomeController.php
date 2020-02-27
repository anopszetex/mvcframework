<?php  
	namespace App\Controllers;

	use Core\BaseController;

	class HomeController extends BaseController {

		public function index($request) {
			$this->renderView('home/index', 'layout');
		}

	}

?>