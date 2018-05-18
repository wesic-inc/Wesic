<?php 
class Post extends Basesql{

	protected $id;
	protected $title;
    protected $type;
    protected $slug;
    protected $content;
    protected $excerpt;
    protected $image;
    protected $description;
    protected $dateCreation;
    protected $datePublied;
    protected $status;
    protected $visibility;
    protected $parent;
    protected $user_id;

    public function __construct(){
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
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param mixed $dateCreation
     *
     * @return self
     */
    public function setDateCreation($dateCreation = "")
    {
        if( $dateCreation ){
            $this->dateCreation = $dateCreation;
        }else {
            $this->dateCreation = date("Y-m-d H:i:s");
        }
    }

    /**
     * @return mixed
     */
    public function getDatePublied()
    {
        return $this->datePublied;
    }

    /**
     * @param mixed $datePublied
     *
     * @return self
     */
    public function setDatePublied($datePublied = null)
    {   
        if($datePublied){
            $this->datePublied = $datePublied;
        }
        else{
            $this->datePublied = date("Y-m-d H:i:s");
        }
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
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     *
     * @return self
     */
    public function setImage($image)
    {
        $this->image = $image;

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

    public static function getFormNewArticle(){
        return [    
            "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'article", "enctype"=>"multipart/form-data", "groups"=> "false", "submit-custom"=>"true" ],
            "groups" => [   "title" => ["title"], 
                            "content" => ["wesic-wysiwyg"], 
                            "excerpt" => ["excerpt"], 
                            "description"=>["description"],
                            "publish" => ["slug","datepicker-custom","time","status","visibility","draft","save"],
                            "category"=>["category"],
                            "tags"=>["tags"], 
                ],
            "struct" => [

               "title"=>[ "label"=>"", "type"=>"text", "id"=>"title", "placeholder"=>"Titre de l'article", "required"=>1, "msgerror"=>"title"],

                "wesic-wysiwyg"=>[ "label"=>"", "type"=>"texteditor", "id"=>"content", "placeholder"=>"Contenu", "required"=>1, "msgerror"=>"content"],

                "excerpt"=>[ "label"=>"", "type"=>"textarea", "id"=>"excerpt", "placeholder"=>"Résumé de l'article", "required"=>1, "msgerror"=>"excerpt", "helper"=>"L'extrait de l'article sur votre site"],

                "description"=>[ "label"=>"", "type"=>"textarea", "id"=>"description", "placeholder"=>"Desc", "required"=>1, "msgerror"=>"description", "helper"=>"La description de votre article pour l'indexation des moteurs de recherche"],


                "slug"=>[ "label"=>"Permalien", "type"=>"text", "id"=>"slug", "placeholder"=>"Lien", "required"=>1, "msgerror"=>"slug","checkexist"=>"true", "helper"=>"Le lien de l'article sur le site"],
                
                "datepicker-custom"=>[ "label"=>"Date de publication", "type"=>"custom-datepicker", "id"=>"datepublied", "placeholder"=>"Date", "required"=>1, "msgerror"=>"date"],
                
                "visibility"=>[ "label"=>"Visibilité", "type"=>"select", "id"=>"visibility", "placeholder"=>"visibility", "required"=>1, "msgerror"=>"visibility", "choices"=>['1'=>'Public','2'=>'Privé','3'=>'Auteur uniquement']],

                "category"=>[ "label"=>"La catégorie de votre article", "type"=>"select", "id"=>"category", "placeholder"=>"Catégoroe", "required"=>0, "msgerror"=>"category", "choices"=>['1'=>'Aucune catégorie','2'=>'Privés','3'=>'Auteur uniquement']],

                "tags"=>[ "label"=>"", "type"=>"text", "id"=>"tags", "placeholder"=>"Tags de l'article", "required"=>0, "msgerror"=>"tags","helper"=>"Séparez les tags par des virgules"],

                "draft"=>[ "label"=>"Brouillon", "type"=>"submit", "id"=>"draft", "placeholder"=>"", "required"=>0, "button" => "btn-alt"],

                "save"=>[ "label"=>"Publier", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],

                
            ]
        ];
    }
    public static function getFormNewPage(){
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

                "slug"=>[ "label"=>"Permalien", "type"=>"text", "id"=>"slug", "placeholder"=>"Lien", "required"=>1, "msgerror"=>"slug","checkexist"=>"true", "helper"=>"Le lien de la page sur le site"],
                
                "datepicker-custom"=>[ "label"=>"Date de publication", "type"=>"custom-datepicker", "id"=>"datepublied", "placeholder"=>"Date", "required"=>1, "msgerror"=>"date"],
                
                "parent"=>[ "label"=>"Parent", "type"=>"select", "id"=>"category", "placeholder"=>"Catégoroe", "required"=>0, "msgerror"=>"category", "choices"=>['1'=>'Aucune catégorie','2'=>'Privés','3'=>'Auteur uniquement']],

                "model"=>[ "label"=>"Modèle", "type"=>"select", "id"=>"category", "placeholder"=>"Catégoroe", "required"=>0, "msgerror"=>"category", "choices"=>['1'=>'Par défaut','2'=>'Privés','3'=>'Auteur uniquement']],


                "draft"=>[ "label"=>"Brouillon", "type"=>"submit", "id"=>"draft", "placeholder"=>"", "required"=>0, "button" => "btn-alt"],

                "save"=>[ "label"=>"Publier", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],

                
            ]
        ];
    }

    public static function newArticle($data){
            
        // dump(htmlentities($data['wesic-wysiwyg']),0,2);

        $slug = new Slug();
        $slug->setSlug($data['slug']);
        $slug->setType(1);
        $slug->save();

        $datePublied = $data['aa']."-".$data['mm']."-".$data['jj']." ".$data['hh'].":".$data['mn'].":00";
            
        $article = new Post();
        
        $article->setType(1);  
        $article->setTitle($data['title']);
        $article->setSlug($data['slug']);
        $article->setContent(htmlentities($data['wesic-wysiwyg']));
        $article->setExcerpt($data['excerpt']);
        $article->setDescription($data['description']);
        $article->setDatePublied($datePublied);
        $article->setDateCreation();
        $article->setStatus(1);
        $article->setVisibility($data['visibility']);
        $article->setUserId(Singleton::getUser()->getId());
        $article->save();        

        return true;
            
    }    

    public static function newPage($data){
        dump($data,0,2);

        $slug = new Slug();
        $slug->setSlug($data['slug']);
        $slug->setType(2);
        $slug->save();

        $datePublied = $data['aa']."-".$data['mm']."-".$data['jj']." ".$data['hh'].":".$data['mn'].":00";
            
        $page = new Post();
        $page->setType(2);  
        $page->setTitle($data['title']);
        $page->setSlug($data['slug']);
        $page->setContent(htmlentities($data['wesic-wysiwyg']));
        $page->setDatePublied($datePublied);
        $page->setDateCreation();
        $page->setStatus(1);
        $page->setVisibility(1);
        $page->setUserId(Singleton::getUser()->getId());
        $page->save();  


        return true;
            
    }



}







