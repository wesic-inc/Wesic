<?php
class adminController{

	public function indexAction(Request $request){
		
		$qb = new QueryBuilder();

		$articles = $qb->count('post')->where('type',1)->getCol();
		$pages = $qb->count('post')->where('type',2)->getCol();
		$comments = $qb->count('comment')->getCol();
		$events = $qb->count('event')->getCol();

		$qb->reset();
		
		$lastPosts = 
		$qb->select('post.*,user.login')
		->from('post')
		->join('user','user.id = post.user_id')
		->where('type',1)
		->orderBy('published_at','DESC')
		->limit(0,5)
		->get();		

		$qb->reset();

		$lastComments = 
		$qb->select('comment.*,user.login,post.slug,post.title')
		->from('comment')
		->leftJoin('user','user.id = comment.user_id')
		->leftJoin('post','post.id = comment.post_id')
		->where('comment.type','!=',5)
		->orderBy('comment.created_at','DESC')
		->limit(0,5)
		->get();


		$v = new View();
		$v->setView("admin/index","templateadmin");
		$v->massAssign([
			"page" =>"adduser",
			"title" => "Dashboard",
			"icon" => "icon-home",
			"articles" => $articles,
			"pages" => $pages,
			"comments" => $comments,
			"events" => $events,
			"lastPosts" => $lastPosts,
			"lastComments" => $lastComments,
		]);
	}

	public function addUserAction(Request $request){

		$post = $request->getPost();

		$form = User::getFormNewUser();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$errors = Validator::check($form["struct"], $post);

			if(!$errors)
				header('Location: manageUsers');
		}


		$v = new View();
		$v->setView("admin/adduser","templateadmin");
		$v->massAssign([
			"page" =>"adduser",
			"title" => "Ajouter un utilisateur",
			"form" => $form,
			"errors" => $errors
		]);

	}


	public function devTestAction($args){
		echo "lol";
		die();
		$v = new View();
		$v->setView('dev/template','templateadmin');
	}




}