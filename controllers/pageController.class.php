<?php
class pageController{
	public static function indexAction(Request $request){
		echo "pages";
	}

	public static function singleAction(Request $request){

		$qb = new QueryBuilder();
		
		$page = $qb->findAll('post')->addWhere('slug = :slug')->setParameter('slug',$args['slug'])->fetchOrFail();

		Stat::add(1,"lecture page",2,$page['id']);

		$v = new View();
		$v->setView("page/single")->massAssign(["title"=>$page['title'],"page"=>$page]);

	}

	public function allPagesAction(Request $request){
		

		$param = $request->getParams();
		$get = $request->getGet();

		$filter = $sort = null;

		$qbPage = new QueryBuilder();

		$qbPage->all('post')->where('type',2);

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
            $qbPage->all('post')
            ->where('type',2)
            ->and()
            ->openBracket()
            ->search('login', $search)
            ->or()
            ->search('email', $search)
            ->closeBracket();
        }

        $pages = $qbPage->paginate(10);

		$v = new View();

		$v->setView("cms/pages","templateadmin");
		$v->massAssign([
			"title" => "Pages",
			"icon" =>"icon-files-empty",
			"pages" => $pages,
			"sort"=>$sort,
			"elementNumber" => Singleton::request()->getPaginate()['total'],
			"filter" => $param['filter'],
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