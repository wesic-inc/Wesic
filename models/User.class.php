<?php

class User extends Basesql
{
  protected $id = null;
  protected $login;
  protected $firstname;
  protected $lastname;		
  protected $role;
  protected $email;
  protected $password;
  protected $creationDate;
  protected $status = 0;
  protected $token;

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
        return ucfirst($this->login);
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
        $this->firstname = ucfirst(strtolower(trim($firstname)));   

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
        $this->lastname = strtoupper(trim($lastname));

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
        $this->email = strtolower(trim($email));

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
    public function setCreationDate($creationDate = null)
    {   
        if( $creationDate ){
            $this->creationDate = $creationDate;
        }else {
            $this->creationDate = date("Y-m-d H:i:s");
        }
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

    public function setToken($token = null){
        if( $token ){
            $this->token = $token;
        }else if(!empty($this->email)){
            $this->token = substr(sha1("GDQgfds4354".$this->email.substr(time(), 5).uniqid()."gdsfd"), 2, 10);
        }else{
            Route::redirect('login');
        }
    }

    public function getToken(){
        return $this->token;
    }


    public static function getFormLogin(){

     return [	
      "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Se connecter", "enctype"=>"multipart/form-data", "submit-custom"=>"true" ],
      "struct" => [
         "login"=>["label"=> "", "type"=>"text", "id"=>"loginco", "placeholder"=>"Identifiant", "required"=>1, "msgerror"=>"login" ],

         "password"=>["label"=> "", "type"=>"password", "id"=>"passwordco", "placeholder"=>"Mot de passe", "required"=>1, "msgerror"=>"password" ],

         "submit"=>[ "label"=>"Connexion", "type"=>"submit", "id"=>"connect", "placeholder"=>"", "required"=>0]

     ]
 ];

}

public static function getFormModifyPassword(){

 return [   
  "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Modifier mon mot de passe", "enctype"=>"multipart/form-data", "submit-custom"=>"true" ],
  "struct" => [

     "password"=>[ "label"=>"Mot de passe", "type"=>"password", "id"=>"password", "placeholder"=>"Mot de passe", "required"=>1, "msgerror"=>"password" ],

     "passwordconfirm"=>[ "label"=>"Confirmation mot de passe", "type"=>"password", "id"=>"passwordconfirm", "placeholder"=>"Confirmation", "required"=>1, "msgerror"=>"passwordconfirm", "confirm"=>"password" ],

     "submit"=>[ "label"=>"Modifier", "type"=>"submit", "id"=>"connect", "placeholder"=>"", "required"=>0]
 ]

];

}

public static function getFormNewUser(){

    return [	
      "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'utilisateur", "enctype"=>"multipart/form-data", "submit-custom"=>"true" ],
      "struct" => [

         "login"=>[ "label"=>"Identifiant", "type"=>"text", "id"=>"login", "placeholder"=>"Identifiant", "required"=>1, "msgerror"=>"newlogin" ],

         "firstname"=>[ "label"=>"Prénom", "type"=>"text", "id"=>"firstname", "placeholder"=>"Prénom", "required"=>1, "msgerror"=>"firstname" ],

         "lastname"=>[ "label"=>"Nom", "type"=>"text", "id"=>"lastname", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"lastname" ],

         "email"=>[ "label"=>"E-mail", "type"=>"text", "id"=>"email", "placeholder"=>"E-mail", "required"=>1, "msgerror"=>"email" ],

         "password1"=>[ "label"=>"Mot de passe", "type"=>"password", "id"=>"password1", "placeholder"=>"Mot de passe", "required"=>1, "msgerror"=>"password1" ],

         "password2"=>[ "label"=>"Confirmation mot de passe", "type"=>"password", "id"=>"password2", "placeholder"=>"Confirmation", "required"=>1, "msgerror"=>"password2" ],

         "role"=>[ "label"=>"Rôle", "type"=>"select", "id"=>"role", "placeholder"=>"Confirmation", "required"=>1, "msgerror"=>"role", "choices"=>['1'=>'Utilisateur','2'=>'Community Manager','3'=>'Modérateur','4'=>'Administrateur'] ],

         "save"=>[ "label"=>"Ajouter l'utilisateur", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0]


     ]
 ];

}

