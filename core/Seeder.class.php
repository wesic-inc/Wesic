<?php

class Seeder
{
    /**
     * [FakeNews description]
     * @param integer $nb [description]
     */
    public static function fakeNews($nb = 50)
    {


        $qb = new QueryBuilder();

        $res = 
        $qb->select('id')
        ->from('user')
        ->where('role', 2)
        ->or()
        ->where('role', 3)
        ->or()
        ->where('role', 3)
        ->get();
        
        $userIds = [];        

        foreach ($res as $value) {
            $userIds[] = $value['id'];
        }


        $qb->reset();

        $res = 
        $qb->select('id')
        ->from('category')
        ->where('type', 1)
        ->or()
        ->where('type', 3)
        ->get();
        
        $catIds = [];

        foreach ($res as $value) {
            $catIds[] = $value['id'];
        }        

        for ($i=0;$i<$nb;$i++) {
            
            $slugStr = Faker::slug();
            $rand = array_rand($catIds);
            $randUser = array_rand($userIds);

            $article = new Post();
            $slug = new Slug();
            $slug->setSlug($slugStr);
            $slug->setType(1);
            $slug->save();

            $article->setTitle(Faker::title(rand(2, 6)));
            $article->setType(1);
            $article->setContent(Faker::html());
            $article->setSlug($slugStr);
            $article->setExcerpt(Faker::title(rand(10, 20)));
            $article->setDescription(Faker::title(rand(10, 20)));
            $article->setPublishedAt(date('Y-m-d H:i:s'));
            $article->setCreatedAt(date('Y-m-d H:i:s'));
            $article->setStatus(rand(1, 2));
            $article->setVisibility(1);
            $article->setUserId($userIds[$randUser]);
            $article->save();

            Category::createCategoryJoin($catIds[$rand], $article->getId());
        }
    }

    public static function fakeCategories($nb = 20)
    {
        for ($i=0;$i<$nb;$i++) {
            $slugStr = Faker::slug();

            $category = new Category();
            $slug = new Slug();
            $slug->setSlug($slugStr);
            $slug->setType(3);
            $slug->save();

            $category->setLabel(Faker::title(rand(1, 3)));
            $category->setSlug($slugStr);
            $category->setType(1);
            $category->save();
        }
    }

    /**
     * [flushArticles description]
     * @return [type] [description]
     */
    public static function fakePages($nb = 50)
    {

        $qb = new QueryBuilder();
        $res = $qb->select('id')->from('user')->where('role', 2)->or()->where('role', 3)->or()->where('role', 3)->get();
        
        $userIds = [];        

        foreach ($res as $value) {
            $userIds[] = $value['id'];
        }

        for ($i=0;$i<$nb;$i++) {
            $slugStr = Faker::slug();
            $randUser = array_rand($userIds);

            $article = new Post();
            
            $slug = new Slug();
            $slug->setSlug($slugStr);
            $slug->setType(2);
            $slug->save();

            $article->setTitle(Faker::title(rand(2, 6)));
            $article->setType(2);
            $article->setContent(Faker::html());
            $article->setSlug($slugStr);
            $article->setPublishedAt(date('Y-m-d H:i:s'));
            $article->setCreatedAt(date('Y-m-d H:i:s'));
            $article->setStatus(rand(1, 2));
            $article->setVisibility(1);
            $article->setUserId($userIds[$randUser]);
            $article->save();
        }
    }

    /**
     * [FakeComments description]
     * @param integer $nb [description]
     */
    public static function fakeComments($nb = 10)
    {
        $qb = new QueryBuilder();

        $res = $qb->select('id')->from('post')->where('type', 1)->get();

        $postIds = [];

        foreach ($res as $value) {
            $postIds[] = $value['id'];
        }

        for ($i=0;$i<$nb;$i++) {
            $comment = new Comment();

            $type = rand(1, 2);

            if ($type == 1) {
                $comment->setUserId(1);
                $comment->setType(1);
            }
            if ($type == 2) {
                $comment->setEmail(Faker::email());
                $comment->setName(Faker::name());
                $comment->setType(2);
            }

            $comment->setBody(Faker::title(10));
            $comment->setCreatedAt();
            $comment->setStatus(rand(1,5));
            $rand = array_rand($postIds);
            $comment->setPostId($postIds[$rand]);

            $comment->save();
        }
    }


    public static function fakeMedias()
    {
        for ($i=0;$i<50;$i++) {
            $media = new Media;
            $type = rand(1, 3);
            
            $media->setType($type);

            switch ($type) {
                case 1:
                $media->setPath('public/storage/img/2018/7/test.jpg');
                break;
                case 2:
                $media->setUrl('fKFbnhcNnjE');
                break;
                case 3:
                $media->setPath('public/storage/music/2018/7/test.mp3');
                break;
                default:
                break;

            }
            $media->setName(Faker::title());
            $media->setUserId(21);
            $media->save();
        }
    }
    /**
     * [FakeAdmin description]
     */
    public static function fakeAdmin()
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

    /**
     * [fakeUsers description]
     * @param  integer $nb [description]
     * @return [type]      [description]
     */
    public static function fakeUsers($nb = 100)
    {
        for ($i=0;$i<$nb;$i++) {

            $user = new User();
            $user->setLogin(Faker::username());
            $user->setFirstname(Faker::firstname());
            $user->setLastname(Faker::lastname());
            $user->setRole(rand(1, 5));
            $user->setEmail(Faker::email());
            $user->setPassword('password');
            $user->setCreatedAt(date('Y-m-d H:i:s'));
            $user->setStatus(rand(1, 5));
            $user->setToken();

            $user->save();

        }
    }

    /**
     * [fakeStats description]
     * @param  [type] $number [description]
     * @return [type]         [description]
     */
    public static function fakeStats($nb = 50000)
    {
        $qb = new QueryBuilder();
        $res = $qb->select('id')->from('post')->where('type', 1)->get();
        
        $articleIds = [];

        foreach ($res as $value) {
            $articleIds[] = $value['id'];
        }

        $qb->reset();
        $res = $qb->select('id')->from('post')->where('type', 2)->get();
        
        $pageIds = [];

        foreach ($res as $value) {
            $pageIds[] = $value['id'];
        }

        $qb->reset();
        $res = $qb->select('id')->from('category')->where('type', 1)->get();
        
        $catIds = [];

        foreach ($res as $value) {
            $catIds[] = $value['id'];
        }

        $now = time();
        $before = strtotime('-1 year');

        for ($i=0;$i<$nb;$i++) {
            $stat = new Stat();


            $type = rand(1, 7);
            $date= rand($before, $now);

            $stat->setType($type);
            $stat->setBody("test purpose");
            $stat->setDate(date("Y-m-d H:i:s", $date));


            switch ($type) {
                case 2:
                $stat->setContentType(1);
                $stat->setContentId($articleIds[array_rand($articleIds)]);
                break;
                case 3:
                $stat->setContentType(2);
                $stat->setContentId($pageIds[array_rand($pageIds)]);
                break;
                case 4:
                $stat->setContentType(3);
                $stat->setContentId($catIds[array_rand($catIds)]);
                // no break
                default:
                break;
            }

            $stat->setIp(long2ip(rand(0, "4294967295")));
            $stat->setUseragent();
            $stat->setReferer();
            $stat->save();
        }
    }
}
