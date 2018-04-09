<?php

class Event extends Basesql{
	
	protected $id;
	protected $name;
	protected $description;
	protected $place;
	protected $externalurl;
	protected $date;
	protected $user_id;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = trim($name);
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function setPlace($place)
    {
        $this->place = trim($place);
    }

    public function getExternalurl()
    {
        return $this->externalurl;
    }

    public function setExternalurl($externalurl)
    {
        $this->externalurl = trim($externalurl);
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
}