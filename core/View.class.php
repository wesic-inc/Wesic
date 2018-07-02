<?php
class View
{
    protected $data = [];
    protected $view;
    protected $template;

    public function setView($view, $layout="template", $scope="back")
    {
        if ($scope == "back") {
            $path_view = "views/".$view.".view.php";
            $path_template = "views/templates/".$layout.".tpl.php";
        }
        if ($scope == "front") {
            $path_view = "themes/".setting('theme')."/views/".$view.".view.php";
            $path_template = "themes/".setting('theme')."/views/templates/".$layout.".tpl.php";
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

    public function createForm($form, $errors)
    {
        global $errors_msg;
        include "views/templates/form.tpl.php";
    }

    public function addModal($modal, $config=[], $errors=[])
    {
        global $errors_msg;
        include "views/modals/".$modal.".mdl.php";
    }

    public static function setFlash($title, $body, $type)
    {
        $_SESSION['flash-type'] = $type;
        $_SESSION['flash-title'] = $title;
        $_SESSION['flash-body'] = $body;
        $_SESSION['flash-id'] = uniqid();
    }

    public static function destroyFlash()
    {
        unset($_SESSION['flash-type']);
        unset($_SESSION['flash-title']);
        unset($_SESSION['flash-body']);
        unset($_SESSION['flash-id']);
    }

    public function assign($key, $value)
    {
        $this->data[$key]=$value;
    }

    public function massAssign($vars)
    {
        foreach ($vars as $key => $value) {
            $this->data[$key]=$value;
        }
    }

    public function __destruct()
    {
        global $a, $c, $sitename, $args;
        extract($this->data);
        
        include $this->template;
    }
}
