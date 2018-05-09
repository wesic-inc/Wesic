<?php
class View{
	protected $data = [];
	protected $view;
	protected $template;

	public function setView($view, $layout="template"){

		// $view = indexIndex
		$path_view = "views/".$view.".view.php";
		$path_template = "views/templates/".$layout.".tpl.php";

		if( file_exists($path_view) ){
			$this->view=$path_view;

			if(file_exists($path_template)){
				$this->template=$path_template;
			}else{
				header('location: '.ROOT_URL.$rof['routing_dev']['Error404']['path']);
			}

		}else{
			header('location: '.ROOT_URL.$rof['routing_dev']['Error404']['path']);
		}



	}

	public function createForm($form, $errors){
		global $errors_msg;
		include "views/templates/form.tpl.php";
	}

	public function addModal($modal, $config, $errors=[]){

		global $errors_msg;
		include "views/modals/".$modal.".mdl.php";

	}

	public function assign($key, $value){
		$this->data[$key]=$value;
	}

	public function __destruct(){

		global $a, $c, $sitename	;
		extract($this->data);

		include $this->template;
	}


}



