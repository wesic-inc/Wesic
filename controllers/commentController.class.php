<?php
class commentController
{
    public static function indexAction(Request $request)
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
            "elementNumber" => 0,
        ]);
    }

        public static function singleCommentAction(Request $request)
    {

        $post = $request->getPost();
        $param = $request->getParams();

        $qb = new QueryBuilder();

        $comment = $qb->all('comment')->where('id',$param['id'])->fetchOrFail();

        
        $v = new View();
        
        $v->setView("comment/view", "templateadmin");
        $v->massAssign([
            "title" => "Voir un commentaire",
            "icon" => "icon-bubbles2",
            "comment" => $comment,
        ]);
    }

    public static function disapproveCommentAction(Request $request)
    {
        Comment::setCommentStatus($request->getParam('id'), 3);
        Route::toUrl('/'.$request->getParam('redirect'));
    }

    public static function approveCommentAction(Request $request){
        Comment::setCommentStatus($request->getParam('id'), 1);
        Route::toUrl('/'.$request->getParam('redirect'));

    }    

    public static function deleteCommentAction(Request $request){
        Comment::setCommentStatus($request->getParam('id'), 5);
        Route::toUrl('/'.$request->getParam('redirect'));

    }    

    public static function reportCommentAction(Request $request){
        Comment::setCommentStatus($request->getParam('id'), 4);
        Route::toUrl('/'.$request->getParam('redirect'));

    }
}
