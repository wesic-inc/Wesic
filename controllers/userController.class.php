<?php


class userController
{
    /**
     * [indexAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public static function indexAction($args)
    {
        echo "Profile";
    }
/**
 * [allUsersAction description]
 * @param  Request $request [description]
 * @return [type]           [description]
 */
    public function allUsersAction(Request $request)
    {
        $param = $request->getParams();
        $get = $request->getGet();
        $filter = null;
        $sort = null;

        $qbUsers = new QueryBuilder();
        $qbUsers->all('user');

        if (isset($param['filter'])) {
            $filter = $param['filter'];
            $qbUsers->userDisplayFilters($filter);
        } else {
            $qbUsers->where('status', "!=", 5);
        }

        if (isset($param['sort'])) {
            $sort = $param['sort'];
            $qbUsers->userDisplaySorting($sort);
        }

        if (isset($get['s'])) {
            $search = $get['s'];
            $qbUsers->all('user')->search('login', $search)->or()->search('email', $search)->or()->search('firstname', $search)->or()->search('lastname', $search);
        }

        $users = $qbUsers->paginate(10);

        $v = new View();

        $v->setView("cms/users", "templateadmin");
        $v->massAssign([
            "title"=>"Tous les utilisateurs",
            "icon"=>"icon-users",
            "filter"=>$filter,
            "sort"=>$sort,
            "elementNumber"=>$users['pagination']['total'],
            "users"=>$users

        ]);
    }

    /**
     * [userActionsAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function userActionsAction(Request $request)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $selectIds = json_decode($request->getPost()['ids']);
            switch ($request->getParam('action')) {
                case 'delete':
                    foreach ($selectIds as $val) {
                        User::setUserStatus($val,5);
                    }
                    break;                
                case 'ban':
                    foreach ($selectIds as $val) {
                        User::setUserStatus($val,4);
                    }
                    break;
                default:
                    break;
            }

        } else {
            Route::redirect('Error404');
        }
    }
/**
 * [addUserAction description]
 * @param Request $request [description]
 */
    public function addUserAction(Request $request)
    {
        $form = User::getFormNewUser();
        $errors = [];

        $post = $request->getPost();


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = Validator::check($form["struct"], $post);

            if (!$errors) {
                if (!Validator::process($form["struct"], $post, 'add-user')) {
                    $errors=["userexists"];
                } else {
                    Route::redirect('AllUsers');
                }
            }
        }

