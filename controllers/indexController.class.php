<?php

if(!isset($_SESSION)) 
	session_start();

class indexController{

	public function indexAction($args){
		
		$user = new User();
		if(login::isConnected()){
			$userFound = $user->getData('user',['id'=>$_SESSION['id']])[0];
		}

		$v = new View();
		$v->setView("index/index");
		$v->assign("pseudo", $userFound['firstname']);



	}

	public function testAction($args){
		echo "Bonjour2";
	}

}
