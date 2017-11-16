<?php

if(!isset($_SESSION)) 
	session_start(); 

class routing{


	public static function setRouting(){
		
		$uri = $_SERVER['REQUEST_URI'];
		$explode_uri = explode("?", $uri);
		$uri = $explode_uri[0];

		$uri = trim( str_replace(PATH_ROOT, "", $uri) , "/");

		$explode_uri = explode("/", $uri);
		
		$c = (!empty($explode_uri[0]))?$explode_uri[0]:"index";
		$a = (!empty($explode_uri[1]))?$explode_uri[1]:"index";
		unset($explode_uri[0]);
		unset($explode_uri[1]);
		$args = array_merge($explode_uri, $_REQUEST);
		
		$allowed = self::getPermissions(["c" => $c, "a" => $a, "args" => $args]);

		return ["c" => $c, "a" => $a, "args" => $args];

	}

/**
 * Recupère la racine du site selon l'URI 
 * @return string 			Racine du site
 */
public static function getRoot(){

	
	return getenv('HTTP_HOST')."/";
}

public static function getPermissions( $route ){
	$connected = login::isConnected();
	$rights = login::isAdmin($_SESSION["id"]);

	global $route_access;

	if($route['c'] !== "" && $route['a'] === ""){
		$route['a'] = "index";
	}

	$matched_route = in_array($route['c'].'/'.$route['a'],array_keys($route_access));

	switch ($route_access[$route['c'].'/'.$route['a']]) {
		case 'admin':
		if(	$connected == true && $rights == true )
			return true;
		case 'user':
		if($connected == true)
			return true;
		break;
		case 'all':
		return true;
		break;
		default:
		return true;
		break;
	}
	return false;	
}


public static function makeRouting(){

		global $rof;

		$uri = $_SERVER['REQUEST_URI'];
		$explode_uri = explode("?", $uri);
		$uri = $explode_uri[0];

		$uri = trim( str_replace(PATH_ROOT, "", $uri) , "/");

		print_r(in_array($uri,$rof['routing_dev']));


		foreach($rof['routing_dev'] as $rules) {
			if($uri == $rules['path']){
				$c = explode(":",$rules['controller'])[0];
				$a = explode(":",$rules['controller'])[1];
				
			}
		}

	return ['a' => $a, 'c' => $c, 'args' => $_REQUEST ];
	}
}