<?php

if (!isset($_SESSION)) {
    session_start();
}


class errorController
{
/**
 * [indexAction description]
 * @return [type] [description]
 */
    public function indexAction()
    {
        $v = new View();
        $v->setView("error/error")->assign('title', 'Pas non trouvée');
    }
/**
 * [notFoundAction description]
 * @return [type] [description]
 */
    public function notFoundAction()
    {
        $v = new View();
        $v->setView("error/error404")->assign('title', "Erreur !");
    }
/**
 * [forbiddenAction description]
 * @return [type] [description]
 */
    public function forbiddenAction()
    {
        $v = new View();
        $v->setView("error/error403")->assign('title', 'Attention !');
    }
}
