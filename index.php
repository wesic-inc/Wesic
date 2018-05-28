<?php


// DEV ENV ONLY !!!!


error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
ini_set('display_errors', TRUE);



function dump($a,$b = 0,$c = 1){
	Format::dump($a,$b,$c);
}



// DEV ENV ONLY !!!!


require_once $_SERVER['DOCUMENT_ROOT']."/config/conf.inc.php";

function autoloader($class) {
	
	if( file_exists("core/".$class.".class.php")){
		include "core/".$class.".class.php";
	}else if(file_exists("models/".$class.".class.php")){
		include "models/".$class.".class.php";
	}
}

spl_autoload_register('autoloader');

// START TEST AREA

/*stat::fakeStats(30000);
die();
*/
// END TEST AREA




$route = Route::makeRouting();


$name_controller = $route["c"]."Controller";
$path_controller = "controllers/".$name_controller.".class.php";


if( file_exists($path_controller) ){
	

	if(!isset($_SESSION)) 
	session_start();
	
	include $path_controller;
	$controller = new $name_controller;
	
	$permission = Route::getPermissionsDev($route);

	// dump($permission,2,2);

	if($permission != 1){

		if($permission == 0 || is_null($permission)){
			Route::redirect('Error404');
		}
		Route::redirect($permission);
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







