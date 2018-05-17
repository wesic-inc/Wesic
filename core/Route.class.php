<?php

if(!isset($_SESSION)) 
	session_start(); 

class Route{


	public static function getRoot(){	
		return getenv('HTTP_HOST')."/";
	}

	public static function get($route){

		global $route_access;
		if(!empty($route_access[$route]['path'])){
			return $route_access[$route]['path'];
		}else{
			return $route_access[$route]['error404']; 
		}

	}

	public static function getAll($route){

		global $route_access;
		if(!empty($route_access[$route]['path'])){
			return ROOT_URL.$route_access[$route]['path'];
		}else{
			return $route_access[$route]['error404']; 
		}
	}

	public static function assets($uri){
		echo ROOT_URL.'public/'.$object;
	}

	public static function echo($route){
			echo self::getAll($route);
	}

	public static function redirect($route,$parameter = ""){
		$redirect = 'location: '.self::getAll($route);
		if(!empty($parameter)){
			$redirect .= "/".$parameter;
		}
		header($redirect);

	}

	public static function getRouteInfo($route){

		global $route_access;
		return [$route_access[$route]][0];		

	}



	public static function checkParameters($args){

		$routeInfo = self::getRouteInfo(self::getRoute());

		$getParams = [];
		$validParams = [];

		if(count($args)%2 != 0){
			return false;
		}

		if(isset($routeInfo['params'])){

			for($i = 0,$j = 1; $i < count($args); $i = $i+2,$j = $j + 2){
				if(isset($getParams[$args[$i]])){
					return false;
				}
				$getParams[$args[$i]] = $args[$j];
			}


			$expectedParams = $routeInfo['params'];

			foreach ($expectedParams as $key => $params) {

				if(isset($getParams[$key]) && !empty($getParams[$key]) && $params['optional'] == false){
					
					$typeFlag = self::validateParameterType($params['type'],$getParams[$key]);
					$optionalFlag = true;
					
				}
				else if((!isset($getParams[$key]) && $params['optional'] == true ) || ( !empty($getParams[$key]) && $params['optional'] == true )){
						$optionalFlag = true;
						$typeFlag = true;

				}
				else{
						return false;
				}

				if($optionalFlag == true && $typeFlag == true){
					$validParams[$key] = true;
				}
			}
			foreach ($getParams as $key => $value) {
				if(!isset($expectedParams[$key])){
					return false;
				}
			}
			foreach ($validParams as $value) {
				if($value == false){
					return false;
				}
			}
			return $getParams;
		}
		else{
			return false;
		}
	}

	public static function validateParameterType($type,$parameter){

		switch ($type) {
			case 'int':
			(filter_var($parameter, FILTER_VALIDATE_INT) == 'false'?$parameterFlag=false:$parameterFlag=true);
			break;
			case 'string':
			(filter_var($parameter, FILTER_VALIDATE_STRING) == 'false'?$parameterFlag=false:$parameterFlag=true);
			break;
			default:
			$parameterFlag = false;
			break;
		}

		return $parameterFlag;

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
		$rights = Auth::getRights();


		switch ($route['r']) {
			case 'admin':
			if(	$connected == true && $rights == 4)
				return true;
			case 'moderator':
			if($connected == true && $rights == 3 || $connected == true && $rights == 4)
				return true;
			break;
			case 'webmaster':
			if($connected == true && $rights == 2 || $connected == true && $rights == 3 || $connected == true && $rights == 4)
				return true;
			break;
			case 'user':
			if($connected == true && $rights == 1 || $connected == true && $rights == 2 || $connected == true && $rights == 3 || $connected == true && $rights == 4)
				return true;
			break;
			case 'connected':
			if($connected != true)
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

	public static function getUri(){

		$uri = $_SERVER['REQUEST_URI'];
		$explode_uri = explode("?", $uri);
		$uri = explode('/',$explode_uri[0]);
		$params = $uri;
		$uri = $uri[0].'/'.$uri[1].'/'.$uri[2];
		$uri = trim( str_replace(PATH_ROOT, "", $uri) , "/");
		unset($params[0]);
		unset($params[1]);
		unset($params[2]);

		foreach ($params as $key => $value) {
			if(empty($value)){
				unset($params[$key]);
			}
		}

		return [$uri,$params];
	}

	public static function getRoute(){

		global $route_access;

		$uri = self::getUri()[0];

		foreach ($route_access as $key=>$rules){
			if($uri == $rules['path']){
				return $key;
			}
		}

		self::getUri()[0];
	}

	public static function makeRouting(){

		global $rof;
		global $a;
		global $c;

		$uri = self::getUri()[0];
		$params = self::getUri()[1];

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
			$slugFound = $slug->getData('slug',['slug'=>$uri])[0];

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
					case 4:
					$c = 'user';
					$a = 'newPasswordConfirmation';
					$args['token'] = $slugFound['slug']; 
					$args['post'] = $_POST;
					break;
					case 5:
					$c = 'user';
					$a = 'newAccountConfirmation';
					$args['token'] = $slugFound['slug'];
					break;
					case 6:
					$c = 'user';
					$a = 'newsletterConfirmation';
					$args['token'] = $slugFound['slug'];
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