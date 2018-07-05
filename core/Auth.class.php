<?php
// Classe du core permettant la gestion de l'authentification
class Auth extends Basesql {
	/**
	 * [isConnected description]
	 * @return boolean [description]
	 */
	static function isConnected(){

		if(isset($_SESSION["token"])){
			$qb = new QueryBuilder();
			$user = $qb->all('user')->where("token",$_SESSION["token"])->fetchOrFail();
			if(empty($user)){
				return FALSE;
			}else{

				if($token = $user['token']){
					self::tokenRenew($user);
					return TRUE;
				}
				return FALSE;
			}
		}
		return FALSE;

	}
	/**
	 * [isAdmin description]
	 * @return boolean [description]
	 */
	static function isAdmin(){

		if(!isset($_SESSION["token"])){
			return FALSE;
		}else{
			$token = $_SESSION["token"];
			$user = new User();
			$user = $user->getData('user',["token"=>$token]);

			if(!empty($user[0])){
				$userFound = $user[0];
				if($userFound["role"] === "4" ){
					return TRUE;
				}else{
					return FALSE;
				}
			}

		}
	}
	/**
	 * [getRights description]
	 * @return [type] [description]
	 */
	static function getRights(){
		if(!isset($_SESSION["token"])){
			return false;
		}else{
			$token = $_SESSION["token"];
			$user = new User();
			$user = $user->getData('user',["token"=>$token]);


			if(!empty($user[0])){
				$userFound = $user[0];
				return $userFound["role"];
			}else{
				return false;
			}
		}
	}
	/**
	 * [logoutUser description]
	 * @return [type] [description]
	 */
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
	}
	/**
	 * [signIn description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	static public function signIn($data){

		$user = new User();

		$users = $user->getData('user',["login"=>$data['login'],"status"=>'1']);

		$qb = new QueryBuilder();

		$user = $qb
		->select('*')
		->from('user')
		->addWhere('login = :login')
		->setParameter('login',$data['login'])
		->and()
		->addWhere('status = :status')
		->setParameter('status',1)
		->and()
		->addWhere('role != :role')
		->setParameter('role',5)
		->fetchOne();



		if(!empty($user)){

			if(password_verify($data['password'],$user['password']) ){
				self::tokenRenew($user);
				return true;
			}
			self::logoutUser();
			return false;
		}
		self::logoutUser();
		return false;
	}
	/**
	 * [tokenRenew description]
	 * @param  [type] $userFound [description]
	 * @return [type]            [description]
	 */
	public static function tokenRenew($userFound){

		$user = new User();

		$user->setId($userFound['id']);
		$user->setEmail($userFound['email']);
		$user->setStatus($userFound['status']);
		$user->setToken();
		$user->save();

		$_SESSION['token'] = $user->getToken();
	}
	/**
	 * [user description]
	 * @return [type] [description]
	 */
	public static function user(){
		return Singleton::getUser();
	}	
	/**
	 * [id description]
	 * @return [type] [description]
	 */
	public static function id(){
		if(!is_null(Singleton::getUser())){
		return Singleton::getUser()->getId();
		}
		return 0;
	}
	/**
	 * [role description]
	 * @return [type] [description]
	 */
	public static function role(){
		return Singleton::getUser()->getRole();
	}

}