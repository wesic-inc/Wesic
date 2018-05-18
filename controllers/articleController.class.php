<?php

class articleController{
	public static function indexAction($args){

	}

	public static function singleAction($args){

		$qb = new QueryBuilder();
		$article = 
		$qb->findAll('post')
		->addWhere('slug = :slug')
		->setParameter('slug',$args['slug'])
		->fetchOne();

		$v = new View();
		$v->setView("article/single");
		$v->assign("article", $article);
	}

	public function allArticlesAction($args){
		
		$v = new View();
		$v->setView("cms/articles","templateadmin");
		$v->assign("title", "Articles");
		$v->assign("icon", "icon-newspaper");

	}
	public function newArticleAction($args){


		$form = Post::getFormNewArticle();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'articlenew')?$errors=["articlenew"]:header("Location: /");
			}
		}
		$v = new View();
		$v->setView("cms/newarticle","templateadmin");
		$v->assign("pseudo", $userFound['firstname']." ".$userFound['lastname']);
		$v->assign("form", $form);
		$v->assign("title", "Nouvel article");
		$v->assign("icon", "icon-pen");
		$v->assign("errors", $errors);
	}
}