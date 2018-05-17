<?php
class newsletterController{

public function signUpAction($args){


		$form = User::getNewsletterSignUpForm();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'signup-newsletter')?$errors=["email-newsletter"]:Route::redirect('SignUpNewsletterSuccess');
			}
		}

		$v = new View();
		$v->setView("newsletter/signup","website-modal");
		$v->assign("title", "Insrivez vous à la newsletter");
		$v->assign("icon", "icon-user-plus");
		$v->assign("form", $form);
		$v->assign("errors", $errors);

}
	public function signUpSuccessAction($args){
				$v = new View();
		$v->setView("dev/template","website-modal");
		$v->assign("title", "Insrivez vous à la newsletter");
	}
	
}