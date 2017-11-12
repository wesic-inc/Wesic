<?php
class adminController{

	public function indexAction($args){
		echo "Admin";
	}

	public function addUserAction($args){

			$user = new users();
			$userFound = $user->getData('user',["id"=>$_SESSION["id"]])[0];

			$form = users::getFormNewUser();
			$errors = [];

			if($_SERVER["REQUEST_METHOD"] == "POST"){

				$errors = validator::check($form["struct"], $args);

				if(!$errors)
					header('Location: manageUsers');
			}


			$v = new view();
			$v->setView("admin/adduser");
			$v->assign("pseudo", $userFound["email"]);
			$v->assign("role",$userFound["role"]);
			$v->assign("page","adduser");
			$v->assign("title", "Modifier un utilisateur");
			$v->assign("form", $form);
			$v->assign("errors", $errors);

	}

}