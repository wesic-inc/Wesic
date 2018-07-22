<?php

class Media extends MediaRepository
{
    protected $id;
    protected $name;
    protected $path;
    protected $type;
    protected $caption;
    protected $alttext;
    protected $description;
    protected $url;
    protected $user_id;

    public function updateOnKey()
    {
        return $this->id;
    }
    public function getPkStr()
    {
        return "id";
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
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     *
     * @return self
     */
    public function setPath($path)
    {
        $this->path = $path;

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

    /**
     * @return mixed
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @param mixed $caption
     *
     * @return self
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAlttext()
    {
        return $this->alttext;
    }

    /**
     * @param mixed $alttext
     *
     * @return self
     */
    public function setAlttext($alttext)
    {
        $this->alttext = $alttext;

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
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

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
     * [getFormNewVideo description]
     * @return [type] [description]
     */
    public static function getFormNewVideo()
    {
        return [
                "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter la video", "enctype"=>"multipart/form-data", "submit-custom"=>"true"],
                "struct" => [
                    "name"=>[ "label"=>"Nom", "type"=>"text", "id"=>"name", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"media-name" ],
                    "description"=>[ "label"=>"Description", "type"=>"text", "id"=>"description", "placeholder"=>"Description", "required"=>0, "msgerror"=>"description" ],
                    "url-yt"=>[ "label"=>"Url", "type"=>"text", "id"=>"url", "placeholder"=>"Url de la vidéo", "required"=>0, "msgerror"=>"url-error" ],
                    "submit"=>[ "label"=>"Ajouter", "type"=>"submit", "id"=>"connect", "placeholder"=>"", "required"=>0]
                ]
        ];
    }

    /**
     * [getFormNewImage description]
     * @return [type] [description]
     */
    public static function getFormNewImage()
    {
        return [
                "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'image", "enctype"=>"multipart/form-data", "submit-custom"=>"true" ],
                "struct" => [
                    "name"=>[ "label"=>"Nom", "type"=>"text", "id"=>"name", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"media-name" ],
                    "description"=>[ "label"=>"Description", "type"=>"text", "id"=>"description", "placeholder"=>"Description", "msgerror"=>"description" ],
                    "caption"=>[ "label"=>"Légende", "type"=>"text", "id"=>"caption", "placeholder"=>"Légende", "msgerror"=>"légende non valide" ],
                    "alttext"=>[ "label"=>"Texte de substitution", "type"=>"text", "id"=>"alttext", "placeholder"=>"Texte de substitution", "msgerror"=>"alttext" ],
                    "image"=>[ "label"=>"Fichier image", "type"=>"file", "id"=>"imageToSave", "required"=>0, "msgerror"=>"file" ],
                    "submit"=>[ "label"=>"Ajouter", "type"=>"submit", "id"=>"connect", "placeholder"=>"", "required"=>0]
                ]
        ];
    }

    /**
     * [getFormNewMusic description]
     * @return [type] [description]
     */
    public static function getFormNewMusic()
    {
        return [
                "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter la musique", "enctype"=>"multipart/form-data", "submit-custom"=>"true" ],
                "struct" => [
                    "name"=>[ "label"=>"Nom", "type"=>"text", "id"=>"name", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"media-name" ],
                    "description"=>[ "label"=>"Description", "type"=>"text", "id"=>"description", "placeholder"=>"Description", "required"=>0, "msgerror"=>"description" ],
                    "caption"=>[ "label"=>"Légende", "type"=>"text", "id"=>"caption", "placeholder"=>"Légende", "required"=>0, "msgerror"=>"legende" ],
                    "music"=>[ "label"=>"Fichier audio", "type"=>"file", "id"=>"musicTosave", "required"=>0, "msgerror"=>"file" ],
                    "submit"=>[ "label"=>"Ajouter", "type"=>"submit", "id"=>"connect", "placeholder"=>"", "required"=>0]
                ]
        ];
    }

    /**
     * [getFormEditImage description]
     * @return [type] [description]
     */
    public static function getFormEditImage()
    {
        return [
                "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Modifier l'image", "enctype"=>"multipart/form-data", "submit-custom"=>"true" ],
                "struct" => [
                    "name"=>[ "label"=>"Nom", "type"=>"text", "id"=>"name", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"media-name" ],
                    "description"=>[ "label"=>"Description", "type"=>"text", "id"=>"description", "placeholder"=>"Description", "required"=>0, "msgerror"=>"description" ],
                    "caption"=>[ "label"=>"Légende", "type"=>"text", "id"=>"caption", "placeholder"=>"Légende", "required"=>0, "msgerror"=>"legende" ],
                    "alttext"=>[ "label"=>"Texte de substitution", "type"=>"text", "id"=>"alttext", "placeholder"=>"Texte de substitution", "required"=>0, "msgerror"=>"alttext" ],
                    "submit"=>[ "label"=>"Modifier", "type"=>"submit", "id"=>"connect", "placeholder"=>"", "required"=>0]
                ]
        ];
    }

    /**
     * [getFormEditVideo description]
     * @return [type] [description]
     */
    public static function getFormEditVideo()
    {
        return [
                "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Modifier la video", "enctype"=>"multipart/form-data", "submit-custom"=>"true"],
                "struct" => [
                    "name"=>[ "label"=>"Nom", "type"=>"text", "id"=>"name", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"media-name" ],
                    "description"=>[ "label"=>"Description", "type"=>"text", "id"=>"description", "placeholder"=>"Description", "required"=>0, "msgerror"=>"description" ],
                    "submit"=>[ "label"=>"Modifier", "type"=>"submit", "id"=>"connect", "placeholder"=>"", "required"=>0]
                ]
        ];
    }

    /**
     * [getFormEditMusic description]
     * @return [type] [description]
     */
    public static function getFormEditMusic()
    {
        return [
                "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Modifier la musique", "enctype"=>"multipart/form-data", "submit-custom"=>"true" ],
                "struct" => [
                    "name"=>[ "label"=>"Nom", "type"=>"text", "id"=>"name", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"media-name" ],
                    "description"=>[ "label"=>"Description", "type"=>"text", "id"=>"description", "placeholder"=>"Description", "required"=>0, "msgerror"=>"description" ],
                    "caption"=>[ "label"=>"Légende", "type"=>"text", "id"=>"caption", "placeholder"=>"Légende", "required"=>0, "msgerror"=>"legende" ],
                    "submit"=>[ "label"=>"Modifier", "type"=>"submit", "id"=>"connect", "placeholder"=>"", "required"=>0]
                ]
        ];
    }
}
