<?php

if(!isset($_SESSION)) 
	session_start(); 

class routing{


public static function getRoot(){	
	return getenv('HTTP_HOST')."/";
}

public static function getPermissions( $route ){

	$connected = Auth::isConnected();
	$rights = Auth::isAdmin();

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

public static function getPermissionsDev( $route ){
	$connected = Auth::isConnected();
	$rights = Auth::isAdmin();
	
	switch ($route['r']) {
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
		return false;
		break;
	}
	return false;
}

public static function makeRouting(){

	global $rof;

	$uri = $_SERVER['REQUEST_URI'];
	$explode_uri = explode("?", $uri);
	$uri = explode('/',$explode_uri[0]);
	$params = $uri;
	$uri = $uri[0].'/'.$uri[1].'/'.$uri[2];
	
	$uri = trim( str_replace(PATH_ROOT, "", $uri) , "/");
	unset($params[0]);
	unset($params[1]);
	unset($params[2]);

	foreach($rof['routing'] as $rules) {

		if($uri == $rules['path']){

			$c = explode(":",$rules['controller'])[0];
			$a = explode(":",$rules['controller'])[1];
			$r = $rules['restricted'];
			$args = [
				'request'=>$_REQUEST,
				'post'=>$_POST,
				'get'=>$_GET,
				'params'=> array_values($params)
			];

		}
	}

		$currentUser = Singleton::getUser();

	if($c == NULL && $a == NULL){

		$slug = new Slug();
		$slugFound = $slug->getData('slug',['slug'=>$uri]);

		if(empty($slugFound)){
			$c = 'error';
			$a = 'notFound'; 
		}else{
			switch ($slugFound['type']) {
				case 1:
					$c = 'category';
					$a = 'archive';
					break;
				case 2:
					$c = 'page';
					$a = 'single';
					break;
				case 3:
					$c = 'article';
					$a = 'single';
					break;
				default:
					$c = 'error';
					$a = 'notFound';
					break;
			}
			$r = 'all';
		}
	}

	return ['a' => $a, 'c' => $c, 'r' => $r, 'args' => $args ];
}
}