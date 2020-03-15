<?php  
	namespace App\Models;

	use Core\BaseModel;

	class Post extends BaseModel {
		
		protected $table = 'posts';

		public function rules() {
			return [
				'title'   => 'min:2',
				'content' => 'regex:/^[a-zA-z0-9,\.\s]+$/'
			];
		}

	}

?>