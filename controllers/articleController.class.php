<?php

class articleController
{
    /**
     * [singleAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public static function singleAction(Request $request)
    {
        $param = $request->getParams();

        $qb = new QueryBuilder();

        $article = $qb
            ->select('p.id as articleid,p.title as title,p.content as content,p.description as seodesc,p.published_at as date,p.user_id as authorid,media.path,media.caption as mcaption,media.description as mdesc,media.alttext as malt')
            ->from('post AS p')
            ->leftJoin('media','p.featured = media.id')
            ->where('p.slug', $param['slug'])
            ->and()
            ->where('p.status', 1)
            ->fetchOrFail();


        if (setting('comments')!=3) {
            $qb->reset();
            
            $comments = $qb->select('c.*,u.login as username,u.email as uemail')
            ->from('comment AS c')
            ->leftJoin('user AS u', 'c.user_id = u.id')
            ->where('c.post_id', $article['articleid'])
            ->and()
            ->openBracket()
            ->where('c.status', 1)
            ->or()
            ->where('c.status', 4)
            ->closeBracket()
            ->orderBy('c.created_at', 'DESC')
            ->get();
        }

        $form = Comment::selectSuitableForm();
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $request->setPost('idpost', $article['articleid']);

            $errors = Validator::check($form["struct"], $request->getPost());

            if (!$errors) {
                if (!Validator::process($form["struct"], $request->getPost(), 'new-comment')) {
                    $errors=["newcomment"];
                } else {
                    Route::refresh();
                }
            }
        }

        $v = new View();
        $v->setView("article", "template", "front");
        $v->massAssign([
            "data"=>$comments,
            "article"=>$article,
            "description"=>$article['seodesc'],
            "form"=>$form,
            "errors"=>$errors,
        ]);
        
        Singleton::bridge([
            'article'=>$article,
            'view'=>$v->getViewInfos()
        ]);
        
        Stat::add(1, "article read", 1, $article['articleid']);
    }

    /**
     * Display all articles in Wesic Backoffice
     * @param  Request $request 
     */
    public function allArticlesAction(Request $request)
    {
        $qbArticles = new QueryBuilder();
        $qbArticles
        ->select('post.*,user.login as author')
        ->from('post')
        ->join('user', 'user.id = post.user_id')
        ->where('post.type', 1);

        $param = $request->getParams();
        $get = $request->getGet();

        $filter = $sort = null;

        $qb = new QueryBuilder();

        if (isset($param['filter'])) {
            $filter = $param['filter'];
            $qbArticles->articleDisplayFilters($filter);
        }
        if (isset($param['sort'])) {
            $sort = $param['sort'];
            $qbArticles->articleDisplaySorting($sort);
        }
        if (isset($get['s'])) {
            $search = $get['s'];
            $qbArticles->and()->search('title', $search);
        }
        

        $articles = $qbArticles->orderBy('published_at','ASC')->paginate(10);

        $v = new View();
        
        $v->setView("cms/articles", "templateadmin");
        $v->massAssign([
            "title"=>"Articles",
            "icon"=>"icon-newspaper",
            "articles"=>$articles,
            "elementNumber"=>$articles['pagination']['total'],
            "filter"=>$filter,
            "sort"=>$sort
        ]);
    }
    /**
     * [allArticlesAjaxAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public function articleActionsAction(Request $request)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $selectIds = json_decode($request->getPost()['ids']);

            switch ($request->getParam('action')) {
                case 'unpublish':
                    foreach ($selectIds as $val) {
                        Post::setPostStatus($val,2);
                    }
                    break;                
                case 'delete':
                    foreach ($selectIds as $val) {
                        Post::setPostStatus($val,3);
                    }
                    break;
                default:
                    break;
            }

        } else {
            Route::redirect('Error404');
        }
    }

    /**
     * [newArticleAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function newArticleAction(Request $request)
    {
        $post = $request->getPost();

        $form = Post::getFormNewArticle();

        $qbMedias = new QueryBuilder();

        $medias = $qbMedias->all('media')->paginate(24);
        $qbMedias->reset();
        $images = $qbMedias->all('media')->where('type',1)->paginate(12);

        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = Validator::check($form["struct"], $post);

            if (!$errors) {
                if (!Validator::process($form["struct"], $post, 'articlenew')) {
                    $errors=["articlenew"];
                } else {
                    Route::redirect('AllArticles');
                }
            }
        }

        $v = new View();
        $v->setView("cms/newarticle", "templateadmin");
        $v->massAssign([
            "form" => $form,
            "title" => "Nouvel article",
            "icon" => "icon-pen",
            "errors" => $errors,
            "medias" => $medias,
            "images" => $images
        ]);
    }
/**
 * [editArticleAction description]
 * @param  Request $request [description]
 * @return [type]           [description]
 */
    public function editArticleAction(Request $request)
    {
        $post = $request->getPost();
        $param = $request->getParams();

        $form = Post::getFormEditArticle();
        $errors = [];


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $request->setPost('id', $param['id']);
            $request->setPost('type', 1);

            $errors = Validator::check($form["struct"], $request->getPost());

            if (!$errors) {
                if (!Validator::process($form["struct"], $request->getPost(), 'edit-article')) {
                    $errors=["articlenew"];
                } else {
                    Route::redirect('AllArticles');
                }
            }
        }

