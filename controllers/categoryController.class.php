<?php
class categoryController{

	public static function allCategoriesAction($args){



		$form = Category::getFormNewCategory();
		$errors = [];


		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				$args['post']['type'] = 1;
				!Validator::process($form["struct"], $args['post'], 'new-category')?$errors=["categorynew"]:Route::redirect('Categories');
			}
		}

		$qb = new QueryBuilder();
		$categories = $qb->findAll('category')
		->addWhere('type = :type')
		->setParameter('type',1)
		->or()
		->addWhere('type = :type2')
		->setParameter('type2',3)
		->execute();

		$v = new View();
		$v->setView("category/category","templateadmin");
		$v->assign("pseudo", $userFound['firstname']." ".$userFound['lastname']);
		$v->assign("title", "Catégories");
		$v->assign("icon", "icon-bookmarks");
		$v->assign("form", $form);
		$v->assign("categories", $categories);
		$v->assign("errors", $errors);

	} 

	public static function editCategoryAction($args){



		$form = Category::getFormEditCategory();
		$errors = [];

		$param = Route::checkParameters($args['params']);

		if($param == false){
			Route::redirect('allUsers');
		}

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$args['post']['id'] = $param['id'];
			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				$args['post']['type'] = 1;
				!Validator::process($form["struct"], $args['post'], 'edit-category')?$errors=["categorynew"]:Route::redirect('Categories');
			}
		}

		$qb = new QueryBuilder();
		$category = $qb->findAll('category')
		->addWhere('id = :id')
		->setParameter('id',$param['id'])
		->fetchOne();

		$_POST['label'] = $category['label'];
		$_POST['slug'] = $category['slug'];

		$v = new View();
		$v->setView("category/edit","templateadmin");
		$v->assign("pseudo", $userFound['firstname']." ".$userFound['lastname']);
		$v->assign("title", "Modifier une catégorie");
		$v->assign("icon", "icon-bookmarks");
		$v->assign("form", $form);
		$v->assign("errors", $errors);

	}
	 	
	public static function deleteCategoryAction($args){
		$param = Route::checkParameters($args['params']);

		if($param == false){
			Route::redirect('Categories');
		}

		Category::deleteCategory($param['id']);

		Route::redirect('Categories');

	} 

	public static function archiveAction($args){

		echo "oljkhhkhkm";

	} 

	public static function allTagsAction($args){

		$form = Category::getFormNewTag();
		$errors = [];


		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				$args['post']['type'] = 2;
				!Validator::process($form["struct"], $args['post'], 'new-category')?$errors=["categorynew"]:Route::redirect('Tags');
			}
		}

		$qb = new QueryBuilder();
		$tags = $qb->findAll('category')
		->addWhere('type = :type')
		->setParameter('type',2)
		->execute();

		$v = new View();
		$v->setView("category/tag","templateadmin");

		$v->assign("title", "Tags");
		$v->assign("icon", "icon-pushpin");
		$v->assign("form", $form);
		$v->assign("tags", $tags);
		$v->assign("errors", $errors);
	}

		public static function editTagAction($args){



		$form = Category::getFormEditCategory();
		$errors = [];

		$param = Route::checkParameters($args['params']);

		if($param == false){
			Route::redirect('allUsers');
		}

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$args['post']['id'] = $param['id'];
			$errors = Validator::check($form["struct"], $args['post']);

			if(!$errors){
				$args['post']['type'] = 2;
				!Validator::process($form["struct"], $args['post'], 'edit-category')?$errors=["categorynew"]:Route::redirect('Tags');
			}
		}

		$qb = new QueryBuilder();
		$category = $qb->findAll('category')
		->addWhere('id = :id')
		->setParameter('id',$param['id'])
		->fetchOne();

		$_POST['label'] = $category['label'];
		$_POST['slug'] = $category['slug'];

		$v = new View();
		$v->setView("category/edit-tag","templateadmin");
		$v->assign("pseudo", $userFound['firstname']." ".$userFound['lastname']);
		$v->assign("title", "Modifier un tag");
		$v->assign("icon", "icon-pushpin");
		$v->assign("form", $form);
		$v->assign("errors", $errors);

	} 
}