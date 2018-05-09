<?php

require 'core/phpmailer/src/Exception.php';
require 'core/phpmailer/src/PHPMailer.php';
require 'core/phpmailer/src/SMTP.php';


class Passwordrecovery extends Basesql{
	protected $id;
	protected $token;
	protected $date;
	protected $user_id;

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
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
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
    public function setDate($date)
    {
        $this->date = $date;

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


    public static function getFormNewPassword(){

       return [

          "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Se connecter", "enctype"=>"multipart/form-data", "submit-custom"=>"true" ],
          "struct" => [

           "login"=>["label"=> "", "type"=>"text", "id"=>"loginco", "placeholder"=>"Identifiant", "required"=>1, "msgerror"=>"login" ],

           "submit"=>[ "label"=>"Reinitialiser mon mot de passe", "type"=>"submit", "id"=>"connect", "placeholder"=>"", "required"=>0]

       ]
   ];

}
public static function sendResetPassword($data){

    if(User::loginExists($data['login'])){

        $user = new User();
        $userFound = $user->getData('user',["login"=>$data['login']])[0];

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'wesic.corporate@gmail.com';                 
            $mail->Password = 'wesic2018';           
            $mail->SMTPSecure = 'tls';                        
            $mail->Port = 587;

            $mail->setFrom('wesic.corporate@gmail.com', 'Wesic Inc.');
            $mail->addAddress($userFound['email'], ucfirst($userFound['firstname'])." ".strtoupper($userFound['lastname']));

            $mail->isHTML(true);
            $mail->Subject = 'Réinitialiser votre mot de passe';
            $message = file_get_contents('views/mail/passwordrecovery.tpl.php'); 
            $message = str_replace('%username%', ucfirst($userFound['firstname']), $message); 
            $message = str_replace('%urlreset%', "http://".DOMAIN."/".$userFound['login'], $message);
            $mail->Body = $message;

            
            if($mail->send()){
                echo "message envoyé !";
            }
            die();
        }
    }
}