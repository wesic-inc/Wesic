<?php

class Category extends CategoryRepository
{
    protected $id;
    protected $label;
    protected $type;
    protected $slug;

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


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = strtolower(trim($slug));
    }

    public static function getFormNewCategory()
    {
        return [
      "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'utilisateur", "enctype"=>"multipart/form-data", "submit-custom"=>true ],
      "struct" => [

       "label"=>[ "label"=>"Label", "type"=>"text", "id"=>"label", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"label" ],

       "slug"=>[ "label"=>"Permalien", "type"=>"text", "id"=>"slug", "placeholder"=>"Lien", "required"=>1, "msgerror"=>"slug","checkexist"=>"true", "helper"=>"Page des archives sur le site"],

       "save"=>[ "label"=>"Sauvegarder", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],

            ]
        ];
    }

    public static function getFormEditCategory()
    {
        return [
        "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'utilisateur", "enctype"=>"multipart/form-data", "submit-custom"=>true ],
        "struct" => [

            "label"=>[ "label"=>"Label", "type"=>"text", "id"=>"label", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"label" ],

            "slug"=>[ "label"=>"Permalien", "type"=>"text", "id"=>"slug", "placeholder"=>"Lien", "required"=>1, "msgerror"=>"slug","checkexist"=>"true", "helper"=>"Page des archives sur le site", "checkexist"=>"true"],

            "save"=>[ "label"=>"Sauvegarder", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],

        ]
    ];
    }
    public static function getFormNewTag()
    {
        return [
      "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'utilisateur", "enctype"=>"multipart/form-data", "submit-custom"=>true ],
      "struct" => [

       "label"=>[ "label"=>"Label", "type"=>"text", "id"=>"label", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"label" ],

       "save"=>[ "label"=>"Sauvegarder", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],

   ]
];
    }

    public static function getFormEditTag()
    {
        return [
        "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'utilisateur", "enctype"=>"multipart/form-data", "submit-custom"=>true ],
        "struct" => [

            "label"=>[ "label"=>"Label", "type"=>"text", "id"=>"label", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"label" ],

            "save"=>[ "label"=>"Sauvegarder", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],

        ]
    ];
    }
}
