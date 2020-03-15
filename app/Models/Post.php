<?php  
	namespace App\Models;

	use Core\BaseModel;

	class Post extends BaseModel {
		
		protected $table = 'posts';

		public function rules() {
			return [
				'title'   => 'required',
				'content' => 'required'
			];
		}

	}

?>