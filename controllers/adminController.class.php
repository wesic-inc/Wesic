<?php
class adminController{

	public function indexAction(Request $request){
		
		$v = new View();
		$v->setView("admin/index","templateadmin");
		$v->massAssign([
			"page" =>"adduser",
			"title" => "Dashboard",
			"icon" => "icon-home",
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