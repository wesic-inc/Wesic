<?php

class statController{
	public function indexAction($args){
		
		$stats = stat::mostViewedArticles();

		$stat_json = json_encode($stats);

		$v = new View();
		$v->setView("stat/index","templateadmin");
		$v->assign("icon","icon-stats-dots");
		$v->assign("stat_json",$stat_json);
		$v->assign("title","Statistiques");
	
	}

	public function exportAction($args){
		
		$v = new View();
		$v->setView("stat/index","templateadmin");
		$v->assign("icon","icon-stats-dots");
		$v->assign("title","Exporter mes statistiques");
	
	}
}