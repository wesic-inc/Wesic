<?php
class settingController{

	public function indexAction(Request $request){

		$post = $request->getPost();

		$form = Setting::getFormSettings();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $post);

			if(!$errors){
				if(!Validator::process($form["struct"], $post, 'setting')){
					$errors=["settings"];
				}
				else{
					Route::redirect('generalSettings');
				}
				
			}
		}

		$data = Setting::getSettings();
		
		$_POST['title'] = $data['title']['value']; 
		$_POST['slogan'] = $data['slogan']['value']; 
		$_POST['url'] = $data['url']['value']; 
		$_POST['email'] = $data['email']['value']; 
		$_POST['comments'] = $data['comments']['value']; 
		$_POST['timezone'] = $data['timezone']['value']; 
		$_POST['datetype'] = $data['datetype']['value']; 
		$_POST['timetype'] = $data['timetype']['value']; 

		$v = new View();
		$v->setView("admin/settings","templateadmin");
		$v->massAssign([
			"title" => "Général",
			"icon" => "icon-equalizer",
			"form" =>  $form,
			"errors" =>  $errors
		]);
	}

	public function postAction(Request $request){

		$post = $request->getPost();

		$form = Setting::getFormSettingsPost();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $post);

			if(!$errors){
				if(!Validator::process($form["struct"], $post, 'setting-post'))
				{
					$errors=["settings"]; 
				}else{
					Route::redirect('postSettings');
				}

			}
		}
		$data = Setting::getSettings();
		
		$_POST['mail-server'] = $data['mail-server']['value']; 
		$_POST['mail-port'] = $data['mail-port']['value']; 
		$_POST['mail-login'] = $data['mail-login']['value']; 
		$_POST['mail-password'] = $data['mail-password']['value']; 
		$_POST['default-cat'] = $data['default-cat']['value']; 
		$_POST['default-format'] = $data['default-format']['value']; 

		$v = new View();
		$v->setView("admin/settings","templateadmin");
		$v->massAssign([
			"title" => "Publication", 
			"icon" => "icon-equalizer",
			"form" =>  $form,
			"errors" => $errors
		]);
		
	}

	public function viewAction(Request $request){

		$post = $request->getPost();

		$form = Setting::getFormSettingsView();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $post);

			if(!$errors){
				if(!Validator::process($form["struct"], $post, 'setting-view')){
					$errors=["settings"];
				}else{
					Route::redirect('viewSettings');
				}

			}
		}
		
		$data = Setting::getSettings();
		
		$_POST['homepage'] = $data['homepage']['value']; 
		$_POST['pagination-posts'] = $data['pagination-posts']['value']; 
		$_POST['pagination-rss'] = $data['pagination-rss']['value']; 
		$_POST['display-post'] = $data['display-post']['value'];

		$v = new View();
		$v->setView("admin/settings","templateadmin");
		$v->massAssign([
			"title" => "Lecture",
			"icon" => "icon-equalizer",
			"form" =>  $form,
			"errors" => $errors
		]);
	}
}