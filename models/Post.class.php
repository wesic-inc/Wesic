<?php 
class Post extends PostRepository
{
    protected $id;
    protected $title;
    protected $type;
    protected $slug;
    protected $content;
    protected $excerpt;
    protected $featured;
    protected $description;
    protected $created_at;
    protected $published_at;
    protected $status;
    protected $visibility;
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
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = ucfirst(strtolower(trim($title)));
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
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug_id
     *
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = strtolower(trim($slug));
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = html_entity_decode($content);
    }

    /**
     * @return mixed
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * @param mixed $excerpt
     *
     * @return self
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;
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
        if (!empty($created_at)) {
            $this->created_at = $created_at;
        } else {
            $this->created_at = date("Y-m-d H:i:s");
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPublishedAt()
    {
        return $this->published_at;
    }

    /**
     * @param mixed $published_at
     *
     * @return self
     */
    public function setPublishedAt($published_at)
    {
        if ($published_at) {
            $this->published_at = $published_at;
        } else {
            $this->published_at = date("Y-m-d H:i:s");
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
    }

    /**
     * @return mixed
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @param mixed $visibility
     *
     * @return self
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
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
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     *
     * @return self
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    public static function getFormNewArticle()
    {
        return [
            "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'article", "enctype"=>"multipart/form-data", "groups"=> "false", "submit-custom"=>"true" ],
            "groups" => [   "title" => ["title"],
            "content" => ["wesic-wysiwyg"],
            "excerpt" => ["excerpt"],
            "description"=>["description"],
            "publish" => ["slug","datepicker-custom","visibility","draft","save"],
            "category"=>["category"],
            "tags"=>["tags"],
            "featured"=>["featured"],
        ],
        "struct" => [

           "title"=>[ "label"=>"", "type"=>"text", "id"=>"title", "placeholder"=>"Titre de l'article", "required"=>1, "msgerror"=>"title"],

           "wesic-wysiwyg"=>[ "label"=>"", "type"=>"texteditor", "id"=>"content", "placeholder"=>"Contenu", "required"=>1, "msgerror"=>"content"],

           "excerpt"=>[ "label"=>"", "type"=>"textarea", "id"=>"excerpt", "placeholder"=>"Résumé de l'article", "required"=>0, "msgerror"=>"excerpt", "helper"=>"L'extrait de l'article sur votre site"],

           "description"=>[ "label"=>"", "type"=>"textarea", "id"=>"description", "placeholder"=>"Desc", "required"=>0, "msgerror"=>"description", "helper"=>"La description de votre article pour l'indexation des moteurs de recherche"],


           "slug"=>[ "label"=>"Permalien", "type"=>"text", "id"=>"slug", "placeholder"=>"Lien", "required"=>1, "msgerror"=>"slug","checkexist"=>"true", "helper"=>"Le lien de l'article sur le site"],

           "datepicker-custom"=>[ "label"=>"Date de publication", "type"=>"custom-datepicker", "id"=>"datepublied", "placeholder"=>"Date", "required"=>1, "msgerror"=>"date"],

           "visibility"=>[ "label"=>"Visibilité", "type"=>"select", "id"=>"visibility", "placeholder"=>"visibility", "required"=>1, "msgerror"=>"visibility", "choices"=>['1'=>'Public','2'=>'Privé','3'=>'Auteur uniquement']],

           "category"=>[ "label"=>"La catégorie de votre article", "type"=>"select", "id"=>"category", "placeholder"=>"Catégoroe", "required"=>0, "msgerror"=>"category", "choices"=>'category'],

           "tags"=>[ "label"=>"", "type"=>"tag", "id"=>"tags-input", "placeholder"=>"Tags de l'article","msgerror"=>"tags","helper"=>"Tapez votre tag, et appuyer sur entrée pour l'ajouter à la liste."],

           "draft"=>[ "label"=>"Brouillon", "type"=>"submit", "id"=>"draft", "placeholder"=>"", "required"=>0, "button" => "btn-alt"],

           "featured"=>[ "label"=>"Featured", "type"=>"featuredimg", "id"=>"featured", "placeholder"=>"", "required"=>0],

           "save"=>[ "label"=>"Publier", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],


       ]
   ];
    }
    public static function getFormEditArticle()
    {
        return [
        "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'article", "enctype"=>"multipart/form-data", "groups"=> "false", "submit-custom"=>"true" ],
        "groups" => [   "title" => ["title"],
        "content" => ["wesic-wysiwyg"],
        "excerpt" => ["excerpt"],
        "description"=>["description"],
        "publish" => ["slug","datepicker-custom","visibility","draft","save"],
        "category"=>["category"],
        "tags"=>["tags"],
        "featured"=>["featured"]
    ],
    "struct" => [

       "title"=>[ "label"=>"", "type"=>"text", "id"=>"title", "placeholder"=>"Titre de l'article", "required"=>1, "msgerror"=>"title"],

       "wesic-wysiwyg"=>[ "label"=>"", "type"=>"texteditor", "id"=>"content", "placeholder"=>"Contenu", "required"=>1, "msgerror"=>"content"],

       "excerpt"=>[ "label"=>"", "type"=>"textarea", "id"=>"excerpt", "placeholder"=>"Résumé de l'article", "msgerror"=>"excerpt", "helper"=>"L'extrait de l'article sur votre site"],

       "description"=>[ "label"=>"", "type"=>"textarea", "id"=>"description", "placeholder"=>"Desc", "msgerror"=>"description", "helper"=>"La description de votre article pour l'indexation des moteurs de recherche"],


       "slug"=>[ "label"=>"Permalien", "type"=>"text", "id"=>"slug", "placeholder"=>"Lien", "required"=>1, "msgerror"=>"slug", "helper"=>"Le lien de l'article sur le site"],

       "datepicker-custom"=>[ "label"=>"Date de publication", "type"=>"custom-datepicker", "id"=>"datepublied", "placeholder"=>"Date", "required"=>1, "msgerror"=>"date"],

       "visibility"=>[ "label"=>"Visibilité", "type"=>"select", "id"=>"visibility", "placeholder"=>"visibility", "required"=>1, "msgerror"=>"visibility", "choices"=>['1'=>'Public','2'=>'Privé','3'=>'Auteur uniquement']],

       "category"=>[ "label"=>"La catégorie de votre article", "type"=>"select", "id"=>"category", "placeholder"=>"Catégorie", "required"=>0, "msgerror"=>"category", "choices"=>"category"],

        "tags"=>[ "label"=>"", "type"=>"tag", "id"=>"tags-input", "placeholder"=>"Tags de l'article","msgerror"=>"tags","helper"=>"Tapez votre tag, et appuyer sur entrée pour l'ajouter à la liste."],

        "featured"=>[ "label"=>"Featured", "type"=>"featuredimg", "id"=>"featured", "update"=>true, "placeholder"=>"", "required"=>0],


       "draft"=>[ "label"=>"Brouillon", "type"=>"submit", "id"=>"draft", "placeholder"=>"", "required"=>0, "button" => "btn-alt"],

       "save"=>[ "label"=>"Publier", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],


   ]
];
    }
    public static function getFormNewPage()
    {
        return [
        "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'article", "enctype"=>"multipart/form-data", "groups"=> "false", "submit-custom"=>"true" ],
        "groups" => [   "title" => ["title"],
        "content" => ["wesic-wysiwyg"],
        "publish" => ["slug","datepicker-custom","draft","save"],
        "attribute"=>["parent"],
    ],
    "struct" => [

       "title"=>[ "label"=>"", "type"=>"text", "id"=>"title", "placeholder"=>"Nom de la page", "required"=>1, "msgerror"=>"title"],

       "wesic-wysiwyg"=>[ "label"=>"", "type"=>"texteditor", "id"=>"content", "placeholder"=>"Contenu", "required"=>1, "msgerror"=>"content"],

       "slug"=>[ "label"=>"Permalien", "type"=>"text", "id"=>"slug", "placeholder"=>"Lien", "required"=>1, "msgerror"=>"slug","checkexist"=>"true", "helper"=>"Le lien de la page sur le site"],

       "datepicker-custom"=>[ "label"=>"Date de publication", "type"=>"custom-datepicker", "id"=>"datepublied", "placeholder"=>"Date", "required"=>1, "msgerror"=>"date"],

       "parent"=>[ "label"=>"Modèle de page", "type"=>"select", "id"=>"category", "placeholder"=>"Catégoroe", "required"=>0, "msgerror"=>"category", "choices"=>Post::getParentPageList()],


       "draft"=>[ "label"=>"Brouillon", "type"=>"submit", "id"=>"draft", "placeholder"=>"", "required"=>0, "button" => "btn-alt"],

       "save"=>[ "label"=>"Publier", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],


   ]
];
    }

    public static function getFormEditPage()
    {
        return [
        "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'article", "enctype"=>"multipart/form-data", "groups"=> "false", "submit-custom"=>"true" ],
        "groups" => [   "title" => ["title"],
        "content" => ["wesic-wysiwyg"],
        "publish" => ["slug","datepicker-custom","time","status","visibility","draft","save"],
        "attribute"=>["parent","model"],
    ],
    "struct" => [

       "title"=>[ "label"=>"", "type"=>"text", "id"=>"title", "placeholder"=>"Nom de la page", "required"=>1, "msgerror"=>"title"],

       "wesic-wysiwyg"=>[ "label"=>"", "type"=>"texteditor", "id"=>"content", "placeholder"=>"Contenu", "required"=>1, "msgerror"=>"content"],

       "slug"=>[ "label"=>"Permalien", "type"=>"text", "id"=>"slug", "placeholder"=>"Lien", "required"=>1, "msgerror"=>"slug", "helper"=>"Le lien de la page sur le site"],

       "datepicker-custom"=>[ "label"=>"Date de publication", "type"=>"custom-datepicker", "id"=>"datepublied", "placeholder"=>"Date", "required"=>1, "msgerror"=>"date"],

       "parent"=>[ "label"=>"Parent", "type"=>"select", "id"=>"category", "placeholder"=>"Catégoroe", "required"=>0, "msgerror"=>"category", "choices"=>['1'=>'Aucune catégorie','2'=>'Privés','3'=>'Auteur uniquement']],

       "model"=>[ "label"=>"Modèle", "type"=>"select", "id"=>"category", "placeholder"=>"Catégoroe", "required"=>0, "msgerror"=>"category", "choices"=>['1'=>'Par défaut','2'=>'Privés','3'=>'Auteur uniquement']],


       "draft"=>[ "label"=>"Brouillon", "type"=>"submit", "id"=>"draft", "placeholder"=>"", "required"=>0, "button" => "btn-alt"],

       "save"=>[ "label"=>"Publier", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],

   ]
];
    }
}
