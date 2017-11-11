<?php
class indexController{

	public function indexAction($args){
		

		$v = new view();
		$v->setView("indexIndex");
		$v->assign("pseudo", "User");


	}

	public function testAction($args){
		echo "Bonjour2";
	}

}
