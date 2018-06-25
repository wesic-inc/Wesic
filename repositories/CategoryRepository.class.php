<?php

class CategoryRepository extends Basesql
{
    public function __construct()
    {
        parent::__construct();
    }


    public static function newCategory($data)
    {
        $category = new Category();

        if (self::categoryExists($data['label'], $data['slug']) || $category->slugExists($data['slug']) == true) {
            return false;
        } else {
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
            
            View::setFlash("Succès !", $message.' "'.$data['label'].'" a bien été créé', "success");

            return true;
        }
    }



    public static function editCategory($data)
    {
        $qb = new QueryBuilder();

        $currentCat = $qb->all('category')->where('id',$data['id'])->fetchOne();


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
        $category = new Category();
        $category->setSlug($slug);
        $category->setId($data['id']);
        $category->setLabel($data['label']);
        $category->setType($data['type']);
        $category->save();

        $message = ($data['type']==1)?'La catégorie':'Le Tag';
        View::setFlash("Succès !", $message.' "'.$data['label'].'" a bien été modifié', "success");

        if ($slugUpdate == true) {
            $qb->reset();
            $qb->delete()->from('slug')->where('slug',$currentPost['slug'])->get();
        }

        return true;
    }

    public static function categoryExists($label, $slug)
    {
        $category = new Category();

        $categories = $category->getData('category', ['label'=>$label,'slug'=>$slug], ['AND']);
    }

    public static function deleteCategory($category)
    {
        $qb = new QueryBuilder();

        $qb->update('join_article_category')->set('category_id = :default')->setParameter('default', Setting::getParam('default-cat'))->where('category_id',$category)->save();

        $qb->reset();
        $current =
         $qb->delete()->from('category')->where('id',$category)->and()->where('type',1)->fetchOne();

        $qb->reset();


        $protectedCat = $qb->findAll('category')->where('type',3)->fetchOne();

        if (Setting::getParam('default-cat')==$category) {
            $setting = new Setting();
            $setting->setParam('default-cat', $protectedCat['id']);
            $setting->save();
        }
    }


    public static function createCategoryJoin($category, $article)
    {
        $qb = new QueryBuilder();

        $relation = $qb->select('join_article_category.category_id')
        ->from('join_article_category')
        ->innerJoin('category', 'category.id = join_article_category.category_id')
        ->where('join_article_category.post_id',$article)
        ->and()
        ->openBracket()
        ->where('category.type',1)
        ->or()
        ->addWhere('category.type',3)
        ->closeBracket()
        ->execute();


        if (!empty($relation)) {
            $qb->reset();
            $qb->delete('join_article_category')
            ->from('join_article_category')
            ->innerJoin('category', 'category.id = join_article_category.category_id')
            ->where('join_article_category.post_id',$article)
            ->and()
            ->openBracket()
            ->addWhere('category.type',1)
            ->or()
            ->addWhere('category.type',3)
            ->closeBracket()
            ->execute();
        }

        $catRelation =  new Join_article_category();
        $catRelation->setCategoryId($category);
        $catRelation->setPostId($article);
        $catRelation->save();
    }
    public static function getCategory($article)
    {   
        $qb = new QueryBuilder();
        $cat = $qb->select('join_article_category.category_id')
        ->from('join_article_category')
        ->innerJoin('category', 'category.id = join_article_category.category_id')
        ->where('join_article_category.post_id',$article)
        ->and()
        ->openBracket()
        ->addWhere('category.type',1)
        ->or()
        ->addWhere('category.type',3)
        ->closeBracket()
        ->fetchOne();
        return $cat['category_id'];
    }
}