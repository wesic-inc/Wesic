<?php

class User extends UserRepository
{
    protected $id = null;
    protected $login;
    protected $firstname;
    protected $lastname;
    protected $role;
    protected $email;
    protected $password;
    protected $created_at;
    protected $status = 1;
    protected $token;

    public function updateOnKey()
    {
        return $this->id;
    }
    public function getPkStr()
    {
        return "id";
    }
    public function __construct()
    {
        parent::__construct();
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getLogin()
    {
        return ucfirst($this->login);
    }


    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }


    public function setFirstname($firstname)
    {
        $this->firstname = ucfirst(strtolower(trim($firstname)));

        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        if ($created_at) {
            $this->created_at = $created_at;
        } else {
            $this->created_at = date("Y-m-d H:i:s");
        }
        return $this;
    }

    public function setLastname($lastname)
    {
        $this->lastname = strtoupper(trim($lastname));

        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }


    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = strtolower(trim($email));

        return $this;
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }



    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function setToken($token = null)
    {   
        
        if ($token) {
            $this->token = $token;
        } elseif (!empty($this->email)) {
            $this->token = substr(sha1("GDQgfds4354".$this->email.substr(time(), 5).uniqid()."gdsfd"), 2, 10);
        } else {
            Route::redirect('login');
        }
    }

    public function getToken()
    {
        return $this->token;
    }


    public static function getFormLogin()
    {
        return [
          "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Se connecter", "enctype"=>"multipart/form-data", "submit-custom"=>"true" ],
          "struct" => [
             "login"=>["label"=> "", "type"=>"text", "id"=>"loginco", "placeholder"=>"Identifiant", "required"=>1, "msgerror"=>"login" ],

             "password"=>["label"=> "", "type"=>"password", "id"=>"passwordco", "placeholder"=>"Mot de passe", "required"=>1, "msgerror"=>"password" ],

             "submit"=>[ "label"=>"Connexion", "type"=>"submit", "id"=>"connect", "placeholder"=>"", "required"=>0]

         ]
     ];
 }

 public static function getFormModifyPassword()
 {
    return [
      "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Modifier mon mot de passe", "enctype"=>"multipart/form-data", "submit-custom"=>"true" ],
      "struct" => [

         "password"=>[ "label"=>"Mot de passe", "type"=>"password", "id"=>"password", "placeholder"=>"Mot de passe", "required"=>1, "msgerror"=>"password" ],

         "passwordconfirm"=>[ "label"=>"Confirmation mot de passe", "type"=>"password", "id"=>"passwordconfirm", "placeholder"=>"Confirmation", "required"=>1, "msgerror"=>"passwordconfirm", "confirm"=>"password" ],

         "submit"=>[ "label"=>"Modifier", "type"=>"submit", "id"=>"connect", "placeholder"=>"", "required"=>0]
     ]

 ];
}

public static function getFormNewUser()
{
    return [
      "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'utilisateur", "enctype"=>"multipart/form-data", "submit-custom"=>"true" ],
      "struct" => [

         "login"=>[ "label"=>"Identifiant", "type"=>"text", "id"=>"login", "placeholder"=>"Identifiant", "required"=>1, "msgerror"=>"newlogin","helper"=>"Votre nom d'utilisateur, il permet de se connecter" ],

         "firstname"=>[ "label"=>"Prénom", "type"=>"text", "id"=>"firstname", "placeholder"=>"Prénom", "required"=>1, "msgerror"=>"firstname" ],

         "lastname"=>[ "label"=>"Nom", "type"=>"text", "id"=>"lastname", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"lastname" ],

         "email"=>[ "label"=>"E-mail", "type"=>"text", "id"=>"email", "placeholder"=>"E-mail", "required"=>1, "msgerror"=>"email" ],

         "password1"=>[ "label"=>"Mot de passe", "type"=>"password", "id"=>"password1", "placeholder"=>"Mot de passe", "required"=>1, "msgerror"=>"password1" ],

         "password2"=>[ "label"=>"Confirmation mot de passe", "type"=>"password", "id"=>"password2", "placeholder"=>"Confirmation", "required"=>1, "msgerror"=>"password2","confirm"=>"password1" ],

         "role"=>[ "label"=>"Rôle", "type"=>"select", "id"=>"role", "placeholder"=>"Confirmation", "required"=>1, "msgerror"=>"role", "choices"=>['1'=>'Utilisateur','2'=>'Community Manager','3'=>'Modérateur','4'=>'Administrateur'] ],

         "save"=>[ "label"=>"Ajouter l'utilisateur", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0]


     ]
 ];
}
public static function getFormSignUp()
{
    return [
      "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'utilisateur", "enctype"=>"multipart/form-data", "submit-custom"=>"true" ],
      "struct" => [

         "login"=>[ "label"=>"Identifiant", "type"=>"text", "id"=>"login", "placeholder"=>"Identifiant", "required"=>1, "msgerror"=>"newlogin","helper"=>"Votre nom d'utilisateur, il permet de se connecter" ],

         "firstname"=>[ "label"=>"Prénom", "type"=>"text", "id"=>"firstname", "placeholder"=>"Prénom", "required"=>1, "msgerror"=>"firstname" ],

         "lastname"=>[ "label"=>"Nom", "type"=>"text", "id"=>"lastname", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"lastname" ],

         "email"=>[ "label"=>"E-mail", "type"=>"text", "id"=>"email", "placeholder"=>"E-mail", "required"=>1, "msgerror"=>"email" ],

         "password1"=>[ "label"=>"Mot de passe", "type"=>"password", "id"=>"password1", "placeholder"=>"Mot de passe", "required"=>1, "msgerror"=>"password1" ],

         "password2"=>[ "label"=>"Confirmation mot de passe", "type"=>"password", "id"=>"password2", "placeholder"=>"Confirmation", "required"=>1, "msgerror"=>"password2","confirm"=>"password1" ],

         "save"=>[ "label"=>"Ajouter l'utilisateur", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0]


     ]
 ];
}

