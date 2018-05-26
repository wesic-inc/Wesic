<?php

class QueryBuilder extends Basesql{

	private $query = "";
	private $selector = "";
	private $table = "";
	private $where = "";
	private $set = "";
	private $order = "";
	private $limit = "";
	private $join = "";
	private $groupBy = "";
	private $parameters = [];

	public function __construct(){
		parent::__construct();
	}

	public function select($columns){
		$this->selector .= "SELECT ";
		
		if(is_array($columns)){

			$lastElement = count($columns);
			$i = 1;
			foreach ($columns as $column) {
				$this->selector .= $column;
				if($i != $lastElement){
					$this->selector .= ", ";
				}else{
					$this->selector .= " ";
				}
				$i++;
			}

		}else{
			$this->selector .= $columns." ";
		}
		return $this;
	} 

	public function delete($table = ""){
		if(empty($table)){
			$this->selector .= "DELETE";
		}else{
			$this->selector .= "DELETE ".$table." ";
		}
		
		return $this;
	} 

	public function update($table){

		$this->selector .= "UPDATE ".$table." ";
		return $this;

	} 

	public function findAll($table){

		$this->selector = "SELECT *";
		$this->table = $table." ";

		return $this;

	}

	public function from($table,$alias = ""){
		$this->table .= " ".$table." ";
		if(!empty($alias)){
			$this->table .= "AS ".$alias." ";
		}
		return $this;

	}
	public function openBracket(){
		$this->where .= " (";
		return $this;
	}
	public function closeBracket(){
		$this->where .= ") ";
		return $this;
	}
	public function addWhere($where){
		$this->where .= " ".$where." ";
		return $this;
	}
	public function set($values){
		$this->set .= " ".$values." ";
		return $this;
	}
	public function setLike($parameter, $value){
		$this->parameters[$parameter] = '%'.$value.'%';
		return $this;
	}
	public function setParameter($parameter, $value){
		$this->parameters[$parameter] = $value;
		return $this;
	}
	public function addSeparator($separator){
		$this->where .= " ".$separator." ";
		return $this;
	}

	public function or(){
		$this->where .= " OR ";
		return $this;
	}

	public function and(){
		$this->where .= " AND ";
		return $this;
	}
	public function orderBy($column,$order){
		$this->order .= " ".$column." ".$order." ";
		return $this;
	}

	public function limit($limit,$offset){
		$this->limit .= " ".$limit.", ".$offset;
		return $this;
	}

	public function leftJoin($table,$condition){
		$this->join .= "LEFT JOIN ".$table;
		$this->join .= " ON ".$condition." ";
		return $this;
	}
	
	public function join($table, $condition){
		$this->join .= "JOIN ".$table;
		$this->join .= " ON ".$condition." ";
		return $this;
	}


	public function innerJoin($table, $condition){
		$this->join .= "INNER JOIN ".$table;
		$this->join .= " ON ".$condition." ";
		return $this;
	}

	public function debugObject(){
		return $this;
	}

	public function groupBy($group){
		$this->groupBy .= " ".$group." ";
		return $this;
	}

	public function reset(){
		$this->query = "";
		$this->selector = "";
		$this->table = "";
		$this->where = "";
		$this->set = "";
		$this->order = "";
		$this->limit = "";
		$this->groupBy = "";
		$this->join = "";
		$this->parameters = [];
		return $this;
	}

	public function execute(){

		if(!isset($this->selector) || !isset($this->table)){
			return false;
		}else{

			$this->query = 
			$this->selector
			." FROM ".$this->table
			.(!empty($this->join)?$this->join:"")
			.(!empty($this->where)?"WHERE".$this->where:"")
			.(!empty($this->groupBy)?"GROUP BY".$this->groupBy:"")
			.(!empty($this->order)?"ORDER BY".$this->order:"")
			.(!empty($this->limit)?"LIMIT".$this->limit:"");

			$query = $this->pdo->prepare($this->query);
			$query->execute($this->parameters);
			return $query->fetchAll();
			
		}

	}
	public function save(){

		if(!isset($this->selector) || !isset($this->table)){
			return false;
		}else{

			$this->query = 
			$this->selector
			." SET ".$this->set
			.(!empty($this->join)?$this->join:"")
			.(!empty($this->where)?"WHERE".$this->where:"")
			.(!empty($this->groupBy)?"GROUP BY".$this->groupBy:"")
			.(!empty($this->order)?"ORDER BY".$this->order:"")
			.(!empty($this->limit)?"LIMIT".$this->limit:"");
			$query = $this->pdo->prepare($this->query);
			$query->execute($this->parameters);
			return $query->fetchAll();
			
		}

	}

	public function fetchOne(){
		$result = $this->execute();

		if(empty($result))
		{
			return $result;
		}
		else
		{
			return $result[0];
		}
	}



}