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
            $article->setUserId(1);
            $article->save();

            Category::createCategoryJoin(1, $article->getId());
        }
    }

    /**
     * [flushArticles description]
     * @return [type] [description]
     */
    public static function fakePages($nb = 50)
    {
        for ($i=0;$i<$nb;$i++) {


            $slugStr = Faker::slug();

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
            $article->setUserId(1);
            $article->save();
        }
    }

    /**
     * [FakeComments description]
     * @param integer $nb [description]
     */
    public static function FakeComments($nb = 10)
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
            $comment->setStatus(rand(10, 20));
            $rand = array_rand($postIds);
            $comment->setPostId($postIds[$rand]);

            $comment->save();
        }
    }


    public static function FakeMedias()
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
        $res = $qb->select('id')->from('post')->where('type', 1)->get();
        
        $pageIds = [];

        foreach ($res as $value) {
            $pageIds[] = $value['id'];
        }


        $now = time();
        $before = strtotime('-1 year');


        dd($now);

        for ($i=0;$i<$number;$i++) {

            $stat = new Stat();
            
            $min = strtotime($start_date);
            $max = strtotime($end_date);

            $val = rand($min, $max);

            $stat->setType(rand(1, 2));
            $stat->setBody("testPurpoe");

            $int= rand($before, $now);

            $stat->setDate(date("Y-m-d H:i:s", $int));
            $stat->setContentType(rand(1, 7));
            $stat->setContentId(rand(1, 50));

            $stat->setIp(long2ip(rand(0, "4294967295")));
            $stat->setUseragent();
            $stat->setReferer();
            $stat->save();
        }
    }
}
