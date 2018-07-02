<?php

class Comment extends CommentRepository
{
    protected $id;
    protected $body;
    protected $created_at;
    protected $status;
    protected $post_id;
    protected $user_id;
    protected $email;
    protected $name;
    protected $type;

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
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     *
     * @return self
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     *
     * @return self
     */
    public function setCreatedAt($created_at = "")
    {
        if (empty($created_at)) {
            $this->created_at = date('Y-m-d H:i:s');
        } else {
            $this->created_at = $created_at;
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

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * @param mixed $post_id
     *
     * @return self
     */
    public function setPostId($post_id)
    {
        $this->post_id = $post_id;

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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public static function getFormNewConnectedCommment()
    {
        return [
            "options" => [ "method"=>"POST", "action"=> "", "submit"=>"Ajouter un commentaire","submit-custom"=>true, "enctype"=>"multipart/form-data" ],
            "struct" => [

                "body"=>[ "label"=>"Contenu", "type"=>"textarea", "id"=>"body", "placeholder"=>"Commentaire", "required"=>1, "msgerror"=>"body" ],
                "save"=>[ "label"=>"Poster", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],

            ]
        ];
    }

    public static function getFormNewCommment()
    {
        return [
            "options" => [ "method"=>"POST", "action"=> "", "submit"=>"Ajouter un commentaire","submit-custom"=>true, "enctype"=>"multipart/form-data" ],
            "struct" => [

                "email"=>[ "label"=>"Votre e-mail", "type"=>"text", "id"=>"email", "placeholder"=>"Email", "required"=>1, "msgerror"=>"email" ],
                "name"=>[ "label"=>"Votre nom", "type"=>"text", "id"=>"name", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"name" ],
                "body"=>[ "label"=>"Contenu", "type"=>"textarea", "id"=>"body", "placeholder"=>"Commentaire", "required"=>1, "msgerror"=>"body" ],
                "postid"=>[ "type"=>"hidden", "id"=>"postid","msgerror"=>"postid" ],
                "save"=>[ "label"=>"Poster", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],
            ]
        ];
    }
}
