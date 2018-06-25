<?php
class themeController{
	public static function indexAction($args){

		$v = new View();
		$v->setView("theme/index","templateadmin");
		$v->assign("title","Tous les thèmes");
		$v->assign("icon","icon-paint-format");
	}
	public static function editThemeAction($args){
		$v = new View();
		$v->setView("theme/all-themes","templateadmin");
		$v->assign("title","Modifier mon thème");
		$v->assign("icon","icon-eyedropper");

	}
	public static function themeCreatorAction($args){
		$v = new View();
		$v->setView("theme/themecreator","templateadmin");
		$v->assign("title","Theme Creator");
		$v->assign("icon","icon-droplet");
	}	
	public static function menuCreatorAction($args){
		
		$v = new View();
		$v->setView("theme/menucreator","templateadmin");
		$v->assign("title","Menu Creator");
		$v->assign("icon","icon-menu");
	
	}
}