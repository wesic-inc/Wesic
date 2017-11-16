<?php

require_once $_SERVER['DOCUMENT_ROOT']."/config/conf.inc.php";

function autoloader($class) {
	//Vérifier s'il existe dans le dossier
	//core un fichier du nom de $class.class.php
	//Si oui alors include
	if( file_exists("core/".$class.".class.php")){
		include "core/".$class.".class.php";
	}else if(file_exists("models/".$class.".class.php")){
		include "models/".$class.".class.php";
	}
}

spl_autoload_register('autoloader');

$route = routing::setRouting();
$name_controller = $route["c"]."Controller";
$path_controller = "controllers/".$name_controller.".class.php";

if( file_exists($path_controller) ){
	

	if(!isset($_SESSION)) 
	session_start();
	
	
	include $path_controller;
	$controller = new $name_controller;
	
	if(!routing::getPermissions($route)){
		header('location: '.routing::getRoot().'error/forbidden');
	}

	$name_action = $route["a"]."Action";
	if( method_exists($controller, $name_action)){

		$controller->$name_action($route["args"]);

	}else{
		header('location: '.routing::getRoot().'error/notFound'); 
		
	}

}else{
	header('location: '.routing::getRoot().'error/notFound');
}







