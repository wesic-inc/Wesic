<?php

class Newsletter extends NewsletterRepository
{
    protected $id;
    protected $title;
    protected $body;
    protected $description;
    protected $created_at;
    protected $published_at;
    protected $status;
    protected $user_id;

    public function updateOnKey(){
        return $this->id;
    }
    public function getPkStr(){
        return "id";
    }
    public function __construct()
    {
        parent::__construct();
    }
}
