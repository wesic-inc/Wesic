<?php
class frameworkController{

	public function deleteFlashSessionAjaxAction(){
		View::destroyFlash();
	}

	public function addFlashSessionAjaxAction($args){
		dump($args,2);
		View::destroyFlash();
	}	
}