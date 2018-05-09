<?php
class categoryController{

	public static function allCategoriesAction($args){
		$v = new View();
		$v->setView("cms/articles","templateadmin");
		$v->assign("pseudo", $userFound['firstname']." ".$userFound['lastname']);
		$v->assign("title", "Catégories");
		$v->assign("icon", "icon-bookmarks");

	} 
	public static function allTagsAction($args){
		$v = new View();
		$v->setView("cms/articles","templateadmin");
		$v->assign("pseudo", $userFound['firstname']." ".$userFound['lastname']);
		$v->assign("title", "Tags");
		$v->assign("icon", "icon-pushpin");
	}
}