        $qb = new QueryBuilder();
        
        $data = $qb->all('post')->where('id', $param['id'])->and()->where('type', 1)->fetchOrFail();


        $_POST['title'] = $data['title'];
        $_POST['wesic-wysiwyg'] = html_entity_decode($data['content']);
        $_POST['slug'] = $data['slug'];
        $_POST['aa'] = substr($data['published_at'], 0, 4);
        $_POST['mm'] = substr($data['published_at'], 5, 2);
        $_POST['jj'] = substr($data['published_at'], 8, 2);
        $_POST['hh'] = substr($data['published_at'], 11, 2);
        $_POST['mn'] = substr($data['published_at'], 14, 2);
        $_POST['visibility'] = $data['visibility'];
        $_POST['excerpt'] = $data['excerpt'];
        $_POST['description'] = $data['description'];
        // $_POST['category'] = Category::getCategory($data['category']);
        
        $v = new View();
        $v->setView("cms/newarticle", "templateadmin");
        $v->massAssign([
            "form"=>$form,
            "title" => "Nouvel article",
            "icon" => "icon-pen",
            "errors" => $errors
        ]);
    }
/**
 * [deleteArticleAction description]
 * @param  Request $request [description]
 * @return [type]           [description]
 */
    public static function deleteArticleAction(Request $request)
    {
        $param = $request->getParams();

        Post::deleteArticle($param['id']);

        Route::redirect('AllArticles');
    }
/**
 * [getRssAction description]
 * @param  Request $request [description]
 * @return [type]           [description]
 */
    public function getRssAction(Request $request)
    {
        $get = $request->getGet();

        $qb = new QueryBuilder();

        $pagination = Setting::getParam('pagination-rss');
        
        $qb->findAll('post')->where('status', 1)->and()->addWhere('datePublied', '<=', date("Y-m-d H:i:s"));

        if (!isset($get['page'])) {
            $qb->limit('0', $pagination);
            $get['page'] = "";
        } else {
            $qb->limit($get['page']*$pagination-$pagination, $pagination);
        }

        $articles = $qb->get();

        $v = new View();
        $v->setView("article/rss", "templateajax");
        $v->massAssign([
            "title" => "Flux RSS",
            "icon" => "icon-pen",
            "url" => Setting::getParam('url'),
            "sitename" => Setting::getParam('title'),
            "pagination" => Setting::getParam('title'),
            "pagination" => $pagination,
            "page" => $get['page'],
            "articles" => $articles
        ]);
    }
}
