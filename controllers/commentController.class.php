<?php

class commentController
{
    /**
     * Controller which display all comments in Wesic backoffice
     * @param  Request $request
     */
    public static function allCommentsAction(Request $request)
    {
        $post = $request->getPost();
        $get = $request->getGet();
        $param = $request->getParams();
        
        $filter = null;

        $qb = new QueryBuilder();
        $qb->select('comment.*,user.login,post.title,post.slug')
        ->from('comment')
        ->leftJoin('user', 'user.id = comment.user_id')
        ->leftJoin('post', 'post.id = comment.post_id');

        if (isset($param['filter'])) {
            $filter = $param['filter'];
            $qb->commentDisplayFilters($filter);
        } else {
            $qb->where('comment.status', '!=', 5);
        }

        $comments = $qb->paginate(10);
        
        $v = new View();
        
        $v->setView("comment/comments", "templateadmin");
        $v->massAssign([
            "title" => "Commentaires",
            "icon" => "icon-bubbles2",
            "comments" => $comments,
            "filter" => $filter,
            "elementNumber" => $comments['pagination']['total'],
        ]);
    }

    /**
     * Apply status change on multiple comments, ajax only
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function commentActionsAction(Request $request)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $selectIds = json_decode($request->getPost()['ids']);

            switch ($request->getParam('action')) {
                case 'delete':
                    foreach ($selectIds as $val) {
                        Comment::setCommentStatus($val, 5);
                    }
                    break;
                case 'approve':
                    foreach ($selectIds as $val) {
                        Comment::setCommentStatus($val, 1);
                    }               
                case 'disapprove':
                    foreach ($selectIds as $val) {
                        Comment::setCommentStatus($val, 3);
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
     * [singleCommentAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public static function singleCommentAction(Request $request)
    {
        $post = $request->getPost();
        $param = $request->getParams();

        $qb = new QueryBuilder();

        $comment = $qb->all('comment')->where('id', $param['id'])->fetchOrFail();

        
        $errors = [];

        $_POST['body'] = $comment['body'];
        $_POST['post_id'] = $comment['post_id'];

        if (isset($comment['user_id'])) {
            $form = Comment::getFormModerateConnectedComment();
            $_POST['user'] = $comment['user_id'];
        } else {
            $form = Comment::getFormModerateComment();
            $_POST['email'] = $comment['email'];
            $_POST['name'] = $comment['name'];
        }

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
        
        $v->setView("comment/view", "templateadmin");
        $v->massAssign([
            "title" => "Modérer un commentaire",
            "icon" => "icon-bubbles2",
            "comment" => $comment,
            "form" => $form,
            "errors" => $errors,
        ]);
    }

    /**
     * [terminatorAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public static function terminatorAction(Request $request)
    {
        dd($request);

        $v = new View();
        
        $v->setView("comment/view", "templateadmin");
        $v->massAssign([
            "title" => "Voir un commentaire",
            "icon" => "icon-bubbles2",
            "comment" => $comment,
            "form" => $form,
            "errors" => $errors,
        ]);
    }

    /**
     * [disapproveCommentAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public static function disapproveCommentAction(Request $request)
    {
        Comment::setCommentStatus($request->getParam('id'), 3);
        

        if ($request->getParam('redirect') == '1') {
            View::setFlash("Succès !", 'Lecommentaire a bien été desaprouvé', "success");
            Route::redirect('Comments');
        } else {
            Route::toUrl('/'.$request->getParam('redirect'));
        }
    }

    /**
     * [disapproveCommentAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public static function approveCommentAction(Request $request)
    {
        Comment::setCommentStatus($request->getParam('id'), 1);
        


        if ($request->getParam('redirect') == '1') {
            View::setFlash("Succès !", 'Le commentaire a bien été aprouvé', "success");
            Route::redirect('Comments');
        } else {
            Route::toUrl('/'.$request->getParam('redirect'));
        }
    }

    /**
     * [deleteCommentAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public static function deleteCommentAction(Request $request)
    {
        Comment::setCommentStatus($request->getParam('id'), 5);


        if ($request->getParam('redirect') == '1') {
            View::setFlash("Succès !", 'Le commentaire a bien été supprimé', "success");
            Route::redirect('Comments');
        } else {
            Route::toUrl('/'.$request->getParam('redirect'));
        }
    }
    
    /**
     * [deleteCommentAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public static function reportCommentAction(Request $request)
    {
        Comment::setCommentStatus($request->getParam('id'), 4);
        if ($request->getParam('redirect') == '1') {
            Route::redirect('Comments');
        } else {
            Route::toUrl('/'.$request->getParam('redirect'));
        }
    }
}
