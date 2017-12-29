<?php

class cmsController{

	public function indexAction($args){
		echo "<h1> Bienvenu dans mon cms </h1>";
	}

	public function newArticleAction($args){


		$form = Article::getFormNewArticle();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'articlenew')?$errors=["articlenew"]:header("Location: /");
			}
		}
		$v = new View();
		$v->setView("cms/newarticle");
		$v->assign("pseudo", $userFound['firstname']." ".$userFound['lastname']);
		$v->assign("form", $form);
		$v->assign("errors", $errors);
	}

	public function newCategoryAction($args){
		
		$form = Category::getFormNewCategory();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'categorynew')?$errors=["categorynew"]:header("Location: /");
			}
		}
		$v = new View();
		$v->setView("cms/newcategory");
		$v->assign("pseudo", $userFound['firstname']." ".$userFound['lastname']);
		$v->assign("form", $form);
		$v->assign("errors", $errors);

	}
}