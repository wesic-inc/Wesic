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
		if(Singleton::$_instanceUser == null && isset($_SESSION['token'])){
			
			$_instanceUser = new User();

			$qb = new QueryBuilder();

			$result = 
			$qb->findAll('user')
			->addWhere('token = :token')
			->setParameter('token',$_SESSION['token'])
			->fetchOne();
			
				$_instanceUser->setId($result['id']);
				$_instanceUser->setLogin($result['login']);
				$_instanceUser->setFirstname($result['firstname']);
				$_instanceUser->setLastname($result['lastname']);
				$_instanceUser->setRole($result['role']);
				$_instanceUser->setEmail($result['email']);
				$_instanceUser->setStatus($result['status']);
				$_instanceUser->setToken($result['token']);
		}
		/*$_instanceUser->setToken();
			$_instanceUser->save();*/
		return $_instanceUser;
	}
}