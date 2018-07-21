<?php

class pageController
{

    /**
     * [indexAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public static function indexAction(Request $request)
    {
        echo "pages";
    }

    /**
     * [singleAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public static function singleAction(Request $request)
    {
        $param = $request->getParams();

        $qb = new QueryBuilder();
        
        $page = $qb
            ->select('p.id,p.title,p.content,p.description as seodesc,p.published_at as date,p.user_id as authorid,media.path,media.caption as mcaption,media.description as mdesc,media.alttext as malt')
            ->from('post AS p')
            ->leftJoin('media','p.featured = media.id')
            ->where('p.slug', $param['slug'])
            ->and()
            ->where('p.status', 1)
            ->fetchOrFail();

        Stat::add(1, "lecture page", 2, $page['id']);

        $v = new View();

        if (isset($page['parent'])) {
            $v->setView(explode('.', $page['parent'])[0], "template", "front");
        } else {
            $v->setView("page", "template", "front");
        }

        Singleton::bridge(['page'=>$page,'view'=>$v->getViewInfos()]);

        $v->massAssign([
            "title"=>$page['title'],
        ]);
    }

    /**
     * [allPagesAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function allPagesAction(Request $request)
    {
        $param = $request->getParams();
        $get = $request->getGet();

        $filter = $sort = null;

        $qbPage = new QueryBuilder();
        $qbPage
        ->select('post.*,user.login as author')
        ->from('post')
        ->join('user', 'user.id = post.user_id')
        ->where('post.type', 2);

        if (isset($param['filter'])) {
            $filter = $param['filter'];
            $qbPage->pageDisplayFilters($filter);
        }
        if (isset($param['sort'])) {
            $sort = $param['sort'];
            $qbPage->pageDisplaySorting($sort);
        }
        if (isset($get['s'])) {
            $search = $get['s'];
            $qbPage->and()->search('post.title', $search);
        }

        $pages = $qbPage->paginate(10);

        $v = new View();

        $v->setView("cms/pages", "templateadmin");
        $v->massAssign([
            "title" => "Pages",
            "icon" =>"icon-files-empty",
            "pages" => $pages,
            "sort"=>$sort,
            "elementNumber"=>$pages['pagination']['total'],
            "filter" =>$filter,
        ]);
    }

    /**
     * [deletePageAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public function deletePageAction(Request $request)
    {
        $param = $request->getParams();

        Post::deletePage($param['id']);

        Route::redirect('Pages');
    }

    /**
     * [deletePageAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public function newPageAction(Request $request)
    {
        $form = Post::getFormNewPage();
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = Validator::check($form["struct"], $request->getPost());

            if (!$errors) {
                if (!Validator::process($form["struct"], $request->getPost(), 'pagenew')) {
                    $errors=["pagenew"];
                } else {
                    Route::redirect('Pages');
                }
            }
        }
        $v = new View();
        
        $v->setView("cms/newpage", "templateadmin");
        $v->massAssign([
            "form" => $form ,
            "title" => "Nouvelle page",
            "icon" => "icon-file-text2",
            "errors" => $errors
        ]);
    }

    /**
     * [editPageAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public function editPageAction(Request $request)
    {
        $form = Post::getFormEditPage();
        $errors = [];

        $param = $request->getParams();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = Validator::check($form["struct"], $request->getPost());

            if (!$errors) {
                $request->setPost('id',$param['id']);
                if (!Validator::process($form["struct"], $request->getPost(), 'edit-page')) {
                    $errors=["pagenew"];
                } else {
                    Route::redirect('Pages');
                }
            }
        }

        $qb = new QueryBuilder();

        $data = $qb
        ->findAll('post')
        ->addWhere('id = :id')
        ->setParameter('id', $param['id'])
        ->and()
        ->addWHere('type = :type')
        ->setParameter('type', 2)
        ->fetchOne();

        if (empty($data)) {
            Route::redirect('Pages');
        }

        $_POST['title'] = $data['title'];
        $_POST['wesic-wysiwyg'] = html_entity_decode($data['content']);
        $_POST['slug'] = $data['slug'];
        $_POST['aa'] = substr($data['datePublied'], 0, 4);
        $_POST['mm'] = substr($data['datePublied'], 5, 2);
        $_POST['jj'] = substr($data['datePublied'], 8, 2);
        $_POST['hh'] = substr($data['datePublied'], 11, 2);
        $_POST['mn'] = substr($data['datePublied'], 14, 2);
        $_POST['parent'] = $data['parent'];
        $_POST['model'] =  $data['model'];

        $v = new View();
        $v->setView("cms/newpage", "templateadmin");
        $v->massAssign([
            "form" => $form,
            "title" => "Nouvelle page",
            "icon" => "icon-file-text2",
            "errors" => $errors
        ]);
    }
}
