<?php

class Request
{
    private $server;
    private $post;
    private $get;
    private $params = [];
    private $route;
    private $attributes;
    private $paginate;

    /**
     * [__construct description]
     * @param [type] $request  [description]
     * @param [type] $post     [description]
     * @param [type] $get      [description]
     * @param [type] $params   [description]
     * @param [type] $route    [description]
     * @param [type] $paginate [description]
     */
    public function __construct($request,$post,$get,$params,$route,$paginate = null)
    {
    	$this->server = $request; 
    	$this->post = $post; 
    	$this->get = $get; 
    	$this->params = $params;
    	$this->route = $route;
    	$this->paginate = $paginate; 
    }

    /**
     * [getServer description]
     * @return [type] [description]
     */
    public function getServer()
    {
        return $this->server;
    }

    
    public function setServer($server)
    {
        $this->server = $server;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     *
     * @return self
     */
    public function setPost($key,$value)
    {
        $this->post[$key] = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @param mixed $get
     *
     * @return self
     */
    public function setGet($get)
    {
        $this->get = $get;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getParam($key)
    {   if(isset($this->params[$key])){
        return $this->params[$key];
        }else{
            return null;
        }
    }

    /**
     * @param mixed $params
     *
     * @return self
     */
    public function setParam($key,$value)
    {
        if($this->params){
            $this->params = [];
            $this->params[$key] = $value;
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     *
     * @return self
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param mixed $attributes
     *
     * @return self
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaginate()
    {
        return $this->paginate;
    }

    /**
     * [setPaginate description]
     * @param [type] $count   [description]
     * @param [type] $nbPage  [description]
     * @param [type] $perPage [description]
     * @param [type] $current [description]
     */
    public function setPaginate($count,$nbPage,$perPage,$current)
    {
        $this->paginate[$model] = [];
        $this->paginate[$model]['total'] = $count;
        $this->paginate[$model]['totalPage'] = $nbPage;
        $this->paginate[$model]['perPage'] = $perPage;
        $this->paginate[$model]['elementNb'] = $perPage;
        $this->paginate[$model]['currentPage'] = $current;

        return $this;
    }
}
