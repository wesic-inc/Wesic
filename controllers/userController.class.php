<?php


class userController {
	
	public static function indexAction($args){
		echo "Profile";
	}  

	public function allUsersAction($args){


		$user = new User();
		$usersRes = $user->getData('user');
		$elementNumber = count($usersRes);


		$v = new View();
		$v->setView("cms/users","templateadmin");
		$v->assign("users",$usersRes);
		$v->assign("title","Tous les utilisateurs");
		$v->assign("icon","icon-users");
		$v->assign("users",$usersRes);
		$v->assign("number",$elementNumber);
	}

	public function addUserAction($args){

		$user = new User();
		$userFound = $user->getData('user',["id"=>$_SESSION["id"]])[0];

		$form = User::getFormNewUser();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'signup')?$errors=["userexists"]:header("Location: /admin/utilisateurs");
				
			}
		}

		$v = new View();
		$v->setView("cms/newuser","templateadmin");
		$v->assign("pseudo", $userFound["email"]);
		$v->assign("role",$userFound["role"]);
		$v->assign("page","adduser");
		$v->assign("title", "Ajouter un utilisateur");
		$v->assign("icon", "icon-user-plus");
		$v->assign("form", $form);
		$v->assign("errors", $errors);

	}

	public function editUserAction($args){
		
		if(!is_numeric($args['params'][0])){
			header('location: /admin/utilisateurs');
		}

		$user = new User();
		$userFound = $user->getData('user',["id"=>$_SESSION["id"]])[0];

		$editedUser = $user->getData('user',["id"=>$args['params'][0]])[0];

		$form = User::getFormEditUser();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'edit-user')?$errors=["error"]:header("Location: /admin/utilisateurs");
				
			}
		}

		$_POST["login"] = $editedUser['login'];
		$_POST["firstname"] = $editedUser['firstname'];
		$_POST["lastname"] = $editedUser['lastname'];
		$_POST["email"] = $editedUser['email'];
		$_POST["role"] = $editedUser['role'];
		$_POST["newpasswordlink"] = "/admin/nouveau-mot-de-passe/".$args['params'][0];


		$v = new View();
		$v->setView("cms/newuser","templateadmin");
		$v->assign("pseudo", $userFound["email"]);
		$v->assign("role",$userFound["role"]);
		$v->assign("page","adduser");
		$v->assign("title", "Modifier un utilisateur");
		$v->assign("icon", "icon-user");
		$v->assign("form", $form);
		$v->assign("errors", $errors);

	}


	public function viewUserAction($args){

		if(!is_numeric($args['params'][0])){
			header('location: /admin/utilisateurs');
		}

		$user = new User();
		$userFound = $user->getData('user',["id"=>$_SESSION["id"]])[0];

		$editedUser = $user->getData('user',["id"=>$args['params'][0]])[0];

		$form = User::getFormViewUser();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'edit-user')?$errors=["userexists"]:header("Location: /admin/utilisateurs");
				
			}
		}

		$_POST["login"] = $editedUser['login'];
		$_POST["firstname"] = $editedUser['firstname'];
		$_POST["lastname"] = $editedUser['lastname'];
		$_POST["email"] = $editedUser['email'];
		$_POST["role"] = $editedUser['role'];
		$_POST["editlink"] = "/admin/modifier-utilisateur/".$args['params'][0];

		$v = new View();
		$v->setView("cms/newuser","templateadmin");
		$v->assign("pseudo", $userFound["email"]);
		$v->assign("role",$userFound["role"]);
		$v->assign("page","adduser");
		$v->assign("title", "Afficher un utilisateur");
		$v->assign("icon", "icon-user");
		$v->assign("form", $form);
		$v->assign("errors", $errors);

	}

	public function newPasswordConfirmationAction($args){


		$passwordrecovery = new Passwordrecovery();

		$result = $passwordrecovery->getData('passwordrecovery',["token"=>$args['token']]);

		$token_generated  = new DateTime($result['date']);

		if($token_generated->format('U') > $token_generated->format('U') + 86400 ) 
		{     
			header('location: error/404');
		}
		else
		{

			$form = User::getFormModifyPassword();
			$errors = [];

			if($_SERVER["REQUEST_METHOD"] == "POST"){

				$errors = Validator::check($form["struct"], $args['post']);

				if(!$errors){
					$args['post']['token'] = $args['token'];
					!Validator::process($form["struct"], $args['post'], 'modifypassword')?$errors=["password"]:header("Location: /connexion");

				}
			}

			$v = new View();
			$v->setView("login/modifypassword","templateadmin-modal");
			$v->assign("title", "Connexion");
			$v->assign("description", "Connexion");
			$v->assign("form", $form);
			$v->assign("errors", $errors);

		}

	}

	public function newAccountConfirmationAction($args){

		$passwordrecovery = new Passwordrecovery();

		$item = $passwordrecovery->getData('passwordrecovery',['slug'=>$args['token']])[0];

		$user = new User();

		$user->setId($item['user_id']);
		$user->setStatus(1);
		$user->save();

		$user->cleanUserSlugPasswordRecovery();

		Format::dump($user,1);

		$v = new View();
		$v->setView("login/emailconfirmed","templateadmin-modal");
		$v->assign("title", "Merci !");
		$v->assign("description", "Connexion");
	}
}