public static function getFormEditUser(){

    return [    
        "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'utilisateur", "enctype"=>"multipart/form-data", "submit-custom"=>"true", "refill" => "true", "groups"=>"true" ],
        
        "groups" => [   "edit-user-main" => ["login","firstname","lastname","email","role","status", "cancel","save"],  
                            "edit-user-actions" => ["newpasswordlink","disableuser","banuser","deleteuser1","deleteuser2"] 
                ],

        "struct" => [

            "login"=>[ "label"=>"Identifiant", "type"=>"text", "id"=>"login", "placeholder"=>"Identifiant", "required"=>1, "msgerror"=>"newlogin" ],

            "firstname"=>[ "label"=>"Prénom", "type"=>"text", "id"=>"firstname", "placeholder"=>"Prénom", "required"=>1, "msgerror"=>"firstname" ],

            "lastname"=>[ "label"=>"Nom", "type"=>"text", "id"=>"lastname", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"lastname" ],

            "email"=>[ "label"=>"E-mail", "type"=>"text", "id"=>"email", "placeholder"=>"E-mail", "required"=>1, "msgerror"=>"email" ],

            "role"=>[ "label"=>"Rôle", "type"=>"select", "id"=>"role", "placeholder"=>"Confirmation", "required"=>1, "msgerror"=>"role", "choices"=>['1'=>'Utilisateur','2'=>'Community Manager','3'=>'Modérateur','4'=>'Administrateur'] ],

            "status"=>[ "label"=>"Status", "type"=>"select", "id"=>"status", "placeholder"=>"Confirmation", "required"=>1, "msgerror"=>"role", "choices"=>['1'=>'Actif','3'=>'Inactif','4'=>'Banni','5'=>'Supprimé' ]],

            "newpasswordlink"=>[ "label"=>"Réinitialiser le mot de passe", "type"=>"link", "id"=>"newpassword", "placeholder"=>"", "required"=>0, "class"=>"btn btn-sm btn-success"],

            "deleteuser1"=>[ "label"=>"Supprimer l'utilisateur", "type"=>"link", "id"=>"deleteuser1", "placeholder"=>"", "required"=>0, "class"=>"btn btn-sm btn-danger"],
 
            "deleteuser2"=>[ "label"=>"Supprimer l'utilisateur définitivement", "type"=>"link", "id"=>"deleteuser2", "placeholder"=>"", "required"=>0, "class"=>"btn btn-sm"],


            "cancel"=>[ "label"=>"Annuler", "type"=>"link", "id"=>"save", "placeholder"=>"", "required"=>0, "class"=>"btn btn-sm btn-alt", "link"=>"/admin/utilisateurs"],

            "save"=>[ "label"=>"Modifier l'utilisateur", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],




        ]
    ];

}
public static function getFormViewUser(){

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

public static function getNewsletterSignUpForm(){
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

public static function signUp($data){

    if( self::emailExists($data['email']) || self::loginExists($data['login'])){
        return false;
    }
    else{

        $user = new User();
        $user->setLogin($data['login']);
        $user->setFirstname($data['firstname']);
        $user->setLastname($data['lastname']);
        $user->setRole($data['role']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password2']);
        $user->setCreationDate(date('Y-m-d H:i:s'));
        $user->setStatus(2);
        $user->setToken();
        $user->save();


        Passwordrecovery::confirmEmailNewUser($data['login']);


        return true;

    }
}

public static function newUser($data){

    if( self::emailExists($data['email']) || self::loginExists($data['login'])){
        return false;
    }
    else{

        $user = new User();
        $user->setLogin($data['login']);
        $user->setFirstname($data['firstname']);
        $user->setLastname($data['lastname']);
        $user->setRole($data['role']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password2']);
        $user->setCreationDate(date('Y-m-d H:i:s'));
        $user->setStatus(1);
        $user->setToken();
        $user->save();
        

        return true;

    }
}

public static function addUser($data){

    if( self::emailExists($data['email']) || self::loginExists($data['login'])){
        return false;
    }
    else{

        $user = new User();
        $user->setLogin($data['login']);
        $user->setFirstname($data['firstname']);
        $user->setLastname($data['lastname']);
        $user->setRole($data['role']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password2']);
        $user->setCreationDate(date('Y-m-d H:i:s'));
        $user->setStatus(1);
        $user->setToken();

        View::setFlash("Succès !","L'utilisateur <i>".ucfirst($data['login'])."</i> a bien été ajouté","success");


        $user->save();
        

        return true;

    }
} 



public static function editUser($data){

    
    if( self::emailExists($data['email']) && self::loginExists($data['login'])){

        $user = new User();
        $userData = $user->getData('user',['login'=>$data['login']])[0];

        $user->setId($userData['id']);

        $user->setStatus($data['status']);
        $user->setEmail($data['email']);
        $user->setLogin($data['login']);
        $user->setFirstname($data['firstname']);
        $user->setLastname($data['lastname']);
        $user->setRole($data['role']);

        $user->save();
        
        View::setFlash("Succès !","L'utilisateur <i>".ucfirst($data['login'])."</i> a bien été modifié","success");

        return true;

    }else{
        return false;
    }

}


public static function emailExists($email){

    $user = new User();
    $users = $user->getData("user",['email' => $email]);

    return !empty($users);

}

public static function loginExists($login){

    $user = new User();

    $users = $user->getData('user',["login"=>$login]);

    return !empty($users);

}

public static function modifyPassword($data){

    $passwordrecovery = new Passwordrecovery();
    $result = $passwordrecovery->getData('passwordrecovery',["token"=>$data['token']])[0];
    $user = new User();

    $user->setId($result['user_id']);
    $user->setPassword($data['passwordconfirm']);
    $user->setStatus(1);
    $user->save();
    $user->cleanUserSlugPasswordRecovery();

    
    return true;
}

public static function setUserStatus($id,$status){

    if($status == 1 || $status == 2 || $status == 3 || $status == 4 || $status == 5){

    $user = new User();
    $user->setStatus($status);
    $user->setId($id);
    $user->save();
    return true;
    
    }else{
        return false;
    }
}

public static function signUpNewsletter($data){

    if( self::emailExists($data['email']) || self::loginExists($data['email'])){
        return false;
    }else{

    $user = new User();

    $user->setFirstname($data['name']);
    $user->setEmail($data['email']);
    $user->setLogin($data['email']);
    $user->setRole(5);
    $user->setCreationDate();
    $user->setStatus('2');
    $user->save();

    Passwordrecovery::confirmEmailNewsletter($data['email']);
    return true;
    
    }
}



}	
