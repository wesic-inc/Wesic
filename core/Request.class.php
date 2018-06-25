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
     * @return mixed
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @param mixed $server
     *
     * @return self
     */
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
     * @param mixed $paginate
     *
     * @return self
     */
    public function setPaginate($count,$nbPage,$perPage,$current)
    {
        $this->paginate['total'] = $count;
        $this->paginate['totalPage'] = $nbPage;
        $this->paginate['perPage'] = $perPage;
        $this->paginate['elementNb'] = $perPage;
        $this->paginate['currentPage'] = $current;

        return $this;
    }
}
