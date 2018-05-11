<?php

class mediaController{

		public function indexAction($args){

		$v = new View();
		$v->setView("dev/template","templateadmin");
	}
}