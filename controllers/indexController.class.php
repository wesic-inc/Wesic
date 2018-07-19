<?php

class indexController{
/**
 * [indexAction description]
 * @param  [type] $args [description]
 * @return [type]       [description]
 */
	public function indexAction($args){

		$v = new View();

		$v->setView("home","template","front");
		
        Singleton::bridge([
        	'view'=>$v->getViewInfos()
        ]);

		Stat::add(1,"page d'accueuil",3);
	}
/**
 * [indexAction description]
 * @param  [type] $args [description]
 * @return [type]       [description]
 */
	public function testAction($args){
		echo "Bonjour2";
	}

}
