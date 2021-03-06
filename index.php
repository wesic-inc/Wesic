<?php

/**
 * Inclusion du fichier qui gère toute la config
 */
require_once $_SERVER['DOCUMENT_ROOT']."/config/conf.inc.php";
require_once $_SERVER['DOCUMENT_ROOT']."/core/_aliases.php";

/**
 * [$debug description]
 * @var [type]
 */
if ($debug==true) {
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

    ini_set('display_errors', true);

} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

/**
 * [autoloader description]
 * @param  [type] $class [description]
 * @return [type]        [description]
 */
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



/**
 * [$route description]
 * @var [type]
 */
$route = Route::makeRouting();


$name_controller = $route["c"]."Controller";
$path_controller = "controllers/".$name_controller.".class.php";


if (file_exists($path_controller)) {
    if (!isset($_SESSION)) {
        session_start();
    }
    
    include $path_controller;
    $controller = new $name_controller;


// Permet la gestion des permissions (voir config/routing.yml)
    $permission = Route::getPermissions($route);

    if ($permission != 1) {
        if ($permission == 0 || is_null($permission)) {
            Route::redirect('Error404');
        }
        Route::redirect($permission);
    }

    $name_action = $route["a"]."Action";
    if (method_exists($controller, $name_action)) {
        $controller->$name_action($route["request"]);
        Stat::add(1,"view");
    } else {
        Route::redirect('Error404');
    }
} else {
    Route::redirect('Error404');
}
