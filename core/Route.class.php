<?php

if (!isset($_SESSION)) {
    session_start();
}

class Route
{
    public static function getRoot()
    {
        return getenv('HTTP_HOST')."/";
    }

    public static function get($route)
    {
        global $route_access;
        if (!empty($route_access[$route]['path'])) {
            return $route_access[$route]['path'];
        } else {
            return $route_access[$route]['error404'];
        }
    }

    public static function getAll($route)
    {
        global $route_access;
        if (!empty($route_access[$route]['path'])) {
            return ROOT_URL.$route_access[$route]['path'];
        } else {
            return $route_access[$route]['error404'];
        }
    }

    public static function assets($uri)
    {
        echo ROOT_URL.'public/'.$object;
    }

    public static function echo($route, $parameter = "")
    {
        echo self::getAll($route).$parameter;
    }

    public static function redirect($route, $parameter = "")
    {
        $redirect = 'location: '.self::getAll($route);
        if (!empty($parameter)) {
            $redirect .= "/".$parameter;
        }
        header($redirect);
    }

    public static function allRouteSlug()
    {
        global $route_access;
        $slugPartial = [];
        foreach ($route_access as $key => $value) {
            array_push($slugPartial, $value['path']);
        }
        return $slugPartial;
    }

    public static function getRouteInfo($route = "")
    {
        global $route_access;
        if (empty($route)) {
            $route = self::getRoute();
        }

        if (!is_null($route) && isset($route_access[$route])) {
            return [$route_access[$route]][0];
        } else {
            return null;
        }
    }

    public static function checkParameters($args)
    {
        $routeInfo = Route::getRouteInfo(Route::getRoute());

        $getParams = [];
        $validParams = [];

        if (count($args) == 0) {
            return true;
        }

        if (count($args)%2 != 0) {
            return false;
        }

        if (isset($routeInfo['params'])) {
            for ($i = 0,$j = 1; $i < count($args); $i = $i+2,$j = $j + 2) {
                if (isset($getParams[$args[$i]])) {
                    return false;
                }
                $getParams[$args[$i]] = $args[$j];
            }


            $expectedParams = $routeInfo['params'];

            foreach ($expectedParams as $key => $params) {
                if (isset($getParams[$key]) && !empty($getParams[$key]) && $params['optional'] == false) {
                    $typeFlag = self::validateParameterType($params['type'], $getParams[$key]);
                    $optionalFlag = true;
                } elseif ((!isset($getParams[$key]) && $params['optional'] == true) || (!empty($getParams[$key]) && $params['optional'] == true)) {
                    $optionalFlag = true;
                    $typeFlag = true;
                } else {
                    return false;
                }

                if ($optionalFlag == true && $typeFlag == true) {
                    $validParams[$key] = true;
                }
            }
            foreach ($getParams as $key => $value) {
                if (!isset($expectedParams[$key])) {
                    return false;
                }
            }
            foreach ($validParams as $value) {
                if ($value == false) {
                    return false;
                }
            }
            return $getParams;
        } else {
            return false;
        }
    }

    public static function makeParams($params, $key, $value)
    {
        $generatedParams = "";
        
        if ($value == 0) {
            unset($params[$key]);
        } else {
            $params[$key] = $value;
        }

        foreach ($params as $param => $val) {
            $generatedParams .= "/".$param."/".$val;
        }
        return $generatedParams;
    }

    public static function validateParameterType($type, $value)
    {
        $parameterFlag = false;
        
        if ($type=="boolean" && filter_var($value, FILTER_VALIDATE_BOOLEAN)) {
            $parameterFlag = true;
        }
        if ($type=="float" && filter_var($value, FILTER_VALIDATE_FLOAT)) {
            $parameterFlag = true;
        }
        if ($type=="email" && filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $parameterFlag = true;
        }
        if ($type=="int" && filter_var($value, FILTER_VALIDATE_INT)) {
            $parameterFlag = true;
        }
        if ($type=="ip" && filter_var($value, FILTER_VALIDATE_IP)) {
            $parameterFlag = true;
        }
        if ($type=="regex" && filter_var($value, FILTER_VALIDATE_REGEXP)) {
            $parameterFlag = true;
        }
        if ($type=="url" && filter_var($value, FILTER_VALIDATE_URL)) {
            $parameterFlag = true;
        }

        return $parameterFlag;
    }

    public static function getPermissions($route)
    {
        $connected = Auth::isConnected();
        $rights = Auth::isAdmin();

        global $route_access;

        if ($route['c'] !== "" && $route['a'] === "") {
            $route['a'] = "index";
        }

        $matched_route = in_array($route['c'].'/'.$route['a'], array_keys($route_access));

        switch ($route_access[$route['c'].'/'.$route['a']]) {
            case 'admin':
            if ($connected == true && $rights == true) {
                return true;
            }
                // no break
            case 'user':
            if ($connected == true) {
                return true;
            }
            break;
            case 'all':
            return true;
            break;
            default:
            return true;
            break;
        }
        return false;
    }

