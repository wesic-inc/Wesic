<?php

class CategoryRepository extends Basesql
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * [newCategory description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function newCategory($data)
    {
        $category = new Category();
        if ($data['type']==1) {
            if (self::categoryExists($data['label'], $data['slug']) || $category->slugExists($data['slug']) == true) {
                return false;
            }
        } 

        if ($data['type']==1) {
            $slug = new Slug();

            $slug = new Slug();
            $slug->setSlug($data['slug']);
            $slug->setType(3);
            $slug->save();
            $category->setSlug($data['slug']);
        }

        $category->setLabel($data['label']);
        $category->setType($data['type']);
        $category->save();

        $message = ($data['type']==1)?'La catégorie':'Le Tag';
        
        View::setFlash("Succès !", $message.' "'.$data['label'].'" a bien été créé', "success");

        return true;
    }

    /**
     * [editCategory description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function editCategory($data)
    {
        $qb = new QueryBuilder();

        $currentCat = $qb->all('category')->where('id', $data['id'])->fetchOne();

        $category = new Category();
        
        if ($data['type'] == 1) {
            if ($currentCat['slug'] === $data['slug']) {
                $slug = $currentCat['slug'];
                $slugUpdate = false;
            } else {
                $slug = $data['slug'];
                $newSlug = new Slug();
                $newSlug->setSlug($slug);
                $newSlug->setType(3);
                $newSlug->save();
                $slugUpdate = true;
            }
            $category->setSlug($slug);
        }
        
        $category->setId($data['id']);
        $category->setLabel($data['label']);
        $category->setType($data['type']);
        $category->save();

        $message = ($data['type']==1)?'La catégorie':'Le Tag';
        View::setFlash("Succès !", $message.' "'.$data['label'].'" a bien été modifié', "success");

        if (isset($slugUpdate) && $slugUpdate == true) {
            $qb->reset();
            $qb->delete()->from('slug')->where('slug', $currentPost['slug'])->get();
        }

        return true;
    }

    /**
     * [categoryExists description]
     * @param  [type] $label [description]
     * @param  [type] $slug  [description]
     * @return [type]        [description]
     */
    public static function categoryExists($label, $slug)
    {
        $category = new Category();

        $categories = $category->getData('category', ['label'=>$label,'slug'=>$slug], ['AND']);
    }

    /**
     * [deleteCategory description]
     * @param  [type] $category [description]
     * @return [type]           [description]
     */
    public static function deleteCategory($category)
    {
        $qb = new QueryBuilder();
        $qb->delete()->from('category')->where('id', $category)->and()->where('type', 1)->fetchOne();

        $protectedCat = $qb->findAll('category')->where('type', 3)->fetchOne();

        if (Setting::getParam('default-cat')==$category) {
            $setting = new Setting();
            $setting->setParam('default-cat', $protectedCat['id']);
            $setting->save();
        }
    }

    /**
     * [createCategoryJoin description]
     * @param  [type] $category [description]
     * @param  [type] $article  [description]
     * @return [type]           [description]
     */
    public static function createCategoryJoin($category, $article)
    {
        $qb = new QueryBuilder();

        $relation = $qb->select('join_article_category.category_id')
        ->from('join_article_category')
        ->innerJoin('category', 'category.id = join_article_category.category_id')
        ->where('join_article_category.post_id', $article)
        ->and()
        ->openBracket()
        ->where('category.type', 1)
        ->or()
        ->addWhere('category.type', 3)
        ->closeBracket()
        ->execute();


        if (!empty($relation)) {
            $qb->reset();
            $qb->delete('join_article_category')
            ->from('join_article_category')
            ->innerJoin('category', 'category.id = join_article_category.category_id')
            ->where('join_article_category.post_id', $article)
            ->and()
            ->openBracket()
            ->addWhere('category.type', 1)
            ->or()
            ->addWhere('category.type', 3)
            ->closeBracket()
            ->execute();
        }

        $catRelation =  new Join_article_category();
        $catRelation->setCategoryId($category);
        $catRelation->setPostId($article);
        $catRelation->save();
    }

    /**
     * [getCategory description]
     * @param  [type] $article [description]
     * @return [type]          [description]
     */
    public static function getCategory($article)
    {
        $qb = new QueryBuilder();
        $cat = $qb->select('category.label,category.slug')
        ->from('join_article_category')
        ->innerJoin('category', 'category.id = join_article_category.category_id')
        ->where('join_article_category.post_id', $article)
        ->and()
        ->openBracket()
        ->where('category.type', 1)
        ->or()
        ->where('category.type', 3)
        ->closeBracket()
        ->fetchOne();
        return ['label'=>$cat['label'],'slug'=>$cat['slug']];
    }

    /**
     * [getTags description]
     * @param  [type] $article [description]
     * @return [type]          [description]
     */
    public static function getTags($article)
    {
        $output = [];
        $qb = new QueryBuilder();
        $tags = $qb->select('category.label')
        ->from('join_article_category')
        ->innerJoin('category', 'category.id = join_article_category.category_id')
        ->where('join_article_category.post_id', $article)
        ->and()
        ->where('category.type', 2)
        ->get();
        foreach ($tags as $tag) {
            array_push($output, $tag['label']);
        }
        return $output;
    }

    /**
     * [addTags description]
     * @param [type] $tags [description]
     */
    public static function addTags($tags)
    {
        function format($item2, $key)
        {
            strtolower(trim($key));
        }
        array_walk($tags, 'format');

        $qb = new QueryBuilder();
        $dbTags = $qb->all('category')->where('type', 2)->get();
        $existingTags = [];
        $tagIds = [];

        foreach ($dbTags as $tag) {
            if (in_array(strtolower($tag['label']), $tags)) {
                array_push($existingTags, $tag['label']);
                array_push($tagIds, $tag['id']);
            }
        }

        foreach ($existingTags as $tag) {
            unset($tags[array_search($tag, $tags)]);
        }

        foreach ($tags as $label) {
            $tag = new Category;
            
            $tag->setType(2);
            $tag->setLabel($label);
            $tag->save();

            array_push($tagIds, $tag->getId());
        }
        
        return $tagIds;
    }


    /**
     * [attachTagsToPost description]
     * @param  [type] $tags   [description]
     * @param  [type] $idPost [description]
     * @return [type]         [description]
     */
    public static function attachTagsToPost($tags, $idPost)
    {

        // dd($tags);

        $qb = new QueryBuilder();

        $relation = $qb->select('join_article_category.category_id')
        ->from('join_article_category')
        ->innerJoin('category', 'category.id = join_article_category.category_id')
        ->where('join_article_category.post_id', $idPost)
        ->and()
        ->where('category.type', 2)
        ->execute();

        if (!empty($relation)) {
            $qb->reset();
            $qb->delete('join_article_category')
            ->from('join_article_category')
            ->innerJoin('category', 'category.id = join_article_category.category_id')
            ->where('join_article_category.post_id', $idPost)
            ->and()
            ->addWhere('category.type', 2)
            ->execute();
        }

        foreach ($tags as $id) {
            $join = new Join_article_category;
            $join->setCategoryId($id);
            $join->setPostId($idPost);
            $join->save();
        }
    }

    public static function getCategoryById($id){
        $qb = new QueryBuilder();
        return $qb->all('category')->where('id',$id)->fetchOne();
    }
}
