<?php

	class user extends basesql
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



	}	
