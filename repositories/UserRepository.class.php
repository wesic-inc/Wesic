<?php

class UserRepository extends Basesql
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function signUp($data)
    {
        if (self::emailExists($data['email']) || self::loginExists($data['login'])) {
            return false;
        } else {
            $user = new User();
            $user->setLogin($data['login']);
            $user->setFirstname($data['firstname']);
            $user->setLastname($data['lastname']);
            $user->setRole($data['role']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password2']);
            $user->setCreationDate(date('Y-m-d H:i:s'));
            $user->setStatus(2);
            $user->setToken();
            $user->save();


            Passwordrecovery::confirmEmailNewUser($data['login']);


            return true;
        }
    }

    public static function newUser($data)
    {
        if (self::emailExists($data['email']) || self::loginExists($data['login'])) {
            return false;
        } else {
            $user = new User();
            $user->setLogin($data['login']);
            $user->setFirstname($data['firstname']);
            $user->setLastname($data['lastname']);
            $user->setRole($data['role']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password2']);
            $user->setCreationDate(date('Y-m-d H:i:s'));
            $user->setStatus(1);
            $user->setToken();
            $user->save();
        

            return true;
        }
    }

    public static function addUser($data)
    {
        if (self::emailExists($data['email']) || self::loginExists($data['login'])) {
            return false;
        } else {
            $user = new User();
            $user->setLogin($data['login']);
            $user->setFirstname($data['firstname']);
            $user->setLastname($data['lastname']);
            $user->setRole($data['role']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password2']);
            $user->setCreationDate(date('Y-m-d H:i:s'));
            $user->setStatus(1);
            $user->setToken();

            View::setFlash("Succès !", "L'utilisateur <i>".ucfirst($data['login'])."</i> a bien été ajouté", "success");


            $user->save();
        

            return true;
        }
    }



    public static function editUser($data)
    {
        $user = new User();
        
        $qb = new QueryBuilder();

        $userId = $qb->select('id')->from('user')->where('login', $data['login'])->getCol();


        $user->setId($userId);
        $user->setStatus($data['status']);
        $user->setEmail($data['email']);
        $user->setLogin($data['login']);
        $user->setFirstname($data['firstname']);
        $user->setLastname($data['lastname']);
        $user->setRole($data['role']);
        $user->save();
        
        View::setFlash("Succès !", "L'utilisateur <i>".ucfirst($data['login'])."</i> a bien été modifié", "success");

        return true;
    }


    public static function emailExists($email)
    {
        $user = new User();
        $users = $user->getData("user", ['email' => $email]);

        return !empty($users);
    }

    public static function loginExists($login)
    {
        $user = new User();

        $users = $user->getData('user', ["login"=>$login]);

        return !empty($users);
    }

    public static function modifyPassword($data)
    {
        $passwordrecovery = new Passwordrecovery();
        $result = $passwordrecovery->getData('passwordrecovery', ["token"=>$data['token']])[0];
        $user = new User();

        $user->setId($result['user_id']);
        $user->setPassword($data['passwordconfirm']);
        $user->setStatus(1);
        $user->save();
        $user->cleanUserSlugPasswordRecovery();

    
        return true;
    }

    public static function setUserStatus($id, $status)
    {
        if ($status == 1 || $status == 2 || $status == 3 || $status == 4 || $status == 5) {
            $user = new User();
            $user->setStatus($status);
            $user->setId($id);
            $user->save();
            return true;
        } else {
            return false;
        }
    }

    public static function signUpNewsletter($data)
    {
        if (self::emailExists($data['email']) || self::loginExists($data['email'])) {
            return false;
        } else {
            $user = new User();

            $user->setFirstname($data['name']);
            $user->setEmail($data['email']);
            $user->setLogin($data['email']);
            $user->setRole(5);
            $user->setCreationDate();
            $user->setStatus('2');
            $user->save();

            Passwordrecovery::confirmEmailNewsletter($data['email']);
            return true;
        }
    }
}