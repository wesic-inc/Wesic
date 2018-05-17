<?php

class statController{
	public function indexAction($args){
		
		$v = new View();
		$v->setView("stat/index","templateadmin");
		$v->assign("icon","icon-stats-dots");
		$v->assign("title","Statistiques");
	
	}

	public function exportAction($args){
		
		$v = new View();
		$v->setView("stat/index","templateadmin");
		$v->assign("icon","icon-stats-dots");
		$v->assign("title","Exporter mes statistiques");
	
	}
}