<?php

class View
{
    protected $data = [];
    protected $view;
    protected $template;

    /**
     * [setView description]
     * @param [type] $view   [description]
     * @param string $layout [description]
     * @param string $scope  [description]
     */
    public function setView($view, $layout="template", $scope="back")
    {
        if ($scope == "back") {
            $path_view = "views/".$view.".view.php";
            $path_template = "views/templates/".$layout.".tpl.php";
        }
        if ($scope == "front") {
            $theme_dir = "themes/".setting('theme')."/views/";
            $path_view = $theme_dir.$view.".php";
            $path_template = $theme_dir.$layout.".php";
        }

        if (file_exists($path_view)) {
            $this->view=$path_view;

            if (file_exists($path_template)) {
                $this->template=$path_template;
            } else {
                Route::redirect('Error404');
            }
        } else {
            Route::redirect('Error404');
        }

        return $this;
    }

    /**
     * [createForm description]
     * @param  [type] $form   [description]
     * @param  [type] $errors [description]
     * @return [type]         [description]
     */
    public function createForm($form, $errors)
    {
        global $errors_msg;
        include "views/templates/form.tpl.php";
    }

    /**
     * Allow to get the view
     * @return [type] [description]
     */
    public function getViewInfos()
    {
        return $this->view;
    }

    /**
     * [addModal description]
     * @param [type] $modal  [description]
     * @param array  $config [description]
     * @param array  $errors [description]
     */
    public function addModal($modal, $config=[], $errors=[])
    {
        global $errors_msg;
        include "views/modals/".$modal.".mdl.php";
    }

    /**
     * [setFlash description]
     * @param [type] $title [description]
     * @param [type] $body  [description]
     * @param [type] $type  [description]
     */
    public static function setFlash($title, $body, $type)
    {
        $_SESSION['flash-type'] = $type;
        $_SESSION['flash-title'] = $title;
        $_SESSION['flash-body'] = $body;
        $_SESSION['flash-id'] = uniqid();
    }

    /**
     * [destroyFlash description]
     * @return [type] [description]
     */
    public static function destroyFlash()
    {
        unset($_SESSION['flash-type']);
        unset($_SESSION['flash-title']);
        unset($_SESSION['flash-body']);
        unset($_SESSION['flash-id']);
    }

    /**
     * [assign description]
     * @param  [type] $key   [description]
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function assign($key, $value)
    {
        $this->data[$key]=$value;
    }

    /**
     * [massAssign description]
     * @param  [type] $vars [description]
     * @return [type]       [description]
     */
    public function massAssign($vars)
    {
        foreach ($vars as $key => $value) {
            $this->data[$key]=$value;
        }
    }

    /**
     * [__destruct description]
     */
    public function __destruct()
    {
        global $a, $c;
        extract($this->data);

        include $this->template;
    }
}
