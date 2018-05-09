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
			if($options["type"]=="password" && !self::passwordDevEnvCorrect($data[$name])) {
				$listErrors[]=$options["msgerror"];
			}
			if($options["type"]=="text" && !self::simpleEntryCorrect($data[$name])) {
				$listErrors[]=$options["msgerror"];
			}
			if($name=="login" && !self::simpleEntryCorrect($data[$name])) {
				$listErrors[]=$options["msgerror"];
			}
			if($name=="email" && !self::emailCorrect($data[$name])) {
				$listErrors[]=$options["msgerror"];
			}
			if($name=="password2" && $data["password1"] != $data["password2"] ) {
				$listErrors[]=$options["msgerror"];
			}

		}

		if(count(array_keys($listErrors, 'password2')) > 1){
				unset($listErrors[array_keys($listErrors, 'password2')[0]]);
		}

/*		echo "<pre>";
		var_dump($listErrors);
		var_dump($data);
		var_dump($struct);
		die();*/
		return $listErrors;
	}


	public static function process($struct, $data, $form){
			switch ($form) {
				case 'signin':
					return Auth::signIn($data);
					break;
				case 'signup':
					return User::signUp($data);
					break;
				case 'articlenew':
					return Article::newArticle($data);
					break;
				case 'categorynew':
					return Category::newCategory($data);
					break;
				case 'newpassword':
					return Passwordrecovery::sendResetPassword($data);
				default:
					return false;
					break;
			}
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

	public static function passwordDevEnvCorrect($var){
		return !( strlen($var)<2 || strlen($var)>12);
	}

	public static function urlCorrect($var){
		return !( filter_var($var, FILTER_VALIDATE_URL) === FALSE || strlen($var)<2 || strlen($var)>500 );
	}
	public static function dateCorrect($var){
		if(strlen($var) !=10 ){
			return false;
		}else{
			list($d, $m, $y) = explode('/', $var);
			return (checkdate($m, $d, $y));
		}

	}
	public static function selectEntryCorrect($var){
		return !( $var == 0 || $var == 1 );
	}
	public static function emailCorrect($var){
		return ( filter_var($var, FILTER_VALIDATE_EMAIL) );
	}
	public static function simpleEntryCorrect($var){
		return !( strlen($var)<2 || strlen($var)>100 );
	}
	public static function simpleEntryTextCorrect($var){
		return !( strlen($var)<2 || strlen($var)>170 );
	}
	public static function loginCorrect($var){
		return !( 	strlen($var)<8 || strlen($var)>50 );
	}


}
