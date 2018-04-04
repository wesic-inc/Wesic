<?php

if(!isset($_SESSION)) 
	session_start();

class loginController{

	public function indexAction($args){

		$user = new User();
		$form = $user->getFormLogin();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$errors = Validator::check($form["struct"], $args['post']);

			if(empty($errors)){
				!Validator::process($form["struct"], $args['post'], 'signin')?$errors=["login404"]:header("Location: /");
			}
		}


		$v = new View();
		$v->setView("login/login");
		$v->assign("title", "Connexion");
		$v->assign("description", "Connexion");
		$v->assign("config", $form);
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
		$v->assign("config", $form);
		$v->assign("errors", $errors); 
	}
}
