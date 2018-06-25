<?php
class newsletterController{

	public function signUpAction($args){


		$form = User::getNewsletterSignUpForm();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				
				Stat::add(1,"inscription newsletter",5);

				if(!Validator::process($form["struct"], $args['post'], 'signup-newsletter')){
					$errors=["email-newsletter"];
				}
				else{
					Route::redirect('SignUpNewsletterSuccess');
				}

			}
		}

		$v = new View();
		$v->setView("newsletter/signup","website-modal");
		$v->massAssign([
			"title" => "Insrivez vous à la newsletter",
			"icon" => "icon-user-plus",
			"form" => $form,
			"errors" => $errors
		]);

	}
	public function signUpSuccessAction($args){

		$v = new View();
		$v->setView("dev/template","website-modal")->assign("title", "Insrivez vous à la newsletter");

	}

}