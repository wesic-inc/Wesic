<?php
class pageController{
		public static function indexAction($args){
			echo "pages";
		}

public static function singleAction($args){

		$qb = new QueryBuilder();
		$page = 
		$qb->findAll('post')
		->addWhere('slug = :slug')
		->setParameter('slug',$args['slug'])
		->fetchOne();

		$v = new View();
		$v->setView("page/single");
		$v->assign("title",$page['title']);
		$v->assign("page", $page);

		Stat::add(1,"lecture page",2,$page['id']);
		

	}

	public function allPagesAction($args){
		

		$qbPage = new QueryBuilder();
		$qbPage->findAll('post')->addWhere('type = :type')->setParameter('type',2);

		$param = Route::checkParameters($args['params']);

		if($param == false){
			Route::redirect('allUsers');
		}


		$qb = new QueryBuilder();

		if( isset($param['filter']) ){
			
			$filter = true;
			$qbPage = Basesql::pageDisplayFilters($qbPage,$param['filter']);

			$qb->select('COUNT(id)')
			->from('post')
			->addWhere('type = :type')
			->setParameter('type',2);

			$qb = Basesql::pageDisplayFilters($qb,$param['filter']);		
			$countAll = $qb->fetchOne()[0];

			if(empty($countAll)){
				$countAll = 0;
			}

		}else{
				$countAll = 
		$qb ->select('COUNT(*)')
		->from('post')
		->addWhere('type = :type')
		->setParameter('type',2)
		->fetchOne()[0];

		}
		if( isset($param['p']) ){
			
			$pagination = true;
			$page = $param['p'];
		}

		if( isset($param['sort']) ){
			$sort = $param['sort'];
			$qbArticles = Basesql::pageDisplaySorting($qbPage,$sort);
		}

		$elementPerPage = 2;

		$nbPage = Format::pageCalc($count,$elementPerPage);

		if(!isset($page) || $page == 1){
			$pages = $qbPage->limit('0',$elementPerPage)->execute();
			$currentPage = 1;
		}else{
			if($page > $nbPage || $page < 1){
				Route::redirect('Pages');	
			}
			$currentPage = $page;
			$pages = $qbPage->limit($page*$elementPerPage-$elementPerPage,$elementPerPage)->execute();
		}
		
		$param_json = $param;
		$param_json['perPage'] = $elementPerPage;
		$param_json = json_encode($param_json);


		$v = new View();
		$v->setView("cms/pages","templateadmin");
		$v->assign("title", "Pages");
		$v->assign("icon", "icon-files-empty");
		$v->assign("pages",$pages);

		$v->assign("elementNumber",$countAll);

		$v->assign("filter",$param['filter']);
		
		$v->assign("nbPage",$nbPage);
		$v->assign("elementPerPage",$elementPerPage);
		$v->assign("currentPage",$currentPage);
		
		$v->assign("param_json",$param_json);
		$v->assign("params",$param);
		


	}	
	public function deletePageAction($args){
		

		$param = Route::checkParameters($args['params']);

		$qb = new QueryBuilder();
		$page = $qb
		->delete()
		->from('post')
		->addWhere('type = :type')
		->setParameter('type',2)
		->addWhere('id = :id')
		->setParameter('id',$param['id']);



		if(!empty($userFound)){
			User::setUserStatus($userFound['id'],5);
			Route::redirect('EditUser',$userFound['id']);
		}
	}
	public function newPageAction($args){


		$form = Post::getFormNewPage();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				!Validator::process($form["struct"], $args['post'], 'pagenew')?$errors=["pagenew"]:Route::redirect('AllArticles');
			}
		}
		$v = new View();
		$v->setView("cms/newpage","templateadmin");
		$v->assign("form", $form);
		$v->assign("title", "Nouvelle page");
		$v->assign("icon", "icon-file-text2");
		$v->assign("errors", $errors);
	}

		public function editPageAction($args){


		$form = Post::getFormEditPage();
		$errors = [];

		$param = Route::checkParameters($args['params']);

		if(!$param){
			Route::redirect('Pages');
		}


		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				$args['post']['id'] = $param['id'];
				!Validator::process($form["struct"], $args['post'], 'edit-page')?$errors=["pagenew"]:Route::redirect('Pages');
			}
		}

		$qb = new QueryBuilder();

		$data = $qb
		->findAll('post')
		->addWhere('id = :id')
		->setParameter('id',$param['id'])
		->and()
		->addWHere('type = :type')
		->setParameter('type',2)
		->fetchOne();
			
		if(	empty($data) ){
			Route::redirect('Pages');
		}

		$_POST['title'] = $data['title'];
		$_POST['wesic-wysiwyg'] = html_entity_decode($data['content']);
		$_POST['slug'] = $data['slug'];
		$_POST['aa'] = substr($data['datePublied'],0,4);
		$_POST['mm'] = substr($data['datePublied'],5,2);
		$_POST['jj'] = substr($data['datePublied'],8,2);
		$_POST['hh'] = substr($data['datePublied'],11,2);
		$_POST['mn'] = substr($data['datePublied'],14,2);
		$_POST['parent'] = $data['parent'];
		$_POST['model'] =  $data['model'];

		$v = new View();
		$v->setView("cms/newpage","templateadmin");
		$v->assign("form", $form);
		$v->assign("title", "Nouvelle page");
		$v->assign("icon", "icon-file-text2");
		$v->assign("errors", $errors);
	}
}	