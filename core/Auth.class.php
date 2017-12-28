<?php
/**
 * Classe Core des fonctions de login
 */
class Auth extends Basesql {

	
	static function isConnected(){
		if(isset($_SESSION["token"])){
			$user = new User();
			$token = $_SESSION["token"];
			$user = $user->getData('user',["id"=>$_SESSION["id"]]);
			if(!empty($user)){
				$user = $user[0];
				if($token == self::createTokenAction($user) && time() < $_SESSION['time']+36000 ){
					return TRUE;
				}else{
					self::logoutUser();
					return FALSE;
				}
			}
			return FALSE;

		}
		return FALSE;

	}

/**
 * Génération du token utilisateur 
 * @param  array  $user      	Information utilisateur
 * @return string       		Token utilisateur généré
 */
static public function createTokenAction($user=[])
{
	return md5($user["id"].SALT.date("Ymd"));
}
/**
 * Fonction de vérification des rôles de l'utilisateur
 * @param  int  $iduser 		Id utilisateur
 * @return boolean         		True si admin, false si utilisateur standard
 */
static function isAdmin($iduser){

	$user = new User();
	$user = $user->getData('users',["id"=>$iduser]);
	$userFound = $user[0];

	if($userFound["role"] === "1" ){
		return TRUE;
	}else{
		return FALSE;
	}

}
/**
 * Fonction de deconnexion utilisateur
 */
static public function logoutUser(){
		// Détruit toutes les variables de session
	$_SESSION = array();	

	if (ini_get("session.use_cookies")) {

		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);

	}

	session_unset();
	session_destroy();
	header('Location: '.ROOT_URL.'login');
}

/**
 * Fonction de connexion utilisateur
 */
static public function signIn($data){

	

	$user = new User();

	$users = $user->getData('user',["login"=>$data['login'],"status"=>'1']);

	if(!empty($users)){

		$user = $users[0];

		if(password_verify($data['password'],$user['password']) ){
			
			$_SESSION['token'] = self::createTokenAction($user);
			$_SESSION['id'] = $user['id'];
			$_SESSION['time'] = time();

			return true;

		}
		self::logoutUser();
		return false;
	}
	self::logoutUser();
	return false;
}

public static function emailExists($email){

	$user = new User();
	$users = $user->getData("user",['email' => $email]);

	return !empty($users);

}

public static function loginExists($login){

	$user = new User();

	$users = $user->getData('user',["login"=>$login]);

	return !empty($users);

}

}