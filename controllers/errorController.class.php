<?php

if(!isset($_SESSION)) 
    session_start(); 


class errorController{

	public function indexAction(){
		
		$v = new View();
		$v->setView("error/error")->assign('title','Pas non trouvée');
	}
	public function notFoundAction(){
		
		$v = new View();
		$v->setView("error/error404")->assign('title',"Erreur !");

	}
	public function forbiddenAction(){
		
		$v = new View();
		$v->setView("error/error403")->assign('title','Attention !');

	}
}
