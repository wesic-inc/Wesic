<?php

class Category extends Basesql{
	
	protected $id;
	protected $label;
	protected $type;
	protected $slug;


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

    public static function getFormNewCategory(){

				return [	
						"options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'utilisateur", "enctype"=>"multipart/form-data" ],
						"struct" => [

							"label"=>[ "label"=>"Label", "type"=>"text", "id"=>"label", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"label" ],
							"slug"=>[ "label"=>"Slug", "type"=>"text", "id"=>"slug", "placeholder"=>"Slug", "required"=>1, "msgerror"=>"slug" ],

							"type"=>[ "label"=>"Type", "type"=>"select", "id"=>"type", "placeholder"=>"Type", "required"=>1, "msgerror"=>"type", "choices"=>['1'=>'catégorie','2'=>'tag'] ],
						]
			];

		}
        
	public static function newCategory($data){

            $category = new Category();
            echo "<pre>";
            var_dump($category->slugExists($data['slug']));
            die();

            if( self::categoryExists($data['label'],$data['slug']) || $category->slugExists($data['slug']) == true ){
                return false;
            }
            else{

            $category->setLabel($data['label']);
            $category->setSlug($data['slug']);
            $category->setType($data['type']);
            $category->save();

            return true;
            
            }
		}
    
    public static function categoryExists($label,$slug){

    	$category = new Category();

    	$categories = $category->getData('category',['label'=>$label,'slug'=>$slug],['AND']);
      
    }


}