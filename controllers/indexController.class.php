<?php

if(!isset($_SESSION)) 
	session_start();

class indexController{

	public function indexAction($args){
		
		$v = new view();
		$v->setView("index/index");
		$v->assign("pseudo", "User");
	}

	public function testAction($args){
		echo "Bonjour2";
	}

}
