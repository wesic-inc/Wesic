<?php

if(!isset($_SESSION)) 
	session_start();

class loginController{

	public function indexAction(Request $request){

		$param = $request->getParams();
		$post = $request->getPost();

		$user = new User();
		$form = $user->getFormLogin();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$errors = Validator::check($form["struct"], $post);

			if(empty($errors)){

				if(!Validator::process($form["struct"], $post, 'signin')){
					$errors = ["login404"];
				}else{
					Route::redirect('Admin');
				}

			}
		}

		$v = new View();
		$v->setView("login/login","templateadmin-modal");
		$v->massAssign([
			"title" => "Connexion",
			"description" => "Connexion",
			"config" => $form,
			"errors" => $errors
		]);
		

	}
	public function logoutAction(){
		Auth::logoutUser();
		Route::redirect('Login');
	}

	public function signupAction(Request $request){

		$param = $request->getParams();
		$post = $request->getPost();

		if( Setting::getParam('signup') == '0'){
			Route::redirect('Error404');
		}

		$form = User::getFormNewUser();

		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $post);

			if(!$errors){
				if(!Validator::process($form["struct"], $post, 'signup')){
					$errors=["userexists"];
				}else{
					Route::redirect('Login');
				}
			}
		}

		$v = new View();
		$v->setView("login/signup");
		$v->massAssign([
			"title" => "Inscription",
			"description" => "Inscription",
			"config" => $form,
			"errors" => $errors
		]);
	}

	public static function getNewPasswordAction(Request $request){
		
		$post = $request->getPost();

		$recovery = new Passwordrecovery();
		$form = $recovery->getFormNewPassword();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$errors = Validator::check($form["struct"], $post);

			if(empty($errors)){
				if(!Validator::process($form["struct"], $post, 'newpassword')){
					$errors=["login404"];
				}else{
					Route::redirect('Login');
				}
			}
		}

		$v = new View();
		$v->setView("login/newpassword","templateadmin-modal");
		$v->massAssign([
			"title" => "Nouveau mot de passe",
			"description" => "Connexion",
			"config" => $form,
			"errors" => $errors
		]);
		
		
		
	}


}
