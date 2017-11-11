<?php

	class tags extends basesql
	{
		protected $id;
		protected $name;

		public function __construct()
		{
			parent::__construct();
		}

		public function setId($id)
		{
			$this->id = trim($id);
		}
		public function setName($name)
		{
			$this->name = ucfirst($name);
		}

		public function getId()
		{
			return $this->id;
		}

		public function getName()
		{
			return $this->name;
		}
		
	}