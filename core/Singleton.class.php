<?php

class Singleton {

	private static $_instance = null;

	function _construct(){
		//...
	}

	public static function getInstance(){
		if(Singleton::$_instance == null){
			$dsn = 'mysql:host='.DBHOST.';dbname='.DBNAME.';charset=utf8';
			try{
				Singleton::$_instance = new PDO($dsn,DBUSER,DBPWD);
			}catch(Exception $e){
				die("Erreur lors de la conneion à la base de données : ".$e->getMessage());
			}
		}

		return Singleton::$_instance;
	}
}