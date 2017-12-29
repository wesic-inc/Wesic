<?php

if(!isset($_SESSION)) 
	session_start();

class indexController{

	public function indexAction($args){
		
		$user = new User();

		if(Auth::isConnected()){
			$userFound = $user->getData('user',['id'=>$_SESSION['id']])[0];
		}

		$article = new Article();
		$articlesFound = $article->getData('article');

		$v = new View();

		$v->setView("index/index");
		$v->assign("articles", $articlesFound);
		$v->assign("pseudo", $userFound['firstname']." ".$userFound['lastname']);



	}

	public function testAction($args){
		echo "Bonjour2";
	}

}
