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
        $this->content = $content;
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
    public function setDateCreation($dateCreation)
    {
        if( $creationDate ){
            $this->creationDate = $creationDate;
        }else {
            $this->creationDate = date("Y-m-d H:i:s");
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
            "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'article", "enctype"=>"multipart/form-data", "groups"=> "true", "submit-custom"=>"true" ],
            "groups" => [   "title" => ["title"], 
                            "content" => ["content"], 
                            "excerpt" => ["excerpt"], 
                            "description"=>["description"], 
                            "publish" => ["slug","datepublied","time","status","visibility","draft","save"] 
                ],
            "struct" => [

               "title"=>[ "label"=>"", "type"=>"text", "id"=>"title", "placeholder"=>"Titre de l'article", "required"=>1, "msgerror"=>"title"],

                "content"=>[ "label"=>"", "type"=>"texteditor", "id"=>"content", "placeholder"=>"Contenu", "required"=>1, "msgerror"=>"content"],

                "excerpt"=>[ "label"=>"", "type"=>"text", "id"=>"excerpt", "placeholder"=>"Résumé de l'article", "required"=>1, "msgerror"=>"excerpt"],

                "description"=>[ "label"=>"", "type"=>"textarea", "id"=>"description", "placeholder"=>"Desc", "required"=>1, "msgerror"=>"description"],


                "slug"=>[ "label"=>"Slug", "type"=>"text", "id"=>"slug", "placeholder"=>"Slug", "required"=>1, "msgerror"=>"slug"],
                
                "datepublied"=>[ "label"=>"Date de publication", "type"=>"date", "id"=>"datepublied", "placeholder"=>"Date", "required"=>1, "msgerror"=>"datetime-local"],

                "time"=>[ "label"=>"Heure de publication", "type"=>"time", "id"=>"time", "placeholder"=>"Heure", "required"=>1, "msgerror"=>"time"],

                "status"=>[ "label"=>"Statut", "type"=>"select", "id"=>"status", "placeholder"=>"Status", "required"=>1, "msgerror"=>"status", "choices"=>['1'=>'brouillon','2'=>'programmé','3'=>'publié']],
                
                "visibility"=>[ "label"=>"Visibilité", "type"=>"select", "id"=>"visibility", "placeholder"=>"visibility", "required"=>1, "msgerror"=>"visibility", "choices"=>['1'=>'Public','2'=>'Privé','3'=>'Auteur uniquement']],

                "draft"=>[ "label"=>"Brouillon", "type"=>"submit", "id"=>"draft", "placeholder"=>"", "required"=>0, "button" => "btn-alt"],

                "save"=>[ "label"=>"Publier", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],

                
            ]
        ];
    }

    public static function newArticle($data){
        
        $article = new Post();
        
        var_dump($article->slugExists($data['slug']));
        die();

        if( $article->slugExists($data['slug']) ){
            return false;
        }
        else{

            $article->setType(1);  
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



}







