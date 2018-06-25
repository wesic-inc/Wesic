<?php

class Theme extends ThemeRepository
{
    protected $id;
    protected $title;
    protected $version;
    protected $author;

    public function updateOnKey(){
        return $this->id;
    }
    public function getPkStr(){
        return "id";
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


    public function getTitle()
    {
        return $this->title;
    }


    public function setTitle($title)
    {
        $this->title = ucfirst(strtolower(trim($title)));
    }


    public function getVersion()
    {
        return $this->version;
    }


    public function setVersion($version)
    {
        $this->version = $version;
    }


    public function getAuthor()
    {
        return $this->author;
    }


    public function setAuthor($author)
    {
        $this->author = $author;
    }
}
