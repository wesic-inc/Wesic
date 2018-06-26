<?php

class Singleton
{
	private static $_instanceDB = null;
	private static $_instanceUser = null;
    private static $_request = null;
    private static $_settings = null;

	public static function getDB()
	{
		if (Singleton::$_instanceDB == null) {
			$dsn = 'mysql:host='.DBHOST.';dbname='.DBNAME.';charset=utf8';
			try {
				Singleton::$_instanceDB = new PDO($dsn, DBUSER, DBPWD);
			} catch (Exception $e) {
				die("Erreur lors de la conneion à la base de données : ".$e->getMessage());
			}
		}

		return Singleton::$_instanceDB;
	}

	public static function getUser()
	{
		if (Singleton::$_instanceUser == null && isset($_SESSION['token'])) {
			$_instanceUser = new User();

			$qb = new QueryBuilder();

			$result =
			$qb->findAll('user')->where('token', $_SESSION['token'])->fetchOrFail();
			
			$_instanceUser->setId($result['id']);
			$_instanceUser->setLogin($result['login']);
			$_instanceUser->setFirstname($result['firstname']);
			$_instanceUser->setLastname($result['lastname']);
			$_instanceUser->setRole($result['role']);
			$_instanceUser->setEmail($result['email']);
			$_instanceUser->setStatus($result['status']);
			$_instanceUser->setToken($result['token']);
		
		}
		if(isset($_SESSION['token'])){
			return $_instanceUser;
		}
		return null;   
    }


    public static function request()
    {
    	if(Singleton::$_request == null){

    		$params = Route::checkParameters(array_values(Route::getUri()[1]));
	        $routeInfo = Route::getRouteInfo(Route::getRoute());

			Singleton::$_request = new Request($_REQUEST,$_POST,$_GET,$params,$routeInfo);

    	}
    	return Singleton::$_request;
    }    

    public static function settings()
    {
    	if(Singleton::$_settings == null){

			Singleton::$_settings = Setting::getSettings();

    	}
    	return Singleton::$_settings;
    }
}
