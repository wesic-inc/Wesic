<?php 
class Article extends Basesql{

	protected $id;
	protected $title;
	protected $slug;
	protected $content;
	protected $excerpt;
	protected $description;
	protected $dateCreation;
	protected $datePublied;
	protected $status;
	protected $visibility;
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

    	return $this;
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
    	$this->title = $title;

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
    	$this->content = $content;

    	return $this;
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
    public function getDateCreation()
    {
    	return $this->dateCreation;
    }

    /**
     * @param mixed $dateCreation
     *
     * @return self
     */
    public function setDateCreation($dateCreation)
    {
    	$this->dateCreation = $dateCreation;

    	return $this;
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
    public function setDatePublied($datePublied)
    {
    	$this->datePublied = $datePublied;

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


    public static function getFormNewArticle(){
    	return [	
    		"options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'article", "enctype"=>"multipart/form-data" ],
    		"struct" => [

    			"title"=>[ "label"=>"Identifiant", "type"=>"text", "id"=>"title", "placeholder"=>"Titre de l'article", "required"=>1, "msgerror"=>"title" ],

    			"slug"=>[ "label"=>"Slug", "type"=>"text", "id"=>"slug", "placeholder"=>"Slug", "required"=>1, "msgerror"=>"slug" ],

    			"content"=>[ "label"=>"Nom", "type"=>"textarea", "id"=>"content", "placeholder"=>"Contenu", "required"=>1, "msgerror"=>"content" ],

    			"excerpt"=>[ "label"=>"Excerpt", "type"=>"text", "id"=>"excerpt", "placeholder"=>"Résumé de l'article", "required"=>1, "msgerror"=>"excerpt" ],

    			"description"=>[ "label"=>"Description", "type"=>"text", "id"=>"description", "placeholder"=>"Desc", "required"=>1, "msgerror"=>"description" ],

    			"datepublied"=>[ "label"=>"Date de publication", "type"=>"datetime", "id"=>"datepublied", "placeholder"=>"Mot de passe", "required"=>1, "msgerror"=>"datepublied" ],
    			
    			"status"=>[ "label"=>"Statut", "type"=>"select", "id"=>"status", "placeholder"=>"Mot de passe", "required"=>1, "msgerror"=>"status", "choices"=>['1'=>'brouillon','2'=>'programmé','3'=>'publié'] ],

    			"visibility"=>[ "label"=>"visibility", "type"=>"select", "id"=>"visibility", "placeholder"=>"visibility", "required"=>1, "msgerror"=>"visibility", "choices"=>['1'=>'Public','2'=>'Privé','3'=>'Auteur uniquement'] ],
    			
    		]
    	];
    }

    public static function newArticle($data){


            if( self::slugExists($data['slug']) ){
                return false;
            }
            else{

            $article = new Article();
            $article->setTitle($data['title']);
            $article->setSlug($data['slug']);
            $article->setContent($data['content']);
            $article->setExcerpt($data['excerpt']);
            $article->setDescription($data['description']);
            $article->setDatePublied(str_ireplace("t"," ",$data['datepublied']).":00");
            $article->setDateCreation(date('Y-m-d H:i:s'));
            $article->setStatus($data['status']);
            $article->setVisibility($data['visibility']);
            $article->setUserId($_SESSION['id']);
            $article->save();
            return true;
            
            }
        }

    public static function slugExists($slug){

        $article = new Article();

        $articles = $article->getData('article',["slug"=>$slug]);

        return !empty($articles);

    }
}







