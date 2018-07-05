<?php

class Seeder
{
	/**
	 * [FakeNews description]
	 * @param integer $nb [description]
	 */
    public static function FakeNews($nb = 50)
    {
        for ($i=0;$i<$nb;$i++) {
            $slugStr = Faker::slug();

            $article = new Post();
            $slug = new Slug();
            $slug->setSlug($slugStr);
            $slug->setType(1);
            $slug->save();

            $article->setType(1);
            $article->setTitle(Faker::title(rand(2, 6)));
            $article->setSlug($slugStr);
            $article->setContent(Faker::html());
            $article->setExcerpt(Faker::title(rand(10, 20)));
            $article->setDescription(Faker::title(rand(10, 20)));
            $article->setPublishedAt(date('Y-m-d H:i:s'));
            $article->setCreatedAt(date('Y-m-d H:i:s'));
            $article->setStatus(rand(1, 2));
            $article->setVisibility(1);
            $article->setUserId(1);
            $article->save();
            
            Category::createCategoryJoin(1, $article->getId());
        }
    }

    /**
     * [flushArticles description]
     * @return [type] [description]
     */
    public static function flushArticles()
    {
    }

    /**
     * [FakePages description]
     * @param integer $nb [description]
     */
    public static function FakePages($nb = 50)
    {
    }

    /**
     * [FakeAdmin description]
     */
    public static function FakeAdmin()
    {
        $user = new User();
        $user->setLogin('admin');
        $user->setFirstname('Louis');
        $user->setLastname('Harang');
        $user->setRole(4);
        $user->setEmail('vundaboy@gmail.cil');
        $user->setPassword('admin');
        $user->setCreatedAt(date('Y-m-d H:i:s'));
        $user->setStatus(1);
        $user->setToken();
        $user->save();
    }
}
