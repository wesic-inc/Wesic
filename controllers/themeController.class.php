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


    public static function setThemeAction(Request $request)
    {
        $name = $request->getParam('name');

        $themes = glob('themes/*/*theme.yml');

        foreach ($themes as $val) {
            $themesList[] = explode("/", $val)[1];
        }

        if (in_array($name, $themesList)) {
            $setting = new Setting();
            $setting->setParam('theme', $name);
        }

        Route::redirect('Themes');
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

        if (isset($type)) {
            if ($type > 3 || $type <= 0) {
                Route::redirect('Error404');
            }
        }

        if (!isset($page)) {
            $v->setView("theme/themecreator", "templateadmin");
        }
        if ($page == 1) {
            $v->setView("theme/creator/1", "templateadmin");
        }
        if ($page == 2) {
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
    public static function menuCreatorAction(Request $request)
    {
        $qb = new QueryBuilder();
        $pages = $qb->all('pages')->get();
        $qb->reset();
        $categories = $qb->all('category')->where('type', 1)->or()->where('type', 3)->get();

        $v = new View();
        $v->setView("theme/menucreator", "templateadmin");
        $v->assign("title", "Menu Creator");
        $v->assign("icon", "icon-menu");
        $v->assign("categories", $categories);
        $v->assign("pages", $pages);
    }

    public static function saveMenuAction(Request $request)
    {
        // $menu = $request->getPost()['menu'];

        $menuRaw = '[{"name":"home","url":null,"in":[{"name":"category","id":"1","url":null},{"name":"category","id":"1","url":null},{"name":"category","id":"1","url":null}]},{"name":"qzdlqzdldqz","url":"dzqzqddqzqdz","in":[{"name":"category","id":"1","url":null}]},{"name":"home","url":null,"in":[{"name":"category","id":"1","url":null}]},{"name":"home","url":null,"in":[{"name":"category","id":"1","url":null}]}]';

        
        $menu = json_decode($menuRaw, true);
        
        $output = "";
        foreach ($menu as $key => $value) {
            $url = "";
            if (isset($value['url'])) {
                $url = $value['url'];
                $name = $value['name']; 
            }
            if ($value['name'] == 'home') {
                $url = setting('url');
                $name = 'Accueil';
            }            
            if ($value['name'] == 'category') {
                $url = Category::getCategoryById($value['id'])['slug'];
                $name = Category::getCategoryById($value['id'])['label'];
            }            
            if ($value['name'] == 'page') {
                $url = Post::getPageById($value['id'])['slug'];
                $name = Post::getPageById($value['id'])['label'];
            }
            if ( !empty($value['in']) ) {

                $output .= '<li><a href="'.$url.'">'.$name;
                $output .= '<div class="dropdown">';
                $output .= '<ul>';
                foreach ($value['in'] as $key2 => $value2) {
                    $url2 = "";
                    if (isset($value2['url'])) {
                        $url2 = $value['url'];
                        $name2 = $value['name']; 
                    }
                    if ($value2['name'] == 'home') {
                        $url2 = setting('url');
                        $name2 = 'Accueil';
                    }            
                    if ($value2['name'] == 'category') {
                        $url2 = Category::getCategoryById($value2['id'])['slug'];
                        $name2 = Category::getCategoryById($value2['id'])['label'];
                    }
                    $output .= '<li><a href="'.$url2.'">';
                    $output .= $name2;
                    $output .= "</li>";
                }
                $output .= "</a></div></ul></li>";
            }else{
                $output .= '<li><a href="'.$url.'">'.$name."</a></li>";
            }

        }
        echo $output;
    }
}
