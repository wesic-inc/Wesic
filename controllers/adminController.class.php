<?php
class adminController
{

	/**
	 * [indexAction description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function indexAction(Request $request)
    {
        $qb = new QueryBuilder();

        $articles = $qb->count('post')->where('type', 1)->getCol();
        $pages = $qb->count('post')->where('type', 2)->getCol();
        $comments = $qb->count('comment')->getCol();
        $events = $qb->count('event')->getCol();

        $qb->reset();
        
        $lastPosts =
        $qb->select('post.*,user.login')
        ->from('post')
        ->join('user', 'user.id = post.user_id')
        ->orderBy('published_at', 'DESC')
        ->limit(0, 5)
        ->get();

        $qb->reset();

        $lastComments =
        $qb->select('comment.*,user.login,post.slug,post.title')
        ->from('comment')
        ->leftJoin('user', 'user.id = comment.user_id')
        ->leftJoin('post', 'post.id = comment.post_id')
        ->where('comment.type', '!=', 5)
        ->and()
        ->where('post.status',1)
        ->orderBy('comment.created_at', 'DESC')
        ->limit(0, 5)
        ->get();

        $left = [setting('left-1'),setting('left-2'),setting('left-3'),setting('left-4'),setting('left-5')];
        $right = [setting('right-1'),setting('right-2'),setting('right-3'),setting('right-4'),setting('right-5')];

        $blockData = [
            'activity'=> ['data'=>$lastPosts],
            'comments'=> ['data'=>$lastComments],
            'quickview'=> ['data'=>[$articles,$pages,$comments,$events]],
            'stats'=> ['data'=>[$articles,$pages,$comments,$events]],
            'welcome-bloc'=> [],
            'links-bloc'=> [],
        ];

        $v = new View();
        $v->setView("admin/index", "templateadmin");
        $v->massAssign([
            "page" =>"adduser",
            "title" => "Dashboard",
            "icon" => "icon-home",
            "blockData" => $blockData,
            "left" => $left,
            "right" => $right,
        ]);
    }
    /**
     * [addUserAction description]
     * @param Request $request [description]
     */
    public function addUserAction(Request $request)
    {
        $post = $request->getPost();

        $form = User::getFormNewUser();
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = Validator::check($form["struct"], $post);

            if (!$errors) {
                header('Location: manageUsers');
            }
        }


        $v = new View();
        $v->setView("admin/adduser", "templateadmin");
        $v->massAssign([
            "page" =>"adduser",
            "title" => "Ajouter un utilisateur",
            "form" => $form,
            "errors" => $errors
        ]);
    }

    /**
     * [devTestAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public function devTestAction($args)
    {

        $qb = new QueryBuilder();

        $medias = $qb->all('media')->paginate(24);
        $qb->reset();
        $images = $qb->all('media')->where('type',1)->paginate(12);

        $v = new View();
        $v->setView('dev/template', 'templateadmin')
        ->massAssign([
            'title'=>'Test',
            'medias'=>$medias,
            'images'=>$images
        ]);
    }
}
