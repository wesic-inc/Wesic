<?php

function themeEnv()
{
    return Singleton::theme();
}

function dump($a, $b = 0, $c = 1)
{
    Format::dump($a, $b, $c);
}
function dd($a, $c = 1)
{
    Format::dump($a, 1, $c);
}
function Req()
{
    return Singleton::request();
}

function setting($key)
{
    return Singleton::settings()[$key][2];
}

function get_scripts()
{
    echo '<script type="text/javascript" src="/public/js/jquery.min.js"></script>';

    foreach (themeEnv()['javascript'] as $value) {
        echo '<script type="text/javascript" src="/themes/'.setting('theme').'/assets/'.$value.'"></script>';
    }
}

function get_css()
{
    echo '<link rel="stylesheet" href="/public/icomoon/style.css">';
    foreach (themeEnv()['style'] as $value) {
        echo '<link rel="stylesheet" type="text/css" href="/themes/'.setting('theme').'/assets/'.$value.'">';
    }
}

function the_favicon()
{
    echo '<link rel="icon" type="image/png" href="'.ROOT_URL.setting("favicon").'" />';
}

function the_sitename($title = null)
{
    echo '<title>'.isset($title)?$title:setting('title').'</title>';
}

function seo_description($description = null)
{
    echo '<meta name="description" content="'.isset($description)?$description:"Mon site Wesic".'">';
}

function admin_bar()
{
    if (Auth::isConnected()) {
        include "views/modals/admin-navbar.mdl.php";
    }
}

function the_navbar()
{
    include('themes/'.setting('theme').'/views/templates/navbar.php');
}

function article_featured($class = null)
{
    if (isset(Singleton::bridge()['article']['path'])) {
        echo '<img src="'.Singleton::bridge()['article']['path'].'">';
    }
}

function article_title()
{
    echo Singleton::bridge()['article']['title'];
}
function article_content()
{
    echo Singleton::bridge()['article']['content'];
}
function article_date()
{
    echo Format::humanTime(Singleton::bridge()['article']['date']);
}
function the_comments()
{
    return Singleton::bridge()['path'];
}
