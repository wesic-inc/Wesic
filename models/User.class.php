<?php

	class User extends Basesql
	{
		protected $id;
		protected $login;
		protected $firstname;
		protected $lastname;		
		protected $role;
		protected $email;
		protected $password;
		protected $creationDate;
		protected $status;

		public function __construct()
		{
			parent::__construct();
		}



	 /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     *
     * @return self
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     *
     * @return self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     *
     * @return self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     *
     * @return self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param mixed $password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     *
     * @return self
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }


		public static function getFormLogin(){

			return [	
						"options" => [ "method"=>"POST", "action"=>"", "submit"=>"Se connecter", "enctype"=>"multipart/form-data" ],
						"struct" => [
							"login"=>["label"=> "", "type"=>"text", "id"=>"loginco", "placeholder"=>"Identifiant", "required"=>1, "msgerror"=>"login" ],

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

							"email"=>[ "label"=>"E-mail", "type"=>"text", "id"=>"email", "placeholder"=>"E-mail", "required"=>1, "msgerror"=>"email" ],

							"password1"=>[ "label"=>"Mot de passe", "type"=>"password", "id"=>"password1", "placeholder"=>"Mot de passe", "required"=>1, "msgerror"=>"password1" ],

							"password2"=>[ "label"=>"Confirmation mot de passe", "type"=>"password", "id"=>"password2", "placeholder"=>"Confirmation", "required"=>1, "msgerror"=>"password2" ]
						]
			];

		}

		public static function signUp($data){

			$user = new User();
			$user->setLogin($data['login']);
			$user->setFirstname($data['firstname']);
			$user->setLastname($data['lastname']);
			$user->setRole(3);
			$user->setEmail($data['email']);
			$user->setPassword($data['password2']);
			$user->setCreationDate(date('Y-m-d H:i:s'));
			$user->setStatus(1);
			$user->save();

		}



	
   
}	
