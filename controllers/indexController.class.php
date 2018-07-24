<?php

class indexController
{
    
    /**
     * [indexAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public function indexAction(Request $request)
    {
        $v = new View();
        
        $v->setView("home", "template", "front");

        
        $description = setting('slogan');


        Singleton::bridge([
            'view'=>$v->getViewInfos(),
            'description'=>$description

        ]);

        Stat::add(1, "page d'accueuil", 3);
    }

    public function profilAction(Request $request)
    {
        if (isset($request->getParam('user'))) {
            $user = $request->getParam('user');
            $qb = new QueryBuilder();
            $user = $qb->all('user')->where('login',$user)->fetchOrFail();
        } else {
            $user = Auth::user();
        }

        dd($user);
        
        $v = new View();
        $v->setView("index/profile");
        $v->assign('user', $user);
    }

    public function getSitemapAction(Request $request)
    {
        echo "sitemap";
    }
}
