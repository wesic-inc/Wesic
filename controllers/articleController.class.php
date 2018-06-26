<?php
class articleController{
	public static function indexAction($args){

	}

	public static function singleAction(Request $request){

		$param = $request->getParams();

		$qb = new QueryBuilder();

		$results = $qb
		->select('p.id as articleid,p.title as title,p.content as content,p.description as seodesc,p.published_at as date,p.user_id as authorid,p.image as featured, co.*,u.login as username')
		->from('post AS p')
		->leftJoin('comment AS co','co.post_id = p.id')
		->leftJoin('user AS u','co.user_id = u.id')
		->where('p.slug',$param['slug'])
		->and()
		->where('co.status',1)
		->orderBy('co.created_at','DESC')
		->paginate(10);

		$v = new View();
		$v->setView("article","template","front")->assign("data",$results);

		Stat::add(1,"lecture article",1,$results[0]['id']);

	}

	public function allArticlesAction(Request $request){

		$qbArticles = new QueryBuilder();
		$qbArticles->all('post')->where('type',1);

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

        $articles = $qbArticles->paginate(10);

		$v = new View();
		
		$v->setView("cms/articles","templateadmin");
		$v->massAssign([
			"title"=>"Articles",
			"icon"=>"icon-newspaper",
			"articles"=>$articles,
			"elementNumber"=>Singleton::request()->getPaginate()['total'],
			"filter"=>$filter,
			"sort"=>$sort
		]);
	}

	public function allArticlesAjaxAction($args){

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$qbArticles = new QueryBuilder();
			$qbArticles
			->select('*')
			->from('post')
			->addWHere('type = :type')
			->setParameter('type',1);

			$param = $args['params'];

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
			$v->setView("ajax/allArticles","templateajax")->assign("articles",$articles);
		}
		
	}
	public function newArticleAction(Request $request){

		$post = $request->getPost();

		$form = Post::getFormNewArticle();
		$errors = [];

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$errors = Validator::check($form["struct"], $post);

			if(!$errors){
				if(!Validator::process($form["struct"], $post, 'articlenew')){
					$errors=["articlenew"];
				}else{
					Route::redirect('AllArticles');	
				}
			}
		}

		$v = new View();
		$v->setView("cms/newarticle","templateadmin");
		$v->massAssign([
			"form" => $form,
			"title" => "Nouvel article",
			"icon" => "icon-pen",
			"errors" => $errors
		]);
	}

	public function editArticleAction(Request $request){

		$post = $request->getPost();
		$param = $request->getParams();

		$form = Post::getFormEditArticle();
		$errors = [];


		if($_SERVER["REQUEST_METHOD"] == "POST"){

            $request->setPost(['id'], $param['id']);

			$errors = Validator::check($form["struct"], $post);

			if(!$errors){
				if(!Validator::process($form["struct"], $post, 'edit-article')){
					$errors=["articlenew"];
				}else{
					Route::redirect('AllArticles');
				}
			}
		}

		$qb = new QueryBuilder();
		$data = $qb->all('post')->where('id',$param['id'])->and()->where('type',1)->fetchOrFail();

		$_POST['title'] = $data['title'];
		$_POST['wesic-wysiwyg'] = html_entity_decode($data['content']);
		$_POST['slug'] = $data['slug'];
		$_POST['aa'] = substr($data['published_at'],0,4);
		$_POST['mm'] = substr($data['published_at'],5,2);
		$_POST['jj'] = substr($data['published_at'],8,2);
		$_POST['hh'] = substr($data['published_at'],11,2);
		$_POST['mn'] = substr($data['published_at'],14,2);
		$_POST['visibility'] = $data['visibility'];
		$_POST['excerpt'] = $data['excerpt'];
		$_POST['description'] = $data['description'];
		$_POST['category'] = Category::getCategory($data['id']);
		
		$v = new View();
		$v->setView("cms/newarticle","templateadmin");
		$v->massAssign([
			"form"=>$form,
			"title" => "Nouvel article",
			"icon" => "icon-pen",
			"errors" => $errors
		]);
	}

	public static function deleteArticleAction(Request $request){

		$param = $request->getParams();

		Post::deleteArticle($param['id']);

		Route::redirect('AllArticles');

	} 

	public function getRssAction(Request $request){

		$get = $request->getGet();

		$qb = new QueryBuilder();

		$pagination = Setting::getParam('pagination-rss');
		
		$qb->findAll('post')->where('status',1)->and()->addWhere('datePublied','<=',date("Y-m-d H:i:s"));

		if(!isset($get['page'])){
			$qb->limit('0',$pagination);

		}else{
			$qb->limit($get['page']*$pagination-$pagination,$pagination);
		}

		$articles = $qb->get();

		$v = new View();
		$v->setView("article/rss","templateajax");
		$v->massAssign([
			"title" => "Flux RSS",
			"icon" => "icon-pen",
			"url" => Setting::getParam('url'),
			"sitename" => Setting::getParam('title'),
			"pagination" => Setting::getParam('title'),
			"pagination" => $pagination,
			"page" => $_GET['page'],
			"articles" => $articles
		]);
	}
}