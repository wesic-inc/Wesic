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

    public function tagArchiveAction(Request $request)
    {
        dd($request->getParam('t'));
    }

    public function profilAction(Request $request)
    {
        echo "mon profil";

    }

    public function getSitemapAction(Request $request){
        echo "sitemap";
    }
}
