<?php
class eventController{


	public function indexAction($args){

		$param = Route::checkParameters($args['params']);

		if($param == false){
			Route::redirect('allUsers');
		}

		$v = new View();
		$v->setView("event/index","templateadmin")->massAssign(["title"=>"Evenements","icon"=>"icon-alarm"]);

	}

	public function addEventAction($args){
		echo "hello";



	}

}