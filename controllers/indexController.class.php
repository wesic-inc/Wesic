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

        Singleton::bridge(['view'=>$v->getViewInfos()]);
        
        Stat::add(1, "page d'accueuil", 3);
    }

    // /**
    //  * [profil description]
    //  * @param  Request $request [description]
    //  * @return [type]           [description]
    //  */
    // public function profilAction(Request $request)
    // {
    //     echo "mon profil";
    //     // $user = $request->getParam('u');

    //     if (isset($user)) {
    //         dd($user);
    //     }
    //     if(isset(Auth::user())) {
    //         dd(Auth::user());
    //     } 
    //     else {
    //         Route::redirect('Error404');
    //     }
    // }
}
