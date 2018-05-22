<?php

class statController{
	public function indexAction($args){
		
		$stats = stat::mostViewedArticles();

		foreach ($stats['year'] as $key => $value) {
			$stats['year'][$key] = $value[0];
		}

				foreach ($stats['semester'] as $key => $value) {
			$stats['semester'][$key] = $value[0];
		}

				foreach ($stats['trimester'] as $key => $value) {
			$stats['trimester'][$key] = $value[0];
		}

				foreach ($stats['week'] as $key => $value) {
			$stats['week'][$key] = $value[0];
		}

				foreach ($stats['today'] as $key => $value) {
			$stats['today'][$key] = $value[0];
		}

		$scale = Stat::recreateScale();
		$stat_json = json_encode($stats);
		$scale_json = json_encode($scale);

		$v = new View();
		$v->setView("stat/index","templateadmin");
		$v->assign("icon","icon-stats-dots");
		$v->assign("stat_json",$stat_json);
		$v->assign("scale_json",$scale_json);
		$v->assign("title","Statistiques");
	
	}

	public function exportAction($args){
		
		$v = new View();
		$v->setView("stat/index","templateadmin");
		$v->assign("icon","icon-stats-dots");
		$v->assign("title","Exporter mes statistiques");
	
	}
}