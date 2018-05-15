<?php
class adminController{

	public function indexAction($args){

		$user = new User();
		if(Auth::isConnected()){
			$userFound = $user->getData('user',['id'=>$_SESSION['id']])[0];
		}
		
		$v = new View();
		$v->setView("admin/index","templateadmin");
		$v->assign("pseudo", $userFound['firstname']." ".$userFound['lastname']);
		$v->assign("role",$userFound["role"]);
		$v->assign("page","adduser");
		$v->assign("title", "Administration");
		$v->assign("icon", "icon-home");
		$v->assign("form", $form);
		$v->assign("errors", $errors);
	}

	public function addUserAction($args){

			$user = new User();
			$userFound = $user->getData('user',["id"=>$_SESSION["id"]])[0];

			$form = User::getFormNewUser();
			$errors = [];

			if($_SERVER["REQUEST_METHOD"] == "POST"){

				$errors = Validator::check($form["struct"], $args['post']);

				if(!$errors)
					header('Location: manageUsers');
			}


			$v = new View();
			$v->setView("admin/adduser","templateadmin");
			$v->assign("pseudo", $userFound["email"]);
			$v->assign("role",$userFound["role"]);
			$v->assign("page","adduser");
			$v->assign("title", "Ajouter un utilisateur");
			$v->assign("form", $form);
			$v->assign("errors", $errors);

	}



	public function newCategoryAction($args){
		
		$form = Category::getFormNewCategory();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'categorynew')?$errors=["categorynew"]:Route::redirect('Admin');
			}
		}
		$v = new View();
		$v->setView("cms/newcategory","templateadmin");
		$v->assign("pseudo", $userFound['firstname']." ".$userFound['lastname']);
		$v->assign("form", $form);
		$v->assign("errors", $errors);

	}




}