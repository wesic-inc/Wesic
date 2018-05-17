<?php
class settingController{

	public function indexAction($args){

		$form = Setting::getFormSettings();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'setting')?$errors=["settings"]:Route::redirect('generalSettings');
			}
		}

		$data = Setting::getSettings();
		
		$_POST['title'] = $data['title']['value']; 
		$_POST['slogan'] = $data['slogan']['value']; 
		$_POST['url'] = $data['url']['value']; 
		$_POST['email'] = $data['email']['value']; 
		$_POST['timezone'] = $data['timezone']['value']; 
		$_POST['datetype'] = $data['datetype']['value']; 
		$_POST['timetype'] = $data['timetype']['value']; 

		$v = new View();
		$v->setView("admin/settings","templateadmin");
		$v->assign("title","Général");
		$v->assign("icon","icon-equalizer");
		$v->assign("form", $form);
		$v->assign("errors", $errors);
	}

		public function postAction($args){



		$form = Setting::getFormSettingsPost();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'setting-post')?$errors=["settings"]:Route::redirect('postSettings');

				
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
		$v->assign("title","Publication");
		$v->assign("icon","icon-equalizer");
		$v->assign("form", $form);
		$v->assign("errors", $errors);
		
	}

		public function viewAction($args){



		$form = Setting::getFormSettingsView();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'setting-view')?$errors=["settings"]:Route::redirect('viewSettings');

				
			}
		}
		
		$data = Setting::getSettings();


		$_POST['homepage'] = $data['homepage']['value']; 
		$_POST['pagination-posts'] = $data['pagination-posts']['value']; 
		$_POST['pagination-rss'] = $data['pagination-rss']['value']; 
		$_POST['display-post'] = $data['display-post']['value'];


		$v = new View();
		$v->setView("admin/settings","templateadmin");
		$v->assign("title","Lecture");
		$v->assign("icon","icon-equalizer");
		$v->assign("form", $form);
		$v->assign("errors", $errors);
	}
}