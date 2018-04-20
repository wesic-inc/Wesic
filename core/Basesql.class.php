<?php
class basesql{

	private $table;
	private $pdo;
	private $columns = [];

	public function __construct(){
		$this->table = strtolower(get_called_class());
		
		$this->pdo = Singleton::getDB();

		$all_vars = get_object_vars($this);
		$class_vars = get_class_vars(get_class());
		$this->columns = array_keys(array_diff_key($all_vars, $class_vars));

	}

	public function setColumns(){
		

		$this->columns = array_diff_key(
					get_object_vars($this), 
					get_class_vars(get_class()));
	}


	public function save(){

		$this->setColumns();

		if( $this->id ){

			foreach ($this->columns as $key => $value) {
					if(isset($value) ){
						$sqlSet[] = $key."=:".$key;
					}else{
						unset($this->columns[$key]);
					}
				}

			$query = $this->pdo->prepare(" UPDATE ".$this->table." SET ".implode(", ", $sqlSet)." WHERE id=:id ");
			$query->execute($this->columns);


		}else{

			unset($this->columns['id']);

			$query = $this->pdo->prepare("
					INSERT INTO ".$this->table." 
					(". implode(",", array_keys($this->columns)) .")
					VALUES
					(:". implode(",:", array_keys($this->columns)) .")
				");

			$query->execute($this->columns);

		}
		


	}
	function getData($table, $condition = [], $operator = [], $orderby = "", $groupby = "", $limit = [], $columns = "*" ){
		$sql = 'SELECT '. $columns .' FROM '.$table.' ';

		if(!empty($condition))
		{
			$sql .='WHERE ';

			foreach ($condition as $key => $value) {
				if(is_string($value)){
					$list_of_conditions[] = $key."= :".$key;
				}else{
					switch ($value[0]) {
						case 'NOW()':
						$list_of_conditions[] = $key.' '.$value[1].' NOW()';
						break;
						case $value[1]=='LIKE':
						$list_of_conditions[] = $key.' '.$value[1].' \'%'.$value[0].'%\' ';
						break;
						case is_int($value[0]) || is_string($value[0]):
						$list_of_conditions[] = $key.' '.$value[1].' :'.$key;
						break;

					}
					$condition[$key] = $value[0];
				}

			}

			if( count($operator)+1 == count($condition) ){
				$i=0;
				foreach ($list_of_conditions as $conditions) {
					if($i < count($operator) )
						$sql .= $conditions.' '.$operator[$i].' ';
					else
						$sql .= $conditions.' ';
					$i++;
				}
			}
			else
				$sql .= implode(" AND ", $list_of_conditions);	
		}
		if(!empty($orderby))
			$sql .=' ORDER BY '.$orderby;
		if(!empty($groupby))
			$sql .=' GROUP BY '.$orderby;
		if(!empty($limit))
			$sql .=' LIMIT '.$limit[0].', '.$limit[1];

		$query = $this->pdo->prepare($sql);
		$query->execute($condition);
		return $query->fetchAll();

	}

	function slugExists($slug){

        $sql = "SELECT slug FROM article
        		WHERE slug = $slug
				UNION
				SELECT slug FROM event
				WHERE slug = $slug
				UNION
				SELECT slug FROM category
				WHERE slug = $slug
				UNION
				SELECT slug FROM page
				WHERE slug = $slug";

		$query = $this->pdo->prepare($sql);
		$query->execute($condition);
		return $query->fetchAll();

    }

}
