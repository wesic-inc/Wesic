<?php

class mediaController{

		public function indexAction($args){

		$v = new View();
		// $v->setView("dev/template","templateadmin");
		$v->setView("media/medias","templateadmin");
		$v->assign("title","Médias");
		$v->assign("icon","icon-images");
	}
}