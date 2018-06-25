<?php

class Navbar extends NavbarRepository{

	protected $id;
	protected $name;
	protected $title;
	protected $url;
	protected $content_type;
	protected $contend_id;
	protected $slug;

    public function updateOnKey(){
        return $this->id;
    }
        public function getPkStr(){
        return "id";
    }
}