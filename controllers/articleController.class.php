<?php
class articleController{
	public static function indexAction($args){

	}

	public static function singleAction($args){

		$qb = new QueryBuilder();
		$article = 
		$qb->findAll('post')
		->addWhere('slug = :slug')
		->setParameter('slug',$args['slug'])
		->and()
		->addWhere('status = :status')
		->setParameter('status',1)
		->fetchOne();

		if(empty($article)){
			Route::redirect('Error404');
		}

		dump($article);
		$v = new View();
		$v->setView("article/single");
		$v->assign("article", $article);
		
		Stat::add(1,"lecture article",1,$article['id']);

	}

	public function allArticlesAction($args){
		
		$qbArticles = new QueryBuilder();
		$qbArticles->findAll('post')->addWhere('type = :type')->setParameter('type',1);

		$param = Route::checkParameters($args['params']);

		if($param == false){
			Route::redirect('allUsers');
		}

		$qb = new QueryBuilder();

		if( isset($param['filter']) ){
			
			$filter = true;
			$qbArticles = Basesql::articleDisplayFilters($qbArticles,$param['filter']);

			$qb->select('COUNT(id)')
			->from('post')
			->addWhere('type = :type')
			->setParameter('type',1);

			$qb = Basesql::articleDisplayFilters($qb,$param['filter']);		
			$countAll = $qb->fetchOne()[0];

			if(empty($countAll)){
				$countAll = 0;
			}

		}else{
				$countAll = 
		$qb ->select('COUNT(*)')
		->from('post')
		->addWhere('type = :type')
		->setParameter('type',1)
		->fetchOne()[0];

		}
		if( isset($param['p']) ){
			
			$pagination = true;
			$page = $param['p'];
		}

		if( isset($param['sort']) ){
			$sort = $param['sort'];
			$qbArticles = Basesql::articleDisplaySorting($qbArticles,$sort);
		}
	

		$elementPerPage = 3;

		$nbPage = Format::pageCalc($countAll,$elementPerPage);

		if(!isset($page) || $page == 1){
			$articles = $qbArticles->limit('0',$elementPerPage)->execute();
			$currentPage = 1;
		}else{
			if($page > $nbPage || $page < 1){
				Route::redirect('AllArticles');	
			}
			$currentPage = $page;
			$articles = $qbArticles->limit($page*$elementPerPage-$elementPerPage,$elementPerPage)->execute();
		}
		
		$param_json = $param;
		$param_json['perPage'] = $elementPerPage;
		$param_json = json_encode($param_json);

		$v = new View();
		$v->setView("cms/articles","templateadmin");
		$v->assign("title", "Articles");
		$v->assign("icon", "icon-newspaper");
		$v->assign("articles",$articles);

		$v->assign("elementNumber",$countAll);

		$v->assign("filter",$param['filter']);
		
		$v->assign("nbPage",$nbPage);
		$v->assign("elementPerPage",$elementPerPage);
		$v->assign("currentPage",$currentPage);
		
		$v->assign("param_json",$param_json);
		$v->assign("params",$param);



	}

