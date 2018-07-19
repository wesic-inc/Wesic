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
    public static function themeCreatorAction($args)
    {
        $v = new View();
        $v->setView("theme/themecreator", "templateadmin");
        $v->assign("title", "Theme Creator");
        $v->assign("icon", "icon-droplet");
    }

    /**
     * [indexAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public static function menuCreatorAction($args)
    {
        $v = new View();
        $v->setView("theme/menucreator", "templateadmin");
        $v->assign("title", "Menu Creator");
        $v->assign("icon", "icon-menu");
    }
}
