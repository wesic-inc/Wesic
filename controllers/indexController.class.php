<?php



class indexController{

	public function indexAction($args){

		$article = new Post();
		$articlesFound = $article->getData('post');

		$v = new View();

		$v->setView("index/index")->assign("articles", $articlesFound);

		Stat::add(1,"page d'accueuil",3);
	}

	public function testAction($args){
		echo "Bonjour2";
	}

}
