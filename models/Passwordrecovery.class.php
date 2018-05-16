<?php

require 'core/phpmailer/src/Exception.php';
require 'core/phpmailer/src/PHPMailer.php';
require 'core/phpmailer/src/SMTP.php';


class Passwordrecovery extends Basesql{
	protected $id;
	protected $token;
	protected $date;
    protected $user_id;
    protected $slug;
	protected $type;

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
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     *
     * @return self
     */
    public function setToken($token = null){
        if( $token ){
            $this->token = $token;
        }else{
            $this->token = substr(sha1("qzmldq2E2Eçqd".uniqid().substr(time(), 5).uniqid()."gdsfd"), 2, 10);
            $this->token .= "-".substr(sha1("qDàqzdklqZ1".uniqid().substr(time(), 5).uniqid()."gdsfd"), 2, 10);
            $this->token .= "-".substr(sha1("qlqdZMLD0é32".uniqid().substr(time(), 5).uniqid()."gdsfd"), 2, 10);
            $this->token .= "-".substr(sha1("DZQlzqkdml2034".uniqid().substr(time(), 5).uniqid()."gdsfd"), 2, 10);
        }
    }

    public function setTokenConfirmation($token = null){
        if( $token ){
            $this->token = $token;
        }else{
            $this->token = substr(sha1("qzmldq2E2Eçqd".uniqid().substr(time(), 5).uniqid()."gdsfd"), 2, 10);
            $this->token .= "-".substr(sha1("qDàqzdklqZ1".uniqid().substr(time(), 5).uniqid()."gdsfd"), 2, 10);
            $this->token .= "-".substr(sha1("qlqdZMLD0é32".uniqid().substr(time(), 5).uniqid()."gdsfd"), 2, 10);
            $this->token .= "-".substr(sha1("DZQlzqkdml2034".uniqid().substr(time(), 5).uniqid()."gdsfd"), 2, 10);
            $this->token .= "-".substr(sha1("DZQlzqkdml2034".uniqid().substr(time(), 5).uniqid()."gdsfd"), 2, 10);
            $this->token .= "-".substr(sha1("DZQlzqkdml2034".uniqid().substr(time(), 5).uniqid()."gdsfd"), 2, 10);
        }
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     *
     * @return self
     */
    public function setDate()
    {
        $this->date = date('Y-m-d H:i:s');

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     *
     * @return self
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     *
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }


    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public static function getFormNewPassword(){

       return [

          "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Se connecter", "enctype"=>"multipart/form-data", "submit-custom"=>"true" ],
          "struct" => [

           "login"=>["label"=> "", "type"=>"text", "id"=>"loginco", "placeholder"=>"Identifiant", "required"=>1, "msgerror"=>"login" ],

           "submit"=>[ "label"=>"Reinitialiser mon mot de passe", "type"=>"submit", "id"=>"connect", "placeholder"=>"", "required"=>0]

       ]
   ];

}
public static function sendResetPassword($login){

    if(User::loginExists($login)){



        $passwordrecovery = new Passwordrecovery();
        
        $user = new User();
        $userFound = $user->getData('user',["login"=>$login])[0];


        if($userFound['status'] == 1){
        
        $user->setId($userFound['id']);
        $user->cleanUserSlugPasswordRecovery();


        $passwordrecovery = new Passwordrecovery();
        $passwordrecovery->setToken();
        $passwordrecovery->setSlug($passwordrecovery->getToken());
        $passwordrecovery->setType(1);
        $passwordrecovery->setUserId($userFound['id']);

        $slug = new Slug();
        $slug->setSlug($passwordrecovery->getToken());
        $slug->setType(4);

        $slug->save();
        $passwordrecovery->save();



        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'wesic.corporate@gmail.com';                 
            $mail->Password = 'wesic2018';           
            $mail->SMTPSecure = 'tls';                        
            $mail->Port = 587;
            $mail->CharSet = "UTF-8";
            $mail->setFrom('wesic.corporate@gmail.com', 'Wesic Inc.');
            $mail->addAddress($userFound['email'], ucfirst($userFound['firstname'])." ".strtoupper($userFound['lastname']));

            $mail->isHTML(true);
            $mail->Subject = rand()." ".ucfirst($userFound['firstname']).', réinitialiser votre mot de passe';
            $message = file_get_contents('views/mail/passwordrecovery.tpl.php'); 
            $message = str_replace('%username%', ucfirst($userFound['firstname']), $message); 
            $message = str_replace('%urlreset%', "http://".DOMAIN."/".$passwordrecovery->getToken(), $message);
            $mail->Body = $message;

            
            $mail->send();
            return true;
        }else{
            return false;
        }
        }else{
            return false;
        }

    }


public static function confirmEmailNewUser($login){

    if(User::loginExists($login)){


        $passwordrecovery = new Passwordrecovery();
        
        $user = new User();
        $userFound = $user->getData('user',["login"=>$login])[0];

        
        $user->setId($userFound['id']);
        $user->cleanUserSlugPasswordRecovery();


        $passwordrecovery = new Passwordrecovery();
        $passwordrecovery->setTokenConfirmation();
        $passwordrecovery->setSlug($passwordrecovery->getToken());
        $passwordrecovery->setType(2);
        $passwordrecovery->setUserId($userFound['id']);

        $slug = new Slug();
        $slug->setSlug($passwordrecovery->getToken());
        $slug->setType(5);

        $slug->save();
        $passwordrecovery->save();



        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'wesic.corporate@gmail.com';                 
            $mail->Password = 'wesic2018';           
            $mail->SMTPSecure = 'tls';                        
            $mail->Port = 587;
            $mail->CharSet = "UTF-8";
            $mail->setFrom('wesic.corporate@gmail.com', 'Wesic Inc.');

            $mail->addAddress($userFound['email'], ucfirst($userFound['firstname'])." ".strtoupper($userFound['lastname']));

            $mail->isHTML(true);
            $mail->Subject = rand()." ".ucfirst($userFound['firstname']).', veuillez confirmer votre e-mail';
            $message = file_get_contents('views/mail/confirmationemail.tpl.php'); 
            $message = str_replace('%username%', ucfirst($userFound['firstname']), $message); 
            $message = str_replace('%urlreset%', "http://".DOMAIN."/".$passwordrecovery->getToken(), $message);
            $mail->Body = $message;

            
            $mail->send();
            return true;
        }else{
            return false;
        }
    }

