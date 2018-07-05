<?php
class themeController{
/**
 * [indexAction description]
 * @param  [type] $args [description]
 * @return [type]       [description]
 */
	public static function indexAction($args){

		$v = new View();
		$v->setView("theme/index","templateadmin");
		$v->assign("title","Tous les thèmes");
		$v->assign("icon","icon-paint-format");
	}
/**
 * [indexAction description]
 * @param  [type] $args [description]
 * @return [type]       [description]
 */
	public static function editThemeAction($args){
		$v = new View();
		$v->setView("theme/all-themes","templateadmin");
		$v->assign("title","Modifier mon thème");
		$v->assign("icon","icon-eyedropper");

	}
/**
 * [indexAction description]
 * @param  [type] $args [description]
 * @return [type]       [description]
 */
	public static function themeCreatorAction($args){
		$v = new View();
		$v->setView("theme/themecreator","templateadmin");
		$v->assign("title","Theme Creator");
		$v->assign("icon","icon-droplet");
	}	
/**
 * [indexAction description]
 * @param  [type] $args [description]
 * @return [type]       [description]
 */	
	public static function menuCreatorAction($args){
		
		$v = new View();
		$v->setView("theme/menucreator","templateadmin");
		$v->assign("title","Menu Creator");
		$v->assign("icon","icon-menu");
	
	}
}