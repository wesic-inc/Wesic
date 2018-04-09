<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);


class indexController{

	public function indexAction($args){

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
