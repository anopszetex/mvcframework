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

			if(isset($this->view->post->title)) {
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
				'title'   => $request->post->title,
				'content' => $request->post->content
			];

			if($this->post->create($data))
				Redirect::route('/posts');
			else
				die('Error: Create a new post has failed.');
		}


	}

?>