    public static function getPermissionsDev($route)
    {
        $connected = Auth::isConnected();
        $rights = Auth::getRights();

        switch ($route['r']) {
            case 'admin':
            if ($connected == 1 && $rights == 4) {
                return true;
            }
            break;
            case 'moderator':
            if ($connected == true && $rights == 3 || $connected == true && $rights == 4) {
                return true;
            }
            break;
            case 'webmaster':
            if ($connected == true && $rights == 2 || $connected == true && $rights == 3 || $connected == true && $rights == 4) {
                return true;
            }
            break;
            case 'user':
            if ($connected == true && $rights == 1
                || $connected == true && $rights == 2
                || $connected == true && $rights == 3
                || $connected == true && $rights == 4) {
                return true;
            }
            break;
            case 'connected':
            if ($connected != true) {
                return true;
            }
            break;
            case 'all':
            return true;
            break;
            default:
            return false;
            break;
        }
        return $route['redirect'];
    }

    public static function getUri()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $explode_uri = explode("?", $uri);
        $uri = explode('/', $explode_uri[0]);
        $params = $uri;
        if (isset($uri[2])) {
            $uri = $uri[0].'/'.$uri[1].'/'.$uri[2];
        } else {
            $uri = $uri[0].'/'.$uri[1].'/';
        }
        $uri = trim(str_replace(PATH_ROOT, "", $uri), "/");
        unset($params[0]);
        unset($params[1]);
        unset($params[2]);

        foreach ($params as $key => $value) {
            if (empty($value)) {
                unset($params[$key]);
            }
        }

        return [$uri,$params];
    }

    public static function getRoute()
    {
        global $route_access;

        $uri = self::getUri()[0];

        foreach ($route_access as $key=>$rules) {
            if ($uri == $rules['path']) {
                return $key;
            }
        }

        self::getUri()[0];
    }

    public static function makeRouting()
    {
        global $rof;
        global $a;
        global $c;
        global $args;
        $redirect = null;

        $uri = self::getUri()[0];
        $params = self::getUri()[1];


        foreach ($rof['routing'] as $rules) {
            if ($uri == $rules['path']) {
                $c = explode(":", $rules['controller'])[0];
                $a = explode(":", $rules['controller'])[1];
                $r = $rules['restricted'];
                if (isset($rules['redirect'])) {
                    $redirect = $rules['redirect'];
                }

                $args = [
                    'request'=>$_REQUEST,
                    'post'=>$_POST,
                    'get'=>$_GET,
                    'params'=> self::checkParameters(array_values($params))
                ];
            }
        }

        $request = Singleton::request();

        $currentUser = Singleton::getUser();

        if ($c == null && $a == null) {
            $qb = new QueryBuilder();
            $slugFound = $qb->findAll('slug')->where('slug', $uri)->fetchOne();
            if (empty($slugFound)){
                $c = 'error';
                $a = 'notFound';
                $r = 'all';
            } else{
                switch ($slugFound['type']) {
                    case 1:
                    $c = 'article';
                    $a = 'single';
                    $args['slug'] = $slugFound['slug'];
                    $request->setParam('slug', $slugFound['slug']);
                    break;
                    case 2:
                    $c = 'page';
                    $a = 'single';
                    $args['slug'] = $slugFound['slug'];
                    $request->setParam('slug', $slugFound['slug']);
                    break;
                    case 3:
                    $c = 'category';
                    $a = 'archive';
                    $args['slug'] = $slugFound['slug'];
                    $request->setParam('slug', $slugFound['slug']);
                    break;
                    case 4:
                    $c = 'user';
                    $a = 'newPasswordConfirmation';
                    $args['token'] = $slugFound['slug'];
                    $request->setParam('token', $slugFound['slug']);
                    break;
                    case 5:
                    $c = 'user';
                    $a = 'newAccountConfirmation';
                    $args['token'] = $slugFound['slug'];
                    $request->setParam('token', $slugFound['slug']);
                    break;
                    case 6:
                    $c = 'user';
                    $a = 'newsletterConfirmation';
                    $args['token'] = $slugFound['slug'];
                    $request->setParam('token', $slugFound['slug']);
                    break;
                    default:
                    $c = 'error';
                    $a = 'notFound';
                    $r = 'all';
                    break;
                }
                $r = 'all';
            }
        }

        if (!$request->getParams()) {
            $c = 'error';
            $a = 'notFound';
            $r = 'all';
        }
        return ['a' => $a, 'c' => $c, 'r' => $r, 'redirect'=>$redirect, 'args' => $args, 'request'=>$request  ];
    }
}
