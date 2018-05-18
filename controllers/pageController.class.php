<?php
class pageController{
		public static function indexAction($args){
			echo "pages";
		}

public static function singleAction($args){

		$qb = new QueryBuilder();
		$article = 
		$qb->findAll('post')
		->addWhere('slug = :slug')
		->setParameter('slug',$args['slug'])
		->fetchOne();

		$v = new View();
		$v->setView("article/page");
		$v->assign("page", $page);

	}

			public function allPagesAction($args){
		
		$v = new View();
		$v->setView("cms/pages","templateadmin");
		$v->assign("title", "Pages");
		$v->assign("icon", "icon-files-empty");

	}
	public function newPageAction($args){


		$form = Post::getFormNewPage();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'pagenew')?$errors=["pagenew"]:header("Location: /");
			}
		}
		$v = new View();
		$v->setView("cms/newarticle","templateadmin");
		$v->assign("form", $form);
		$v->assign("title", "Nouvelle page");
		$v->assign("icon", "icon-file-text2");
		$v->assign("errors", $errors);
	}
}	