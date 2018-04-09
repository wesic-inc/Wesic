<?php

class Singleton {

	private static $_instanceDB = null;
	private static $_instanceUser = null;

	public static function getDB(){
		if(Singleton::$_instanceDB == null){
			$dsn = 'mysql:host='.DBHOST.';dbname='.DBNAME.';charset=utf8';
			try{
				Singleton::$_instanceDB = new PDO($dsn,DBUSER,DBPWD);
			}catch(Exception $e){
				die("Erreur lors de la conneion à la base de données : ".$e->getMessage());
			}
		}

		return Singleton::$_instanceDB;
	}

	public static function getUser(){
		if(Singleton::$_instanceUser == null){
			$_instanceUser = new User();
			/*$_instanceUser = $user->getData('user',['id'=>$_SESSION['id']])[0];*/

		}
		/*$_instanceUser->setToken();
			$_instanceUser->save();*/
		return Singleton::$_instanceUser;
	}
}