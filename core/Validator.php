<?php  
	namespace Core;

	/*
		Validation class that check if fields are empty or are allowed
	*/

	class Validator {

		public static function make(array $data, array $rules) {

			$errors = null;

			foreach($rules as $rulesKey => $rulesValue) {

				foreach($data as $dataKey => $dataValue) {
					if($rulesKey === $dataKey) {

						switch(strtolower($rulesValue)) {

							case 'required':
								if(empty(Container::checkInput($dataValue)))
									$errors["$rulesKey"] = "The field {$rulesKey} are required";
							break;

							case 'email':
								if(!filter_var(Container::checkInput($dataValue), FILTER_VALIDATE_EMAIL))
									$errors["$rulesKey"] = "The {$rulesKey} field is invalid";
							break;

						}

					}
				}

			}

			if ($errors) {
	            Session::set('errors', $errors);
	            Session::set('inputs', $data);
	            return true;
	        } else {
	            Session::destroy(['errors', 'inputs']);
	            return false;
	        }


		}


	}

?>