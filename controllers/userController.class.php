<?php


class userController {
	
	public static function indexAction($args){
		echo "Profile";
	}  

	public function allUsersAction($args){


		$user = new User();
		$usersRes = $user->getData('user');


		$v = new View();
		$v->setView("cms/users","templateadmin");
		$v->assign("users",$usersRes);
	}

	public function addUserAction($args){

		$user = new User();
		$usersRes = $user->getData('user');

		$v = new View();
		$v->setView("cms/newuser","templateadmin");
		$v->assign("users",$usersRes);
	}
}