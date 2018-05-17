<?php

if(!isset($_SESSION)) 
    session_start(); 


class errorController{

	public function indexAction($args){
		
		$v = new View();
		$v->setView("error/error");
		$v->assign('title','Pas non trouvée');
	}
	public function notFoundAction($args){
		
		$v = new View();
		$v->setView("error/error404");
		$v->assign('title',"Erreur !");

	}
	public function forbiddenAction($args){
		
		$v = new View();
		$v->setView("error/error403");
		$v->assign('title','Attention !');

	}
}
