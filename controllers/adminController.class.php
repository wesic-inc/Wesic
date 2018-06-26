<?php
class adminController{

	public function indexAction(Request $request){
		
		$qb = new QueryBuilder();

		$articles = $qb->count('post')->where('type',1)->getCol();
		$pages = $qb->count('post')->where('type',2)->getCol();
		$comments = $qb->count('comment')->getCol();
		$events = $qb->count('event')->getCol();

		$v = new View();
		$v->setView("admin/index","templateadmin");
		$v->massAssign([
			"page" =>"adduser",
			"title" => "Dashboard",
			"icon" => "icon-home",
			"articles" => $articles,
			"pages" => $pages,
			"comments" => $comments,
			"events" => $events,
		]);
	}

	public function addUserAction(Request $request){

		$post = $request->getPost();

		$form = User::getFormNewUser();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$errors = Validator::check($form["struct"], $post);

			if(!$errors)
				header('Location: manageUsers');
		}


		$v = new View();
		$v->setView("admin/adduser","templateadmin");
		$v->massAssign([
			"page" =>"adduser",
			"title" => "Ajouter un utilisateur",
			"form" => $form,
			"errors" => $errors
		]);

	}


	public function devTestAction($args){
		echo "lol";
		die();
		$v = new View();
		$v->setView('dev/template','templateadmin');
	}




}