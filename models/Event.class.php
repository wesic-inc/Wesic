<?php

class Event extends EventRepository
{
    protected $id;
    protected $name;
    protected $place;
    protected $externalurl;
    protected $description;
    protected $date;
    protected $featured;
    protected $user_id;

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
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param mixed $place
     *
     * @return self
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExternalurl()
    {
        return $this->externalurl;
    }

    /**
     * @param mixed $externalurl
     *
     * @return self
     */
    public function setExternalurl($externalurl)
    {
        $this->externalurl = $externalurl;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * @param mixed $image
     *
     * @return self
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

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
    public static function getFormNewEvent()
    {
        return [
          "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'utilisateur", "enctype"=>"multipart/form-data", "submit-custom"=>"true" ],
          "struct" => [

               "name"=>[ "label"=>"Titre de l'évenement", "type"=>"text", "id"=>"name", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"nameevent","helper"=>"Le nom de l'évenement qui sera afiché aux utilisateurs" ],

               "description"=>[ "label"=>"Description de l'évenement", "type"=>"textarea", "id"=>"email", "placeholder"=>"Description", "required"=>1, "msgerror"=>"email" ],
               
               "externalurl"=>[ "label"=>"Lien pour réserver", "type"=>"url", "id"=>"externalurl", "placeholder"=>"Lien de réservation", "required"=>1, "msgerror"=>"externalurl","helper"=>"Lien sur lequel les utilisateurs peuvent acheter un billet" ],

               "place"=>[ "label"=>"Lieu de l'évenement", "type"=>"text", "id"=>"place", "placeholder"=>"Lieu de l'évenement", "required"=>1, "msgerror"=>"placeevent" ],

               "datepicker-custom"=>[ "label"=>"Date de l'évenement", "type"=>"custom-datepicker", "id"=>"dateevent", "placeholder"=>"Date", "required"=>1, "msgerror"=>"date"],


               "save"=>[ "label"=>"Ajouter l'évenement", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0]

           ]
       ];
    }
    public static function getFormEditEvent()
    {
        return [
            "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'article", "enctype"=>"multipart/form-data", "groups"=> "false", "submit-custom"=>"true" ],
            "groups" => [
                "name" => ["name"],
                "description" => ["description"],
                "externalurl" => ["externalurl"],
                "publish" => ["datepicker-custom","place","save"],
                ],
            "struct" => [

                "name"=>[ "label"=>"Titre de l'évenement", "type"=>"text", "id"=>"name", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"nameevent","helper"=>"Le nom de l'évenement qui sera afiché aux utilisateurs" ],

                "description"=>[ "label"=>"Description de l'évenement", "type"=>"textarea", "id"=>"email", "placeholder"=>"Description", "required"=>1, "msgerror"=>"email" ],

                "externalurl"=>[ "label"=>"Lien pour réserver", "type"=>"url", "id"=>"externalurl", "placeholder"=>"Lien de réservation", "required"=>1, "msgerror"=>"externalurl","helper"=>"Lien sur lequel les utilisateurs peuvent acheter un billet" ],

                "place"=>[ "label"=>"Lieu de l'évenement", "type"=>"text", "id"=>"place", "placeholder"=>"Lieu de l'évenement", "required"=>1, "msgerror"=>"placeevent" ],

                "datepicker-custom"=>[ "label"=>"Date de l'évenement", "type"=>"custom-datepicker", "id"=>"dateevent", "placeholder"=>"Date", "required"=>1, "msgerror"=>"date"],


                "save"=>[ "label"=>"Mettre à jour l'évenement", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0]

                ]
        ];
    }
}
