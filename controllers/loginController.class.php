<?php

if(!isset($_SESSION)) 
	session_start();

class loginController{

	public function indexAction($args){

		/*setcookie("navbar", 1,time() + (10 * 365 * 24 * 60 * 60), "/"); */

		$user = new User();
		$form = $user->getFormLogin();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'signin')?$errors=["login404"]:header("Location: /");
			}
		}


		$v = new View();
		$v->setView("login/login");
		$v->assign("title", "Connexion");
		$v->assign("description", "Connexion");
		$v->assign("form", $form);
		$v->assign("errors", $errors);
	}
	public function logoutAction($args){
		Auth::logoutUser();
	}

	public function signupAction($args){

		$form = User::getFormNewUser();

		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'signup')?$errors=["userexists"]:header("Location: login");
				
			}
		}

		$v = new View();
		$v->setView("login/signup");
		$v->assign("title", "Inscription");
		$v->assign("description", "Inscription");
		$v->assign("form", $form);
		$v->assign("errors", $errors); 
	}
}
