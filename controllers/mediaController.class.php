<?php

class mediaController{
/**
 * [indexAction description]
 * @param  [type] $args [description]
 * @return [type]       [description]
 */
		public function indexAction($args){

		$v = new View();
		$v->setView("media/medias","templateadmin")->massAssign(["title"=>"Médias","icon"=>"icon-images"]);
		
	}
}