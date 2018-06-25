<?php

class PasswordRecovery extends PasswordRecoRepository
{
    protected $id;
    protected $token;
    protected $date;
    protected $user_id;
    protected $slug;
    protected $type;

    public function updateOnKey(){
        return $this->id;
    }
    public function getPkStr(){
        return "id";
    }
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
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     *
     * @return self
     */
    public function setToken($token = null)
    {
        if ($token) {
            $this->token = $token;
        } else {
            $this->token = substr(sha1("qzmldq2E2Eçqd".uniqid().substr(time(), 5).uniqid()."gdsfd"), 2, 10);
            $this->token .= "-".substr(sha1("qDàqzdklqZ1".uniqid().substr(time(), 5).uniqid()."gdsfd"), 2, 10);
            $this->token .= "-".substr(sha1("qlqdZMLD0é32".uniqid().substr(time(), 5).uniqid()."gdsfd"), 2, 10);
            $this->token .= "-".substr(sha1("DZQlzqkdml2034".uniqid().substr(time(), 5).uniqid()."gdsfd"), 2, 10);
        }
    }

    public function setTokenConfirmation($token = null)
    {
        if ($token) {
            $this->token = $token;
        } else {
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

    public static function getFormNewPassword()
    {
        return [

          "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Se connecter", "enctype"=>"multipart/form-data", "submit-custom"=>"true" ],
          "struct" => [

           "login"=>["label"=> "", "type"=>"text", "id"=>"loginco", "placeholder"=>"Identifiant", "required"=>1, "msgerror"=>"login" ],

           "submit"=>[ "label"=>"Reinitialiser mon mot de passe", "type"=>"submit", "id"=>"connect", "placeholder"=>"", "required"=>0]

       ]
   ];
    }
}
