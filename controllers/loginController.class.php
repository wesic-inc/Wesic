<?php

if(!isset($_SESSION)) 
	session_start();

class loginController{

	public function indexAction($args){

			setcookie("navbar", 1,time() + (10 * 365 * 24 * 60 * 60), "/"); 
			$user = new users();


			$form = $user->getFormLogin();
			$errors = [];

			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$errors = validator::check($form["struct"], $args);

				if(!$errors){
					header('Location: index');
				}
			}

			$v = new view();
			$v->setView("login/login");
			$v->assign("title", "Connexion");
			$v->assign("description", "Connexion");
			$v->assign("form", $form);
			$v->assign("errors", $errors);
		


	}
	public function logoutAction($args){
		login::logoutUser();
	}
}
