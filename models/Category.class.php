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
          "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'utilisateur", "enctype"=>"multipart/form-data", "submit-custom"=>true ],
          "struct" => [

           "label"=>[ "label"=>"Label", "type"=>"text", "id"=>"label", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"label" ],

           "slug"=>[ "label"=>"Permalien", "type"=>"text", "id"=>"slug", "placeholder"=>"Lien", "required"=>1, "msgerror"=>"slug","checkexist"=>"true", "helper"=>"Page des archives sur le site"],

           "save"=>[ "label"=>"Sauvegarder", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],

       ]
   ];

}

public static function getFormEditCategory(){

    return [    
        "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'utilisateur", "enctype"=>"multipart/form-data", "submit-custom"=>true ],
        "struct" => [

            "label"=>[ "label"=>"Label", "type"=>"text", "id"=>"label", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"label" ],

            "slug"=>[ "label"=>"Permalien", "type"=>"text", "id"=>"slug", "placeholder"=>"Lien", "required"=>1, "msgerror"=>"slug","checkexist"=>"true", "helper"=>"Page des archives sur le site", "checkexist"=>"true"],

            "save"=>[ "label"=>"Sauvegarder", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],

        ]
    ];

}       
public static function getFormNewTag(){

    return [	
      "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'utilisateur", "enctype"=>"multipart/form-data", "submit-custom"=>true ],
      "struct" => [

       "label"=>[ "label"=>"Label", "type"=>"text", "id"=>"label", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"label" ],

       "slug"=>[ "label"=>"Permalien", "type"=>"text", "id"=>"slug", "placeholder"=>"Lien", "required"=>1, "msgerror"=>"slug","checkexist"=>"true", "helper"=>"Page des archives sur le site"],

       "save"=>[ "label"=>"Sauvegarder", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],

   ]
];

}

public static function getFormEditTag(){

    return [    
        "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Ajouter l'utilisateur", "enctype"=>"multipart/form-data", "submit-custom"=>true ],
        "struct" => [

            "label"=>[ "label"=>"Label", "type"=>"text", "id"=>"label", "placeholder"=>"Nom", "required"=>1, "msgerror"=>"label" ],

            "slug"=>[ "label"=>"Permalien", "type"=>"text", "id"=>"slug", "placeholder"=>"Lien", "required"=>1, "msgerror"=>"slug","checkexist"=>"true", "helper"=>"Page des archives sur le site", "checkexist"=>"true"],

            "save"=>[ "label"=>"Sauvegarder", "type"=>"submit", "id"=>"save", "placeholder"=>"", "required"=>0],

        ]
    ];

}    
public static function newCategory($data){
    $category = new Category();

    if( self::categoryExists($data['label'],$data['slug']) || $category->slugExists($data['slug']) == true ){
        return false;
    }
    else{
        $slug = new Slug();

        $slug = new Slug();
        $slug->setSlug($data['slug']);
        $slug->setType(3);
        $slug->save();


        $category->setLabel($data['label']);
        $category->setSlug($data['slug']);
        $category->setType($data['type']);
        $category->save();

        $message = ($data['type']==1)?'La catégorie':'Le Tag';
        View::setFlash("Succès !",$message.' "'.$data['label'].'" a bien été créé',"success");

        return true;

    }
}



public static function editCategory($data){

    $qb = new QueryBuilder();

    $currentCat = $qb->findAll('category')->addWhere('id = :id')->setParameter('id',$data['id'])->fetchOne();


    if($currentCat['slug'] === $data['slug']){
        $slug = $currentCat['slug'];
        $slugUpdate = false;
    }else{
        $slug = $data['slug'];
        $newSlug = new Slug();
        $newSlug->setSlug($slug);
        $newSlug->setType(3);
        $newSlug->save();
        $slugUpdate = true;
    }
    $category = new Category();
    $category->setSlug($slug);
    $category->setId($data['id']);
    $category->setLabel($data['label']);
    $category->setType($data['type']);
    $category->save();

    $message = ($data['type']==1)?'La catégorie':'Le Tag';
    View::setFlash("Succès !",$message.' "'.$data['label'].'" a bien été modifié',"success");

    if($slugUpdate == true){
        $qb->reset();
        $qb->delete()->from('slug')->addWhere('slug = :slug')->setParameter('slug',$currentPost['slug'])->execute();
    }

    return true;

}

public static function categoryExists($label,$slug){

 $category = new Category();

 $categories = $category->getData('category',['label'=>$label,'slug'=>$slug],['AND']);

}

public static function deleteCategory($category){

   $qb = new QueryBuilder();

   $qb->update('join_article_category')
   ->set('category_id = :default')
   ->setParameter('default',Setting::getParam('default-cat'))
   ->addWhere('category_id = :cat')
   ->setParameter('cat',$category)
   ->save();

    $qb->reset();
    $current = 
    $qb->delete()
    ->from('category')
    ->addWhere('id = :id')
    ->setParameter('id',$category)
    ->and()
    ->addWhere('type = :type')
    ->setParameter('type',1)->fetchOne();


}


public static function createCategoryJoin($category,$article){

    $qb = new QueryBuilder();

    $relation = $qb->select('join_article_category.category_id')
    ->from('join_article_category')
    ->innerJoin('category','category.id = join_article_category.category_id')
    ->addWhere('join_article_category.post_id = :post')
    ->setParameter('post',$article)
    ->and()
    ->openBracket()
    ->addWhere('category.type = :type')
    ->setParameter('type',1)
    ->or()
    ->addWhere('category.type = :type2')
    ->setParameter('type2',3)
    ->closeBracket()
    ->execute();


    if(!empty($relation)){
        $qb->reset();
        $qb->delete('join_article_category')
        ->from('join_article_category')
        ->innerJoin('category','category.id = join_article_category.category_id')
        ->addWhere('join_article_category.post_id = :post')
        ->setParameter('post',$article)
        ->and()
        ->openBracket()
        ->addWhere('category.type = :type')
        ->setParameter('type',1)
        ->or()
        ->addWhere('category.type = :type2')
        ->setParameter('type2',3)
        ->closeBracket()
        ->execute();
    }

    $catRelation =  new Join_article_category();
    $catRelation->setCategoryId($category);
    $catRelation->setPostId($article);
    $catRelation->save();

} 
public static function getCategory($article){
    $qb = new QueryBuilder();
    $cat = $qb->select('join_article_category.category_id')
    ->from('join_article_category')
    ->innerJoin('category','category.id = join_article_category.category_id')
    ->addWhere('join_article_category.post_id = :post')
    ->setParameter('post',$article)
    ->and()
    ->openBracket()
    ->addWhere('category.type = :type')
    ->setParameter('type',1)
    ->or()
    ->addWhere('category.type = :type2')
    ->setParameter('type2',3)
    ->closeBracket()
    ->fetchOne();
    return $cat['category_id'];
}
}