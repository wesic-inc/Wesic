<?php 
class Slug extends SlugRepository
{
    protected $slug;
    protected $type;

    public function updateOnKey(){
        return false;
    }
    public function getPkStr(){
        return "slug";
    }
    public function __construct()
    {
        parent::__construct();
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }
}
