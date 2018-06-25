<?php
class eventController{


	public function indexAction(Request $request){

		$params = $request->getParams();

		$v = new View();
		$v->setView("event/index","templateadmin")->massAssign(["title"=>"Evenements","icon"=>"icon-alarm"]);

	}

	public function addEventAction(Request $request){
		echo "hello";



	}

}