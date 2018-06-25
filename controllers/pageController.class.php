<?php
class pageController{
	public static function indexAction($args){
		echo "pages";
	}

	public static function singleAction($args){

		$qb = new QueryBuilder();
		
		$page = $qb->findAll('post')->addWhere('slug = :slug')->setParameter('slug',$args['slug'])->fetchOrFail();

		Stat::add(1,"lecture page",2,$page['id']);

		$v = new View();
		$v->setView("page/single")->massAssign(["title"=>$page['title'],"page"=>$page]);

	}

	public function allPagesAction($args){
		

		$qbPage = new QueryBuilder();

		$qbPage->findAll('post')->addWhere('type = :type')->setParameter('type',2);

		$param = $args['params'];

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
		$v->massAssign([
			"title" => "Pages",
			"icon" =>"icon-files-empty",
			"pages" => $pages,
			"elementNumber" => $countAll,
			"filter" => $param['filter'],
			"nbPage" => $nbPage,
			"elementPerPage" => $elementPerPage,
			"currentPage" => $currentPage,
			"param_json" => $param_json,
			"params" => $param
		]);
		


	}	
	public function deletePageAction($args){
		

		$param = $args['params'];

		Post::deletePage($param['id']);

		Route::redirect('Pages');

	}
	public function newPageAction($args){


		$form = Post::getFormNewPage();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				if(!Validator::process($form["struct"], $args['post'], 'pagenew')){
					$errors=["pagenew"];
				}
				else{
					Route::redirect('Pages');
				}

			}
		}
		$v = new View();

		$v->setView("cms/newpage","templateadmin");
		$v->massAssign([
			"form" => $form ,
			"title" => "Nouvelle page",
			"icon" => "icon-file-text2",
			"errors" => $errors
		]);
	}

	public function editPageAction($args){


		$form = Post::getFormEditPage();
		$errors = [];

		$param = $args['params'];

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				$args['post']['id'] = $param['id'];
				if(!Validator::process($form["struct"], $args['post'], 'edit-page')){
					$errors=["pagenew"];
				}
				else{
					Route::redirect('Pages');
				}
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
		$v->massAssign([
			"form" => $form,
			"title" => "Nouvelle page",
			"icon" => "icon-file-text2",
			"errors" => $errors
		]);
	}
}	