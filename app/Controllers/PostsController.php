<?php  
	namespace App\Controllers;

	use Core\BaseController;
	use Core\Container;
	use Core\Redirect;
	use Core\Session;

	class PostsController extends BaseController {

		private $post;

		public function __construct () {
			parent::__construct();
			$this->post = Container::getModel('Post');
		}

		public function index() {
			if(Session::get('success')) {
				$this->view->success = Session::get('success');
				Session::destroy(['success']);
			}

			if(Session::get('errors')) {
				$this->view->errors = Session::get('errors');
				Session::destroy(['errors']);
			}

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
				return Redirect::route('/posts', ['success' => ['Post created successfully']]);
			else
				return Redirect::route('/posts', ['errors'  => ['Create a new post has failed']]);
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
			$data = [
				'title'   => Container::checkInput($request->post->title),
				'content' => Container::checkInput($request->post->content)
			];

			if($this->post->update($data, $id))
				return Redirect::route('/posts', ['success' => ['Post updated successful']]);
			else
				return Redirect::route('/posts', ['errors'  => ['Post update failed']]);
		}

		public function delete($id) {
			if($this->post->delete(['id' => $id]))
				return Redirect::route('/posts', ['success' => ['Post deleted successful']]);
			else
				return Redirect::route('/posts', ['errors'  => ['Post delete failed']]);
		}


	}

?>