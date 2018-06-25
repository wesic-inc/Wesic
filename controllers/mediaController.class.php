<?php

class mediaController{

		public function indexAction($args){

		$v = new View();
		$v->setView("media/medias","templateadmin")->massAssign(["title"=>"Médias","icon"=>"icon-images"]);
		
	}
}