<?php

class indexController{
/**
 * [indexAction description]
 * @param  [type] $args [description]
 * @return [type]       [description]
 */
	public function indexAction($args){

		// $article = new Post();
		// $articlesFound = $article->getData('post');

		$v = new View();

		$v->setView("home","template","front");
		// ->assign("articles", $articlesFound);

		Stat::add(1,"page d'accueuil",3);
	}
/**
 * [indexAction description]
 * @param  [type] $args [description]
 * @return [type]       [description]
 */
	public function testAction($args){
		echo "Bonjour2";
	}

}
