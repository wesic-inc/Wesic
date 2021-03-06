<?php

require_once $_SERVER['DOCUMENT_ROOT']."/config/conf.inc.php";

function autoloader($class)
{
    if (file_exists("core/".$class.".class.php")) {
        include "core/".$class.".class.php";
    } elseif (file_exists("models/".$class.".class.php")) {
        include "models/".$class.".class.php";
    } elseif (file_exists("repositories/".$class.".class.php")) {
        include "repositories/".$class.".class.php";
    }
}

spl_autoload_register('autoloader');

function loadForm(){
    
    $post = $_POST;
    $finished = false;
    $setting = new Setting;
    $form = $setting->getInstallForm();
    $errors = [];

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $errors = Validator::check($form["struct"], $post);

        if(empty($errors)){

            $pdo = new BaseSql;
            $pdo->initDb();
            
            $setting = new Setting;

            $url = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'];

            $setting->setParam('url', $url);
            $setting->setParam('links-bloc', 1);
            $setting->setParam('title', $post['title']);
            $setting->setParam('email', $post['email']);
            $setting->setParam('welcome-bloc', 1);
            $setting->setParam('left-1', 'welcome-bloc');
            $setting->setParam('left-2', 'links-bloc');
            $setting->setParam('left-3', 'stats');
            $setting->setParam('right-1', 'quickview');
            $setting->setParam('right-2', 'activity');
            $setting->setParam('right-3', 'comments');
            $setting->setParam('theme', 'default');

            $user = new User();
            $user->setLogin($post['username']);
            $user->setFirstname("");
            $user->setLastname("");
            $user->setRole(4);
            $user->setEmail($post['email']);
            $user->setPassword($post['password2']);
            $user->setCreatedAt(date('Y-m-d H:i:s'));
            $user->setStatus(1);
            $user->setToken();
            $user->save();

            unlink('index.php');
            copy('config/utils/index.new.php','index.php');
            $finished = true;
        }
    }

    $yaml = extension_loaded('yaml');
    $gd = extension_loaded('gd');
    $pdo_mysql = extension_loaded('pdo_mysql');
    $pdo = extension_loaded('pdo');


    $v = new View();

    $v->setView("index/install","templateadmin-modal");
    $v->massAssign([
        "title" => "Installation",
        "config" => $form,
        "errors" => $errors,
        "finished" => $finished,
        "ext" => compact('yaml','gd','pdo_mysql','pdo')
    ]);


}

loadForm();
