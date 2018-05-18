<?php


class userController {
	
	public static function indexAction($args){
		echo "Profile";
	}  

	public function allUsersAction($args){

		$qbUsers = new QueryBuilder();
		$qbUsers->select('*')->from('user');

		$param = Route::checkParameters($args['params']);

		$param_json = json_encode($param);

		if($param == false){
			Route::redirect('allUsers');
		}

		if( isset($param['filter']) ){
			
			$filter = true;
			$qbUsers = Basesql::userDisplayFilters($qbUsers,$param['filter']);

		}
		if( isset($param['p']) ){
			
			$pagination = true;
			$page = $param['p'];
		}

		$qb = new QueryBuilder();

		$countAll = $qb->select('COUNT(*)')->from('user')->addWhere('status != :status1')->setParameter('status1',5)->addSeparator('OR')->addWhere('status = :status2')->setParameter('status2',2)->fetchOne()[0];
		
		$elementPerPage = 5;

		$nbPage = Format::pageCalc($count,elementPerPage);

		if(!isset($page) || $page == 1){
			$userRes = $qbUsers->limit('0',$elementPerPage)->execute();
			$currentPage = 1;
		}else{
			if($page > $nbPage || $page < 1){
				Route::redirect('AllUsers');	
			}
			$currentPage = $page;
			$userRes = $qbUsers->limit($page*$elementPerPage-$elementPerPage,$elementPerPage)->execute();
		}

		$v = new View();
		$v->setView("cms/users","templateadmin");
		$v->assign("title","Tous les utilisateurs");
		$v->assign("icon","icon-users");
		$v->assign("users",$userRes);
		$v->assign("elementNumber",$countAll);
		$v->assign("nbPage",$nbPage);
		$v->assign("filter",$param['filter']);
		$v->assign("elementPerPage",$elementPerPage);
		$v->assign("currentPage",$currentPage);
		$v->assign("param_json",$param_json);
	}
	public function allUsersAjaxAction($args){
		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$qbUsers = new QueryBuilder();
			$qbUsers->select('*')->from('user');

			$param = Route::checkParameters($args['params']);
			switch ($param['sort']) {
				case 1:
					$qbUsers->OrderBy('login','DESC');
					break;
				case -1:
					$qbUsers->OrderBy('login','ASC');
					break;
				case 2:
					$qbUsers->OrderBy('lastname','DESC');
					break;
				case -2:
					$qbUsers->OrderBy('lastname','ASC');
					break;
				case 3:
					$qbUsers->OrderBy('email','DESC');
					break;
				case -3:
					$qbUsers->OrderBy('email','ASC');
					break;
				case 4:
					$qbUsers->OrderBy('role','DESC');
					break;
				case -4:
					$qbUsers->OrderBy('role','ASC');
					break;
				default:
					return false;
				break;
			}			

			$users = $qbUsers->execute();
			$v = new View();
			$v->setView("ajax/allUsers","templateajax");
			$v->assign("users",$users);
		}
	}
	public function addUserAction($args){

		$form = User::getFormNewUser();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'add-user')?$errors=["userexists"]:Route::redirect('AllUsers');

				
			}
		}

		$v = new View();
		$v->setView("cms/newuser","templateadmin");
		$v->assign("page","adduser");
		$v->assign("title", "Ajouter un utilisateur");
		$v->assign("icon", "icon-user-plus");
		$v->assign("form", $form);
		$v->assign("errors", $errors);

	}

	public function editUserAction($args){
		
		if(!is_numeric($args['params'][0])){
			Route::redirect('AllUsers');
			
		}

		$user = new User();

		$editedUser = $user->getData('user',["id"=>$args['params'][0]])[0];

		if(empty($editedUser)){
			Route::redirect('AllUsers');
		}

		$form = User::getFormEditUser();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'edit-user')?$errors=["error"]:Route::redirect('AllUsers');
				
			}
		}

		$_POST["login"] = $editedUser['login'];
		$_POST["firstname"] = $editedUser['firstname'];
		$_POST["lastname"] = $editedUser['lastname'];
		$_POST["email"] = $editedUser['email'];
		$_POST["role"] = $editedUser['role'];
		$_POST["newpasswordlink"] = "/admin/nouveau-mot-de-passe/".$args['params'][0];
		$_POST["deleteuser1"] = "/admin/supprimer-utilisateur/".$args['params'][0];
		$_POST["deleteuser2"] = "/admin/detruire-utilisateur/".$args['params'][0];
		$_POST["status"] = $editedUser['status'];


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
			Route::redirect('AllUsers');
		}

		$user = new User();
		$userFound = $user->getData('user',["id"=>$_SESSION["id"]])[0];

		$editedUser = $user->getData('user',["id"=>$args['params'][0]])[0];

		$form = User::getFormViewUser();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'edit-user')?$errors=["userexists"]:Route::redirect('AllUsers');
				
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
			Route::redirect('Error404');
		}
		else
		{

			$form = User::getFormModifyPassword();
			$errors = [];

			if($_SERVER["REQUEST_METHOD"] == "POST"){

				$errors = Validator::check($form["struct"], $args['post']);

				if(!$errors){
					$args['post']['token'] = $args['token'];
					!Validator::process($form["struct"], $args['post'], 'modifypassword')?$errors=["password"]:Route::redirect('Login');

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

		$v = new View();
		$v->setView("login/emailconfirmed","templateadmin-modal");
		$v->assign("title", "Merci !");
		$v->assign("description", "Connexion");
	}


	public function newsletterConfirmationActio($args){

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
	public static function forceNewPasswordAction($args){

		$user = new User();
		$userFound = $user->getData("user",['id' => $args['params'][0]])[0];
		if(!empty($userFound)){
			Passwordrecovery::sendResetPassword($userFound['login']);
		}
	}
	public function disableUserAction($args){

		$user = new User();
		$userFound = $user->getData("user",['id' => $args['params'][0]])[0];

		if(!empty($userFound)){
			User::setUserStatus($userFound['id'],3);
			Route::redirect('EditUser',$userFound['id']);
		}
	}
	public function banUserAction($args){

		$user = new User();
		$userFound = $user->getData("user",['id' => $args['params'][0]])[0];

		if(!empty($userFound)){
			User::setUserStatus($userFound['id'],4);
			Route::redirect('EditUser',$userFound['id']);
		}
	}
	public function deleteUserAction($args){
		$user = new User();
		$userFound = $user->getData("user",['id' => $args['params'][0]])[0];

		if(!empty($userFound)){
			User::setUserStatus($userFound['id'],5);
			Route::redirect('EditUser',$userFound['id']);
		}
	}
	public function destroyUserAction($args){


		echo "user boom boom";
	}
}