        $v = new View();
        $v->setView("cms/newuser", "templateadmin");
        $v->massAssign([
            "page"=>"adduser",
            "title"=> "Ajouter un utilisateur",
            "icon"=> "icon-user-plus",
            "form"=> $form,
            "errors"=> $errors
        ]);
    }
    /**
     * [flagDeleteUserAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function flagDeleteUserAction(Request $request)
    {
        $id = $request->getParam('id');

        User::setUserStatus($id, 5);

        Route::redirect('AllUsers');
    }
    /**
     * [editUserAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function editUserAction(Request $request)
    {
        $param = $request->getParams();
        $post = $request->getPost();

        $qb = new QueryBuilder();
        $editedUser = $qb->findAll('user')->where('id', $param['id'])->fetchOrFail();

        $form = User::getFormEditUser();
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = Validator::check($form["struct"], $post);

            if (!$errors) {
                $post['id'] = $param['id'];
                $errors = Validator::process($form["struct"], $post, 'edit-user');

                if (!$errors) {
                    Route::redirect('AllUsers');
                }
            }
        }

        $_POST["login"] = $editedUser['login'];
        $_POST["firstname"] = $editedUser['firstname'];
        $_POST["lastname"] = $editedUser['lastname'];
        $_POST["email"] = $editedUser['email'];
        $_POST["role"] = $editedUser['role'];
        $_POST["newpasswordlink"] = "/admin/nouveau-mot-de-passe/".$param['id'];
        $_POST["deleteuser1"] = "/admin/supprimer-utilisateur/".$param['id'];
        $_POST["deleteuser2"] = "/admin/detruire-utilisateur/".$param['id'];
        $_POST["status"] = $editedUser['status'];


        $v = new View();
        $v->setView("cms/newuser", "templateadmin");
        $v->massAssign([
            "page" =>"adduser",
            "title" => "Modifier un utilisateur",
            "icon" => "icon-user",
            "form" => $form,
            "errors" => $errors
        ]);
    }

    /**
     * [viewUserAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function viewUserAction(Request $request)
    {
        $param = $request->getParams();

        $qb = new QueryBuilder();
        $editedUser = $qb->all('user')->where('id', $param['id'])->fetchOrFail();

        $form = User::getFormViewUser();
        $errors = [];

        $_POST["login"] = $editedUser['login'];
        $_POST["firstname"] = $editedUser['firstname'];
        $_POST["lastname"] = $editedUser['lastname'];
        $_POST["email"] = $editedUser['email'];
        $_POST["role"] = $editedUser['role'];
        $_POST["editlink"] = "/admin/modifier-utilisateur/".$param['id'];

        $v = new View();
        
        $v->setView("cms/newuser", "templateadmin");
        $v->massAssign([
            "page"=>"adduser",
            "title"=>"Afficher un utilisateur",
            "icon"=>"icon-user",
            "form" => $form,
            "errors"=>$errors
        ]);
    }

    public function newPasswordConfirmationAction(Request $request)
    {

        $token = $request->getParam('token');

        $passwordrecovery = new Passwordrecovery();

        $qb = new QueryBuilder();
        $result = $qb->all('passwordrecovery')->where('token',$token)->fetchOrFail();

        $token_generated  = new DateTime($result['date']);

        if ($token_generated->format('U') > $token_generated->format('U') + 86400) {
            Route::redirect('Error404');
        } else {
            $form = User::getFormModifyPassword();
            $errors = [];

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $errors = Validator::check($form["struct"], $request->getPost());

                if (!$errors) {

                    $request->setPost('token',$token);
                    if (!Validator::process($form["struct"], $request->getPost(), 'modifypassword')) {
                        $errors=["password"];
                    } else {
                        Route::redirect('Login');
                    }
                }
            }

            $v = new View();
            $v->setView("login/modifypassword", "templateadmin-modal")
            ->massAssign([
                "title"=>"Connexion",
                "description"=>"Connexion",
                "form"=>$form,
                "errors"=>$errors
            ]);
        }
    }
    /**
     * [newAccountConfirmationAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function newAccountConfirmationAction(Request $request)
    {
        $param = $request->getParams();

        $qb = new QueryBuilder();

        $item = $qb->all('passwordrecovery')->where('slug', $param['token'])->fetchOrFail();

        $user = new User();

        $user->setId($item['user_id']);
        $user->setStatus(1);
        $user->save();

        $user->cleanUserSlugPasswordRecovery();

        $v = new View();
        $v->setView("login/emailconfirmed", "templateadmin-modal");
        $v->massAssign(["title"=>"Merci !","description"=>"Connexion"]);
    }
    /**
     * [newsletterConfirmationAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function newsletterConfirmationAction(Request $request)
    {
        $param = $request->getParams();

        $qb = new QueryBuilder();

        $item = $qb->all('passwordrecovery')->where('slug', $param['token'])->fetchOrFail();

        $user = new User();

        $user->setId($item['user_id']);
        $user->setStatus(1);
        $user->save();

        $user->cleanUserSlugPasswordRecovery();

        Format::dump($user, 1);

        $v = new View();
        $v->setView("login/emailconfirmed", "templateadmin-modal");
        $v->massAssign(["title"=>"Merci !","description"=>"Connexion"]);
    }
    /**
     * [forceNewPasswordAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public static function forceNewPasswordAction(Request $request)
    {
        $user = new User();
        $userFound = $user->getData("user", ['id' => $args['params'][0]])[0];
        if (!empty($userFound)) {
            Passwordrecovery::sendResetPassword($userFound['login']);
        }
    }
    /**
     * [disableUserAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function disableUserAction(Request $request)
    {
        $param = $request->getParams();

        $qb = new QueryBuilder();
        $userFound = $qb->all('user')->where('id', $param['id']);

        if (!empty($userFound)) {
            User::setUserStatus($userFound['id'], 3);
            Route::redirect('EditUser', $userFound['id']);
        }
    }
    /**
     * [banUserAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public function banUserAction($args)
    {
        $param = $request->getParams();

        $qb = new QueryBuilder();
        $userFound = $qb->all('user')->where('id', $param['id']);
        if (!empty($userFound)) {
            User::setUserStatus($userFound['id'], 4);
            Route::redirect('EditUser', $userFound['id']);
        }
    }
    /**
     * [deleteUserAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public function deleteUserAction($args)
    {
        $param = $request->getParams();

        $qb = new QueryBuilder();
        $userFound = $qb->all('user')->where('id', $param['id']);
        if (!empty($userFound)) {
            User::setUserStatus($userFound['id'], 5);
            Route::redirect('EditUser', $userFound['id']);
        }
    }
    /**
     * [destroyUserAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public function destroyUserAction($args)
    {
        echo "user boom boom";
    }
}
