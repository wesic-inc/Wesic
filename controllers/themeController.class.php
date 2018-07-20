<?php
class themeController
{
    /**
     * [indexAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public static function indexAction($args)
    {

    	$themes = glob('themes/*/*theme.yml');

    	foreach ($themes as $val) {
    		$themesList[] = explode("/", $val)[1];
    	}

        $v = new View();
        $v->setView("theme/index", "templateadmin");
        $v->massAssign([
        	"title"=>"Tous les thèmes",
        	"icon"=>"icon-paint-format",
        	"themes"=>$themesList
        ]);
    }

    /**
     * [indexAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public static function editThemeAction($args)
    {
        
        dd(themeEnv());

        $v = new View();
        $v->setView("theme/all-themes", "templateadmin");
        $v->massAssign([
        	"title"=>"Modifier mon thème",
        	"icon"=>"icon-eyedropper"
        ]);
    }

    /**
     * [indexAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public static function themeCreatorAction(Request $request)
    {
        $v = new View();
        
        $page = $request->getParam('p');
        $type = $request->getParam('type');

        if(isset($type)){
            if($type > 3 || $type <= 0){
                Route::redirect('Error404');
            }
        }

        if(!isset($page)){
            $v->setView("theme/themecreator", "templateadmin");
        }
        if($page == 1 ){
            $v->setView("theme/creator/1", "templateadmin");
        }        
        if($page == 2){
            $v->setView("theme/creator/2", "templateadmin");
        }
        $v->assign("title", "Theme Creator");
        $v->assign("icon", "icon-droplet");
        $v->assign("type", $type);
    }

    /**
     * [indexAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public static function menuCreatorAction($args)
    {

        $qb = new QueryBuilder();

        $pages = $qb->all('pages')->get();

        $qb->reset();

        $categories = 
        $qb->all('category')
        ->where('type',1)
        ->or()
        ->where('type',3)
        ->get();

        $v = new View();
        $v->setView("theme/menucreator", "templateadmin");
        $v->assign("title", "Menu Creator");
        $v->assign("icon", "icon-menu");
        $v->assign("categories", $categories);
        $v->assign("pages", $pages);
    }
}