		public function allArticlesAjaxAction($args){

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$qbArticles = new QueryBuilder();
			$qbArticles
			->select('*')
			->from('post')
			->addWHere('type = :type')
			->setParameter('type',1);

			$param = Route::checkParameters($args['params']);

			switch ($param['sort']) {
				case 1:
					$qbArticles->OrderBy('title','DESC');
					break;
				case -1:
					$qbArticles->OrderBy('title','ASC');
					break;
				case 2:
					$qbArticles->OrderBy('status','DESC');
					break;
				case -2:
					$qbArticles->OrderBy('status','ASC');
					break;
				case 3:
					$qbArticles->OrderBy('user_id','DESC');
					break;
				case -3:
					$qbArticles->OrderBy('user_id','ASC');
					break;
				case 4:
					$qbArticles->OrderBy('datePublied','DESC');
					break;
				case -4:
					$qbArticles->OrderBy('datePublied','ASC');
					break;
				default:
					return false;
				break;
			}			

			$articles = $qbArticles->execute();
			$v = new View();
			$v->setView("ajax/allArticles","templateajax");
			$v->assign("articles",$articles);
		}
		
	}
	public function newArticleAction($args){


		$form = Post::getFormNewArticle();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'articlenew')?$errors=["articlenew"]:Route::redirect('AllArticles');
			}
		}
		$v = new View();
		$v->setView("cms/newarticle","templateadmin");
		$v->assign("pseudo", $userFound['firstname']." ".$userFound['lastname']);
		$v->assign("form", $form);
		$v->assign("title", "Nouvel article");
		$v->assign("icon", "icon-pen");
		$v->assign("errors", $errors);
	}

	public function editArticleAction($args){


		$form = Post::getFormEditArticle();
		$errors = [];


		$param = Route::checkParameters($args['params']);

		if(!$param){
			Route::redirect('AllArticles');
		}


		if($_SERVER["REQUEST_METHOD"] == "POST"){
				$args['post']['id'] = $param['id'];
			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'edit-article')?$errors=["articlenew"]:Route::redirect('AllArticles');
			}
		}

		$qb = new QueryBuilder();

		$data = $qb
		->findAll('post')
		->addWhere('id = :id')
		->setParameter('id',$param['id'])
		->and()
		->addWHere('type = :type')
		->setParameter('type',1)
		->fetchOne();
			
		if(	empty($data) ){
			Route::redirect('AllArticles');
		}

		$_POST['title'] = $data['title'];
		$_POST['wesic-wysiwyg'] = html_entity_decode($data['content']);
		$_POST['slug'] = $data['slug'];
		$_POST['aa'] = substr($data['datePublied'],0,4);
		$_POST['mm'] = substr($data['datePublied'],5,2);
		$_POST['jj'] = substr($data['datePublied'],8,2);
		$_POST['hh'] = substr($data['datePublied'],11,2);
		$_POST['mn'] = substr($data['datePublied'],14,2);
		$_POST['visibility'] = $data['visibility'];
		$_POST['category'] = $data['category'];
		$_POST['excerpt'] = $data['excerpt'];
		$_POST['description'] = $data['description'];
		$_POST['category'] = Category::getCategory($data['id']);
		
		$v = new View();
		$v->setView("cms/newarticle","templateadmin");
		$v->assign("form", $form);
		$v->assign("title", "Nouvel article");
		$v->assign("icon", "icon-pen");
		$v->assign("errors", $errors);
	}

	public static function deleteArticleAction($args){
		$param = Route::checkParameters($args['params']);

		if($param == false){
			Route::redirect('Categories');
		}

		Post::deleteArticle($param['id']);

		Route::redirect('AllArticles');

	} 

	public function getRssAction($args){

		$qb = new QueryBuilder();

		$pagination = Setting::getParam('pagination-rss');
		
		$qb->findAll('post')
		->addWhere('status = :status')
		->setParameter('status',1)
		->and()
		->addWhere('datePublied <= :date')
		->setParameter('date',date("Y-m-d H:i:s"));

		if(!isset($_GET['page'])){

			$qb->limit('0',$pagination);
		
		}else{
			$qb->limit($_GET['page']*$pagination-$pagination,$pagination);
		}
	
		$articles = $qb->execute();

		$v = new View();
		$v->setView("article/rss","templateajax");
		$v->assign("title", "Flux RSS");
		$v->assign("icon", "icon-pen");

		$v->assign("url", Setting::getParam('url'));
		$v->assign("sitename", Setting::getParam('title'));
		$v->assign("pagination", Setting::getParam('title'));
		$v->assign("sitename", Setting::getParam('title'));

		$v->assign("pagination", $pagination);
		$v->assign("page", $_GET['page']);


		$v->assign("articles", $articles);

	}
}