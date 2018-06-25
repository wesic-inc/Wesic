<?php
class categoryController
{
    public static function allCategoriesAction(Request $request)
    {
        $post = $request->getPost();
        $get = $request->getGet();

        $form = Category::getFormNewCategory();
        $errors = [];


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = Validator::check($form["struct"], $post);

            if (!$errors) {
                $args['post']['type'] = 1;
                if (!Validator::process($form["struct"], $post, 'new-category')) {
                    $errors = ["categorynew"];
                } else {
                    Route::redirect('Categories');
                }
            }
        }

        $qb = new QueryBuilder();
        $qb->findAll('category')->where('type', 1)->or()->addWhere('type', 3);

        // if (isset($get['s'])) {
        // 	$search = $get['s'];
        // 	$qb->and()->openBracket()->search('label', $search)->or()->search('slug', $search)->closeBracket();
        // }

        $categories = $qb->get();

        $v = new View();
        $v->setView("category/category", "templateadmin");
        $v->massAssign([
            "title" => "Catégories",
            "icon" => "icon-bookmarks",
            "form" => $form,
            "categories" => $categories,
            "errors" => $errors
        ]);
    }

    public static function editCategoryAction(Request $request)
    {
        $post = $request->getPost();
        $param = $request->getParams();

        $form = Category::getFormEditCategory();
        $errors = [];


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $request->setPost(['id'], $param['id']);
            $errors = Validator::check($form["struct"], $post);

            if (!$errors) {

                $request->setPost(['type'], 1);

                if (!Validator::process($form["struct"], $post, 'edit-category')) {
                    $errors=["categorynew"];
                } else {
                    Route::redirect('Categories');
                }
            }
        }

        $qb = new QueryBuilder();
        $category = $qb->findAll('category')->where('id',$param['id'])->fetchOrFail();

        $_POST['label'] = $category['label'];
        $_POST['slug'] = $category['slug'];

        $v = new View();
        $v->setView("category/edit", "templateadmin");
        $v->assign([
            "pseudo" => $userFound['firstname']." ".$userFound['lastname'],
            "title" => "Modifier une catégorie",
            "icon" => "icon-bookmarks",
            "form" => $form,
            "errors" => $errors
        ]);
    }

    public static function deleteCategoryAction($args)
    {
        $param = $args['params'];
        
        Category::deleteCategory($param['id']);

        Route::redirect('Categories');
    }

    public static function archiveAction($args)
    {
        echo "oljkhhkhkm";
    }

    public static function allTagsAction($args)
    {
        $form = Category::getFormNewTag();
        $errors = [];


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = Validator::check($form["struct"], $args['post']);

            if (!$errors) {
                $args['post']['type'] = 2;
                if (!Validator::process($form["struct"], $args['post'], 'new-category')) {
                    $errors=["categorynew"];
                } else {
                    Route::redirect('Tags');
                }
            }
        }

        $qb = new QueryBuilder();
        $tags = $qb->findAll('category')
        ->addWhere('type = :type')
        ->setParameter('type', 2)
        ->execute();

        $v = new View();
        $v->setView("category/tag", "templateadmin");
        $v->massAssign([
            "title" => "Tags",
            "icon" => "icon-pushpin",
            "form" => $form,
            "tags" => $tags,
            "errors" => $errors
        ]);
    }

    public static function editTagAction($args)
    {
        $form = Category::getFormEditCategory();
        $errors = [];

        $param = $args['params'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $args['post']['id'] = $param['id'];
            $errors = Validator::check($form["struct"], $args['post']);

            if (!$errors) {
                $args['post']['type'] = 2;
                
                if (!Validator::process($form["struct"], $args['post'], 'edit-category')) {
                    $errors=["categorynew"];
                } else {
                    Route::redirect('Tags');
                }
            }
        }

        $qb = new QueryBuilder();
        $category = $qb->findAll('category')
        ->addWhere('id = :id')
        ->setParameter('id', $param['id'])
        ->fetchOne();

        $_POST['label'] = $category['label'];
        $_POST['slug'] = $category['slug'];

        $v = new View();
        $v->setView("category/edit-tag", "templateadmin");
        $v->massAssign([
            "pseudo"=>$userFound['firstname']." ".$userFound['lastname'],
            "title"=>"Modifier un tag",
            "icon"=>"icon-pushpin",
            "form"=>$form,
            "errors"=>$errors
        ]);
    }
}
