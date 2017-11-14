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

		/**
	 * Vérification de la corespondance Login/Mdp en BDD
	 * @param  string $login    Login entré par l'utilisateur
	 * @param  string $password Mot de passe rentré par l'utilisateur
	 * @return boolean          False si échec, true si succès
	 */
	static function loginMatch($login,$password){
			return (basesql::verifyLogin($login,$password));
		}

	/**
	 * Fonction de vérification si l'email existe déjà en base
	 * @param  string $email  	Email à vérifier
	 * @param  int $iduser 		ID de l'utilisateur si modification d'utilsateur
	 * @return boolean       	False si email existant, true si email valide
	 */
	public static function emailExisting($email,$iduser){
		return ( basesql::verifyEmail($email,$iduser) );
	}

	public static function loginExisting($login,$iduser){
		return ( basesql::verifyIdLogin($login,$iduser) );
	}
	
}









