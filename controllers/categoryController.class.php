<?php
class categoryController
{
    /**
     * [allCategoriesAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public static function allCategoriesAction(Request $request)
    {
        $post = $request->getPost();
        $get = $request->getGet();

        $form = Category::getFormNewCategory();
        $errors = [];

        $sort = null;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = Validator::check($form["struct"], $request->getPost());

            if (!$errors) {
                $request->setPost('type', 1);
                if (!Validator::process($form["struct"], $request->getPost(), 'new-category')) {
                    $errors = ["categorynew"];
                } else {
                    Route::redirect('Categories');
                }
            }
        }


        $qb = new QueryBuilder();
        $qb->findAll('category')->openBracket()->where('type', 1)->or()->where('type', 3)->closeBracket();

        // if (isset($get['s'])) {
        //     $search = $get['s'];
        //     $qb->and()->openBracket()->search('label', $search)->or()->search('slug', $search)->closeBracket();
        // }

        $categories = $qb->paginate(6);

        $v = new View();
        $v->setView("category/category", "templateadmin");
        $v->massAssign([
            "title" => "Catégories",
            "icon" => "icon-bookmarks",
            "form" => $form,
            "categories" => $categories,
            "elementNumber"=>$categories['pagination']['total'],
            "errors" => $errors,
            "sort" => $sort
        ]);
    }
    
    /**
     * [editCategoryAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public static function editCategoryAction(Request $request)
    {
        $post = $request->getPost();
        $param = $request->getParams();

        $form = Category::getFormEditCategory();
        $errors = [];


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $request->setPost(['id'], $param['id']);
            $errors = Validator::check($form["struct"], $request->getPost());

            if (!$errors) {
                $request->setPost(['type'], 1);

                if (!Validator::process($form["struct"], $request->getPost(), 'edit-category')) {
                    $errors=["categorynew"];
                } else {
                    Route::redirect('Categories');
                }
            }
        }

        $qb = new QueryBuilder();
        $category = $qb->findAll('category')->where('id', $param['id'])->fetchOrFail();

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

    /**
     * [deleteCategoryAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public static function deleteCategoryAction(Request $request)
    {
        $param = $request->getParams();
        
        Category::deleteCategory($param['id']);

        Route::redirect('Categories');
    }

    /**
     * [archiveAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public static function archiveAction(Request $request)
    {
        echo "oljkhhkhkm";
        // Stat::add(4, "lecture article", 3, $request());
    }

    /**
     * [allTagsAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public static function allTagsAction(Request $request)
    {
        $form = Category::getFormNewTag();
        $errors = [];

        $post = $request->getPost();
        $param = $request->getParams();


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = Validator::check($form["struct"], $post);

            if (!$errors) {
                $post['type'] = 2;
                if (!Validator::process($form["struct"], $post, 'new-category')) {
                    $errors=["categorynew"];
                } else {
                    Route::redirect('Tags');
                }
            }
        }

        $qb = new QueryBuilder();
        $tags = $qb->all('category')->where('type', 2)->paginate(10);

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
    /**
     * [editTagAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public static function editTagAction(Request $request)
    {
        $form = Category::getFormEditTag();
        $errors = [];

        $param = $request->getParams();
        $post = $request->getPost();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $args['post']['id'] = $param['id'];
            $errors = Validator::check($form["struct"], $post);

            if (!$errors) {

                $post['type'] = 2;
                $post['id'] = $param['id'];
                if (!Validator::process($form["struct"], $post, 'edit-category')) {
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

        $v = new View();
        $v->setView("category/edit-tag", "templateadmin");
        $v->massAssign([
            "title"=>"Modifier un tag",
            "icon"=>"icon-pushpin",
            "form"=>$form,
            "errors"=>$errors
        ]);
    }
}
