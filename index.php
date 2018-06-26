<?php

require_once $_SERVER['DOCUMENT_ROOT']."/config/conf.inc.php";

if($debug==true){
	
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

	ini_set('display_errors', TRUE);

	function dump($a,$b = 0,$c = 1){
		Format::dump($a,$b,$c);
	}
	function dd($a,$c = 1){
		Format::dump($a,1,$c);
	}
	function Req(){
		return Singleton::request();
	}

	function setting($key){
		return Singleton::settings()[$key][2];
	}

}else{
	error_reporting(0);
	ini_set('display_errors', 0);
}

function autoloader($class) {
	
	if( file_exists("core/".$class.".class.php")){
		include "core/".$class.".class.php";
	}else if(file_exists("models/".$class.".class.php")){
		include "models/".$class.".class.php";
	}else if(file_exists("repositories/".$class.".class.php")){
		include "repositories/".$class.".class.php";
	}
}

spl_autoload_register('autoloader');






$route = Route::makeRouting();

$name_controller = $route["c"]."Controller";
$path_controller = "controllers/".$name_controller.".class.php";


if( file_exists($path_controller) ){
	

	if(!isset($_SESSION)) 
		session_start();
	
	include $path_controller;
	$controller = new $name_controller;
	
	$permission = Route::getPermissionsDev($route);

	if($permission != 1){

		if($permission == 0 || is_null($permission)){
			Route::redirect('Error404');
		}
		Route::redirect($permission);
	}

	$name_action = $route["a"]."Action";
	if( method_exists($controller, $name_action)){

		$controller->$name_action($route["request"]);

	}else{
		Route::redirect('Error404');
	}

}else{
	Route::redirect('Error404');
}







