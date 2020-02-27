<?php  
	namespace App\Controllers;

	use Core\BaseController;
	use Core\Container;

	class PostsController extends BaseController {

		public function index() {
			$this->setPageTitle('Posts | MVC Framework');

			$model = Container::getModel('Post');

			$this->view->posts = $model->All();

			return $this->renderView('posts/index', 'layout');
		}

		public function show($id) {
			$model = Container::getModel('Post');

			$this->view->post = $model->find($id);

			$this->setPageTitle($this->view->post->title.' | MVC Framework');

			return $this->renderView('posts/show', 'layout');
		}

	}

?>