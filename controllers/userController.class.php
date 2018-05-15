<?php


class userController {
	
	public static function indexAction($args){
		echo "Profile";
	}  

	public function allUsersAction($args){

		$qbUsers = new QueryBuilder();
		$qbUsers->select('*')->from('user');

		if($args['params'][0] === "filter"){
			$filter = true;
			switch ($args['params'][1]) {
				case 1:
					$qbUsers
					->openBracket()
					->addWhere('status != :status1')
					->setParameter('status1',5)
					->or()
					->addWhere('status != :status2')
					->setParameter('status2',2)
					->closeBracket()
					->and()
					->addWhere('role = :role')
					->setParameter('role',5);
					break;
				case 2:
					$qbUsers
					->openBracket()
					->addWhere('status != :status1')
					->setParameter('status1',5)
					->or()
					->addWhere('status != :status2')
					->setParameter('status2',2)
					->closeBracket()
					->and()
					->addWhere('role = :role')
					->setParameter('role',2);
					break;
				case 3:
					$qbUsers
					->openBracket()
					->addWhere('status != :status1')
					->setParameter('status1',5)
					->or()
					->addWhere('status != :status2')
					->setParameter('status2',2)
					->closeBracket()
					->and()
					->addWhere('role = :role')
					->setParameter('role',3);
					break;
				case 4:
					$qbUsers
					->openBracket()
					->addWhere('status != :status1')
					->setParameter('status1',5)
					->or()
					->addWhere('status != :status2')
					->setParameter('status2',2)
					->closeBracket()
					->and()
					->addWhere('role = :role')
					->setParameter('role',4);
					break;
				case 5:
					$qbUsers
					->addWhere('status = :status1')
					->setParameter('status1',5)
					->or()
					->addWhere('role != :role')
					->setParameter('role', 2);
					break;
			}
		}


		$qb = new QueryBuilder();
		// $qb->findAll('user')->addWhere('token = :token')->setParameter('token',$_SESSION['token'])->fetchOne();
	
		$user = new User();

		$qb->reset();

		$elementNumber = $qb->select('COUNT(*)')
			->from('user')
			->addWhere('status = :status1')
			->setParameter('status1',5)
			->addSeparator('OR')
			->addWhere('status = :status2')
			->setParameter('status2',2)
			->fetchOne()[0];

		Format::dump($route_access,1);
		

		$elementPerPage = 5;

		$nbPage = $elementNumber/$elementPerPage;

		if($elementNumber%$elementPerPage != 0 ){
			$nbPage = ceil($nbPage);
		}

		$nbPage = intval($nbPage);

		if(!isset($args['params'][0]) || $args['params'][0] == 1){
			$userRes = $qbUsers->limit('0',$elementPerPage)->execute();
			$currentPage = 1;
		}else{
			// if($args['params'][0] > $nbPage || $args['params'][0] < 1){
			// 	header('location: /admin/utilisateurs');	
			// }
			$currentPage = $args['params'][0];
			$userRes = $qbUsers->limit($args['params'][0]*$elementPerPage-$elementPerPage,$elementPerPage)->execute();

		}

		Format::dump($userRes,1);
		$v = new View();
		$v->setView("cms/users","templateadmin");
		$v->assign("title","Tous les utilisateurs");
		$v->assign("icon","icon-users");
		$v->assign("users",$userRes);
		$v->assign("elementNumber",$elementNumber);
		$v->assign("nbPage",$nbPage);
		$v->assign("elementPerPage",$elementPerPage);
		$v->assign("currentPage",$currentPage);
		$v->assign("targetUri","admin/utilisateurs/");
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

		$editedUser = $user->getData('user',["id"=>$args['params'][0]])[0];

		if(empty($editedUser)){
			header('location: /admin/utilisateurs');
		}

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
    		header('location: /admin/modifier-utilisateur/'.$userFound['id']);
    	}
	}
	public function banUserAction($args){

		$user = new User();
    	$userFound = $user->getData("user",['id' => $args['params'][0]])[0];

    	if(!empty($userFound)){
    		User::setUserStatus($userFound['id'],4);
    		header('location: /admin/modifier-utilisateur/'.$userFound['id']);
    	}
	}
	public function deleteUserAction($args){

		$user = new User();
    	$userFound = $user->getData("user",['id' => $args['params'][0]])[0];

    	if(!empty($userFound)){
    		User::setUserStatus($userFound['id'],5);
    		header('location: /admin/modifier-utilisateur/'.$userFound['id']);
    	}
	}
	public function destroyUserAction($args){

		// $user = new User();
  //   	$userFound = $user->getData("user",['id' => $args['params'][0]])[0];

  //   	if(!empty($userFound)){
  //   		User::setUserStatus($userFound['id'],5);
  //   	}
		echo "user boom boom";
	}
}