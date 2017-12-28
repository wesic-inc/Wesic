<?php

if(!isset($_SESSION)) 
    session_start(); 


class errorController{

	public function indexAction($args){
		
		$v = new View();
		$v->setView("error/error");
	}
	public function notFoundAction($args){
		
		$v = new View();
		$v->setView("error/error404");
	}
	public function forbiddenAction($args){
		
		$v = new View();
		$v->setView("error/error403");
	}
}
