<?php 
class articles extends basesql{

	protected $id;
	protected $title;
	protected $content;

	public function __construct(){
		parent::__construct();
	}

	public function setId($id){
		$this->id=$id;
	}
	public function setTitle($title){
		$this->title=trim($title);
	}
	public function setContent($content){
		$this->content=trim($content);
	}

	public function getId(){
		return $this->id;
	}
	public function getTitle(){
		return $this->title;
	}
	public function getContent(){
		return $this->content;
	}

	public function getForm(){

		return [	
					"options" => [ "method"=>"GET", "action"=>"", "submit"=>"Ajouter un article" ],
					"struct" => [
						"title"=>[ "label"=>"Votre titre", "type"=>"text", "id"=>"title", "placeholder"=>"Votre titre", "required"=>1, "msgerror"=>"title" ],

						"password"=>[ "label"=>"Votre mot de passe", "type"=>"password", "id"=>"password", "placeholder"=>"Mot de passe", "required"=>1, "msgerror"=>"password" ],

						"password2"=>[ "label"=>"Confirmation", "type"=>"password", "id"=>"password2", "placeholder"=>"Mot de passe", "required"=>1, "msgerror"=>"passwordconfirm" ],

						"content"=>[ "label"=>"Votre page", "type"=>"textarea", "id"=>"content", "placeholder"=>"contenu", "required"=>1, "msgerror"=>"contentpage" ]
					]
		];

	}


}







