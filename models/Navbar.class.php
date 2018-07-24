<?php

class Navbar extends NavbarRepository{

	protected $id;
	protected $navbar;

    public function updateOnKey(){
        return $this->id;
    }
        public function getPkStr(){
        return "id";
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNavbar()
    {
        return $this->navbar;
    }

    /**
     * @param mixed $navbar
     *
     * @return self
     */
    public function setNavbar($navbar)
    {
        $this->navbar = $navbar;

        return $this;
    }
}