<?php
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

		return ["c" => $c, "a" => $a, "args" => $args];

	}

/**
 * Recupère la racine du site selon l'URI 
 * @return string 			Racine du site
 */
	public static function getRoot(){

			
			
			$uri = $_SERVER['REQUEST_URI'];
			$route = self::setRouting();

			if( (isset($route["a"]) && $route["a"] != "index") || ($route["c"] != "index" && substr($uri, -1) == "/") ){
				return "../";
			}
			return "";
	}

}