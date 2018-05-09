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

	public function allArticlesAction($args){
		
		$v = new View();
		$v->setView("cms/articles","templateadmin");
		$v->assign("pseudo", $userFound['firstname']." ".$userFound['lastname']);
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