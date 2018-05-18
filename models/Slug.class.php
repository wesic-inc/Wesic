<?php 
class Slug extends Basesql{

	protected $slug;
	protected $type;

	public function __construct(){
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

    public static function getSlugTable(){

        $qb = new QueryBuilder();
        $slugDb = $qb->findAll('slug')->execute();


        $slugPartial = [];

        foreach ($slugDb as $value) {
            array_push($slugPartial, $value['slug']);
        }
        
        return array_merge( $slugPartial,Route::allRouteSlug());

    }
}
