<?php

class statController{
	public function indexAction(Request $request){
		
		$statsK = stat::numberOfViewsKnown();
		$statsA = stat::numberOfViewsAnon();

		foreach ($statsK['year'] as $key => $value) {
			$statsK['year'][$key] = $value[0];
		}

				foreach ($statsK['semester'] as $key => $value) {
			$statsK['semester'][$key] = $value[0];
		}

				foreach ($statsK['trimester'] as $key => $value) {
			$statsK['trimester'][$key] = $value[0];
		}

				foreach ($statsK['week'] as $key => $value) {
			$statsK['week'][$key] = $value[0];
		}

				foreach ($statsK['today'] as $key => $value) {
			$statsK['today'][$key] = $value[0];
		}

				foreach ($statsK['year'] as $key => $value) {
			$statsA['year'][$key] = $value[0];
		}

				foreach ($statsK['semester'] as $key => $value) {
			$statsA['semester'][$key] = $value[0];
		}

				foreach ($statsK['trimester'] as $key => $value) {
			$statsA['trimester'][$key] = $value[0];
		}

				foreach ($statsK['week'] as $key => $value) {
			$statsA['week'][$key] = $value[0];
		}

				foreach ($statsK['today'] as $key => $value) {
			$statsA['today'][$key] = $value[0];
		}


		$scale = Stat::recreateScale();

		$statsK = json_encode($statsK);
		$statsA = json_encode($statsA);
		$scale_json = json_encode($scale);

		$v = new View();
		$v->setView("stat/index","templateadmin");
		$v->massAssign([
			"icon" => "icon-stats-dots",
			"statA_json" => $statsA,
			"statK_json" => $statsK,
			"scale_json" => $scale_json,
			"title" => "Statistiques"
		]);
	
	}

	public function exportAction(Request $request){
		
		$v = new View();
		$v->setView("stat/index","templateadmin")->massAssign(["icon"=>"icon-stats-dots","title"=>"Exporter mes statistiques"]);
	
	}
}