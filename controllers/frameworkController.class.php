<?php
class frameworkController{

	public function deleteFlashSessionAjaxAction(){
		View::destroyFlash();
	}	
}