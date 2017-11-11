<?php
class validator{



	public function __construct(){

	}

	public static function check($struct, $data){
		$listErrors = [];
		foreach ($struct as $name => $options) {

			if($options["required"] && self::isEmpty($data[$name])){
				$listErrors[]=$options["msgerror"];
			}
			elseif($options["type"]=="password" && !self::passwordCorrect($data[$name])) {
				$listErrors[]=$options["msgerror"];
			}
			
		}

		return $listErrors;
	}


	public static function isEmpty($var){
		return empty(trim($var));
	}

	public static function passwordCorrect($var){
		return !( strlen($var)<8 || strlen($var)>12 ||
					!preg_match("/[0-9]/", $var) ||
					!preg_match("/[a-z]/", $var) ||
					!preg_match("/[A-Z]/", $var) );	
	}

}









