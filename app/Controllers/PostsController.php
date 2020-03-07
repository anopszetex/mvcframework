<?php  
	namespace App\Controllers;

	use Core\BaseController;
	use Core\Container;
	use Core\Redirect;

	class PostsController extends BaseController {

		private $post;

		public function __construct () {
			parent::__construct();
			$this->post = Container::getModel('Post');
		}

		public function index() {
			$this->setPageTitle('Posts');

			$this->view->posts = $this->post->All();

			return $this->renderView('posts/index', 'layout');
		}

		public function show($id) {
			$this->view->post = $this->post->find($id);

			if(Container::isNotEmpty($this->view->post)) {
				$this->setPageTitle($this->view->post->title.' | MVC Framework');
				return $this->renderView('posts/show', 'layout');
			} else {
				return $this->renderView('404');
			}
		}

		public function create() {
			$this->setPageTitle('New post');
			
			return $this->renderView('posts/create', 'layout');
		}

		public function store($request) {
			$data = [
				'title'   => Container::checkInput($request->post->title),
				'content' => Container::checkInput($request->post->content)
			];

			if($this->post->create($data))
				Redirect::route('/posts');
			else
				die('Error: Create a new post has failed.');
		}

		public function edit($id) {
			$this->view->post = $this->post->find($id);
			
			if(Container::isNotEmpty($this->view->post)) {
				$this->setPageTitle('Edit Post - '.$this->view->post->title);
				return $this->renderView('posts/edit', 'layout');
			}
			
			return $this->renderView('404');			
		}

		public function update($id, $request) {
			/*$data = [
				'title'   => Container::checkInput($request->post->title),
				'content' => Container::checkInput($request->post->content)
			];

			if($this->post->update($data, $id))
				Redirect::route('/posts');
			else
				die('Error: Post update failed.');*/

		}


	}

?>