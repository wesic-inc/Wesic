<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);


class indexController{

	public function indexAction($args){

		$article = new Post();
		$articlesFound = $article->getData('post');

		$v = new View();

		$v->setView("index/index");
		$v->assign("articles", $articlesFound);



	}

	public function testAction($args){
		echo "Bonjour2";
	}

}
