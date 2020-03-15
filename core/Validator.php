<?php  
	namespace Core;

	/*
		Validation class that check if fields are empty or are allowed
	*/

	class Validator {

		public static function make(array $data, array $rules) {

			$errors = null;

			foreach($rules as $ruleKey => $ruleValue) {

				if(stristr($ruleValue, ':')) {
					$items = explode(':', $ruleValue);

					foreach($data as $dataKey => $dataValue) {
						if($ruleKey === $dataKey) {

							switch($items[0]) {
								case'min':
									if(strlen($dataValue) < $items[1])
										$errors["$ruleKey"] = "Use at least {$items[1]} characters";
								break;

								case 'max':
									if(strlen($dataValue) > $items[1])
										$errors["$ruleKey"] = "The {$ruleKey} must be at least {$items[1]} characters long";
								break;

								case 'regex':
									if(!preg_match($items[1], $dataValue))
										$errors["$ruleKey"] = "{$ruleKey} invalid field";
								break;
							}
						}
					}

				} else {

					foreach($data as $dataKey => $dataValue) {
						if($ruleKey === $dataKey) {

							switch(strtolower($ruleValue)) {

								case 'required':
									if(empty(Container::checkInput($dataValue)))
										$errors["$ruleKey"] = "The field {$ruleKey} are required";
								break;

								case 'email':
									if(!filter_var(Container::checkInput($dataValue), FILTER_VALIDATE_EMAIL))
										$errors["$ruleKey"] = "The {$ruleKey} field is invalid";
								break;

							}

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