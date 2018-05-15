<?php
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
ini_set('display_errors', TRUE);

require_once $_SERVER['DOCUMENT_ROOT']."/config/conf.inc.php";

function autoloader($class) {
	
	if( file_exists("core/".$class.".class.php")){
		include "core/".$class.".class.php";
	}else if(file_exists("models/".$class.".class.php")){
		include "models/".$class.".class.php";
	}
}

spl_autoload_register('autoloader');

$route = Route::makeRouting();

$name_controller = $route["c"]."Controller";
$path_controller = "controllers/".$name_controller.".class.php";


function dump($a,$b = 0,$c = 1){
	Format::dump($a,$b,$c);
}

if( file_exists($path_controller) ){
	

	if(!isset($_SESSION)) 
	session_start();
	
	include $path_controller;
	$controller = new $name_controller;
	
	if(!Route::getPermissionsDev($route)){
		Route::redirect('Error404');
	}

	$name_action = $route["a"]."Action";
	if( method_exists($controller, $name_action)){

		$controller->$name_action($route["args"]);

	}else{
		Route::redirect('Error404');
	}

}else{
		Route::redirect('Error404');
}







