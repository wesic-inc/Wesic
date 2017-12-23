<?php 
class Article extends Basesql{

	protected $id;
	protected $title;
	protected $slug;
	protected $content;
	protected $excerpt;
	protected $description;
	protected $dateCreation;
	protected $datePublied;
	protected $status;
	protected $visibility;
	protected $user_id;


	public function __construct(){
		parent::__construct();
	}





}