public static function getFormEditUser()
{
    return [
        "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'utilisateur", "enctype"=>"multipart/form-data", "submit-custom"=>"true", "refill" => "true", "groups"=>"true" ],
        
        "groups" => [   "edit-user-main" => ["login","firstname","lastname","email","role","status", "cancel","save"],
        "edit-user-actions" => ["newpasswordlink","deleteuser1","deleteuser2"]
    ],

    "struct" => [

        "login"=>[ "label"=>"Identifiant", "type"=>"text", "id"=>"login", "placeholder"=>"Identifiant", "required"=>1, "msgerror"=>"newlogin" ],

        "firstname"=>[ "label"=>"Prénom", "type"=>"text", "id"=>"firstname", "placeholder"=>"Prénom", "required"=>1, "msgerror"=>"firstname" ],

        "lastname"=>[ "label"=>"Nom", "type"=>"text", "id"=>"lastname", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"lastname" ],

        "email"=>[ "label"=>"E-mail", "type"=>"text", "id"=>"email", "placeholder"=>"E-mail", "required"=>1, "msgerror"=>"email" ],

        "role"=>[ "label"=>"Rôle", "type"=>"select", "id"=>"role", "placeholder"=>"Confirmation", "required"=>1, "msgerror"=>"role", "choices"=>['1'=>'Utilisateur','2'=>'Community Manager','3'=>'Modérateur','4'=>'Administrateur'] ],

        "status"=>[ "label"=>"Status", "type"=>"select", "id"=>"status", "placeholder"=>"Confirmation", "required"=>1, "msgerror"=>"status", "choices"=>['1'=>'Actif','3'=>'Inactif','4'=>'Banni','5'=>'Supprimé' ]],

        "newpasswordlink"=>[ "label"=>"Réinitialiser le mot de passe", "type"=>"link", "id"=>"newpassword", "placeholder"=>"", "class"=>"btn btn-sm btn-success"],

        "deleteuser1"=>[ "label"=>"Supprimer l'utilisateur", "type"=>"link", "id"=>"deleteuser1", "placeholder"=>"", "class"=>"btn btn-sm btn-danger"],

        "deleteuser2"=>[ "label"=>"Supprimer l'utilisateur définitivement", "type"=>"link", "id"=>"deleteuser2", "placeholder"=>"", "class"=>"btn btn-sm"],

        "cancel"=>[ "label"=>"Annuler", "type"=>"link", "id"=>"save", "placeholder"=>"","class"=>"btn btn-sm btn-alt", "link"=>"/admin/utilisateurs"],

        "save"=>[ "label"=>"Modifier l'utilisateur", "type"=>"submit", "id"=>"save", "placeholder"=>""],




    ]
];
}
public static function getFormViewUser()
{
    return [
        "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'utilisateur", "enctype"=>"multipart/form-data", "submit-custom"=>"true", "refill" => "true"],
        "struct" => [

            "login"=>[ "label"=>"Identifiant", "type"=>"text", "id"=>"login", "placeholder"=>"Identifiant", "required"=>1, "msgerror"=>"newlogin", "disabled"=>1 ],

            "firstname"=>[ "label"=>"Prénom", "type"=>"text", "id"=>"firstname", "placeholder"=>"Prénom", "required"=>1, "msgerror"=>"firstname", "disabled"=>1 ],

            "lastname"=>[ "label"=>"Nom", "type"=>"text", "id"=>"lastname", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"lastname", "disabled"=>1 ],

            "email"=>[ "label"=>"E-mail", "type"=>"text", "id"=>"email", "placeholder"=>"E-mail", "required"=>1, "msgerror"=>"email", "disabled"=>1 ],

            "status"=>[ "label"=>"Status", "type"=>"select", "id"=>"role", "placeholder"=>"Confirmation", "required"=>1, "msgerror"=>"status", "choices"=>['1'=>'Actif','2'=>'En attente de confirmation e-mail','3'=>'Inactif','4'=>'Banni','5'=>'Supprimé'], "disabled"=>1 ],

            "role"=>[ "label"=>"Rôle", "type"=>"select", "id"=>"role", "placeholder"=>"Confirmation", "required"=>1, "msgerror"=>"role", "choices"=>['1'=>'Utilisateur','2'=>'Community Manager','3'=>'Modérateur','4'=>'Administrateur'], "disabled"=>1 ],

            "editlink"=>[ "label"=>"Modifier l'utilisateur", "type"=>"link", "id"=>"save", "placeholder"=>"", "required"=>0, "class"=>"btn btn-sm btn-alt"],

        ]
    ];
}

public static function getNewsletterSignUpForm()
{
    return [
        "options" => [ "method"=>"POST", "action"=>"", "submit"=>"S'inscrire", "enctype"=>"multipart/form-data", "submit-custom"=>"true", "refill" => "true"],
        "struct" => [
            "name"=> [ "label"=> "Votre nom", "type"=>"text", "id"=>"name", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"name"],
            "email"=>[ "label"=>"Votre e-mail", "type"=>"email", "id"=>"email", "placeholder"=>"Email", "required"=>1, "msgerror"=>"email-newsletter", "checkexist"=>true],
            "captcha"=>[ "label"=>"Captcha", "type"=>"captcha", "id"=>"captcha", "placeholder"=>"Captcha", "required"=>1, "msgerror"=>"captcha"],
            "signup"=>[ "label"=>"S'inscrire", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],
        ]
    ];
}
}