 static public function confirmEmailNewsletter($email){
        
        if(User::emailExists($email)){


        $passwordrecovery = new Passwordrecovery();
        
        $user = new User();

        $qb = new QueryBuilder();

        $userFound = $qb
        ->select('*')
        ->from('user')
        ->addWhere('email = :email')
        ->setParameter('email',$email)
        ->fetchOne();

        
        $user->setId($userFound['id']);
        $user->cleanUserSlugPasswordRecovery();


        $passwordrecovery = new Passwordrecovery();
        $passwordrecovery->setTokenConfirmation();
        $passwordrecovery->setSlug($passwordrecovery->getToken());
        $passwordrecovery->setType(3);
        $passwordrecovery->setUserId($userFound['id']);

        $slug = new Slug();
        $slug->setSlug($passwordrecovery->getToken());
        $slug->setType(6);

        $slug->save();
        $passwordrecovery->save();



        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'wesic.corporate@gmail.com';                 
            $mail->Password = 'wesic2018';           
            $mail->SMTPSecure = 'tls';                        
            $mail->Port = 587;
            $mail->CharSet = "UTF-8";
            $mail->setFrom('wesic.corporate@gmail.com', 'Wesic Inc.');

            $mail->addAddress($userFound['email'], ucfirst($userFound['firstname'])." ".strtoupper($userFound['lastname']));

            $mail->isHTML(true);
            $mail->Subject = rand()." ".ucfirst($userFound['firstname']).', veuillez confirmer votre abonnemet à la newsletter';
            $message = file_get_contents('views/mail/confirmationemailnewsletter.tpl.php'); 
            $message = str_replace('%username%', ucfirst($userFound['firstname']), $message); 
            $message = str_replace('%urlreset%', "http://".DOMAIN."/".$passwordrecovery->getToken(), $message);
            $mail->Body = $message;

            
            $mail->send();
            return true;
        }else{
            return false;
        }
 }

}