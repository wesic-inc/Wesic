<?php

class Auth extends Basesql {

	
	static function isConnected(){


		if(isset($_SESSION["token"])){
			$user = new User();
			$token = $_SESSION["token"];
			$user = $user->getData('user',["token"=>$token]);
			if(empty($user)){
				return FALSE;
			}else{
				$user = $user[0];
				if($token = $user['token']){
					self::tokenRenew($user);
					return TRUE;
				}
				return FALSE;
			}
		}
		return FALSE;

	}

	static function isAdmin(){
		if(!isset($_SESSION["token"])){
			return FALSE;
		}else{
			$token = $_SESSION["token"];

			$user = new User();
			$user = $user->getData('users',["token"=>$token]);
			if(!empty($user[0])){
				$userFound = $user[0];
				if($userFound["role"] === "1" ){
					return TRUE;
				}else{
					return FALSE;
				}
			}



		}
	}

	static public function logoutUser(){

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

	static public function signIn($data){



		$user = new User();

		$users = $user->getData('user',["login"=>$data['login'],"status"=>'1']);

		if(!empty($users)){

			$userFound = $users[0];

			if(password_verify($data['password'],$userFound['password']) ){

				self::tokenRenew($userFound);

				return true;

			}
			self::logoutUser();
			return false;
		}
		self::logoutUser();
		return false;
	}

	public static function tokenRenew($userFound){

		$user = new User();

		$user->setId($userFound['id']);
		$user->setEmail($userFound['email']);
		$user->setStatus($userFound['status']);
		$user->setToken();
		$user->save();

		$_SESSION['token'] = $user->getToken();
	}


}