<?php

	class users extends basesql
	{
		protected $id;
		protected $login;
		protected $firstname;
		protected $lastname;		
		protected $role;
		protected $email;
		protected $password;
		protected $date;
		protected $state;

		public function __construct()
		{
			parent::__construct();
		}


		public function setId($id)
		{
			$this->id = $id;
		}

		public function setLogin($login)
		{
			$this->login = trim($login);
		}

		public function setLastname($lastname)
		{
			$this->lastname = trim($lastname);
		}

		public function setFirstname($firstname)
		{
			$this->firstname = trim($firstname);
		}

		public function setEmail($email)
		{
			$this->email = trim($email);
		}

		public function setPassword($password)
		{
			$this->password = $password;
		}

		
		public function setDate()
		{
			$this->date = date("Y-m-d H:i:s");
		}
		public function setState($state)
		{
			$this->state = $state;
		}
		public function setFirm($firm)
		{
			$this->firm = $firm;
		}
		public function setRole($role)
		{
			$this->role = $role;
		}


		public function getId()
		{
			return $this->id;
		}

		public function getLogin()
		{
			return $this->login;
		}

		public function getEmail()
		{
			return $this->email;
		}

		public function getFirstname()
		{
			return $this->firstname;
		}
		
		public function getLastname()
		{
			return $this->lastname;
		}
		
		public function getFirm()
		{
			return $this->firm;
		}
		
		public function getState()
		{
			return $this->state;
		}
		
		public function getRole()
		{
			return $this->role;
		}
		
		public function getDate()
		{
			return $this->date;
		}
		

		public static function getFormLogin(){

			return [	
						"options" => [ "method"=>"POST", "action"=>"", "submit"=>"Se connecter", "enctype"=>"multipart/form-data" ],
						"struct" => [
							"login"=>["label"=> "", "type"=>"text", "id"=>"loginco", "placeholder"=>"Identifiant", "required"=>1, "msgerror"=>"" ],

							"password"=>["label"=> "", "type"=>"password", "id"=>"passwordco", "placeholder"=>"Mot de passe", "required"=>1, "msgerror"=>"password" ],
						]
			];

		}

		public static function getFormNewUser(){

				return [	
						"options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'utilisateur", "enctype"=>"multipart/form-data" ],
						"struct" => [

							"login"=>[ "label"=>"Identifiant", "type"=>"text", "id"=>"login", "placeholder"=>"Identifiant", "required"=>1, "msgerror"=>"newlogin" ],

							"firstname"=>[ "label"=>"Prénom", "type"=>"text", "id"=>"firstname", "placeholder"=>"Prénom", "required"=>1, "msgerror"=>"firstname" ],

							"lastname"=>[ "label"=>"Nom", "type"=>"text", "id"=>"lastname", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"lastname" ],

							"firm"=>[ "label"=>"Entreprise", "type"=>"text", "id"=>"firm", "placeholder"=>"Entreprise", "required"=>1, "msgerror"=>"firm" ],

							"email"=>[ "label"=>"E-mail", "type"=>"text", "id"=>"email", "placeholder"=>"E-mail", "required"=>1, "msgerror"=>"email" ],

							"selectrole"=>[ "label"=>"Role de l'utilisateur", "type"=>"selectrole", "id"=>"selectrole", "placeholder"=>"Role", "required"=>1, "msgerror"=>"selectrole" ],

							"password1"=>[ "label"=>"Mot de passe", "type"=>"password", "id"=>"password1", "placeholder"=>"Mot de passe", "required"=>1, "msgerror"=>"password1" ],

							"password2"=>[ "label"=>"Confirmation mot de passe", "type"=>"password", "id"=>"password2", "placeholder"=>"Confirmation", "required"=>1, "msgerror"=>"password2" ]
						]
			];

		}



	}	
