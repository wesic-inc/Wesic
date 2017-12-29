<?php

class articleController{
	public static function indexAction($args){

	}

	public static function singleAction($args){


		$article = new Article();
		$articleFound = $article->getData('article',['slug'=>$args['slug']]);

		$v = new View();

		$v->setView("article/single");
		$v->assign("article", $articleFound[0]);
		$v->assign("pseudo", $userFound['firstname']." ".$userFound['lastname']);
	}
}