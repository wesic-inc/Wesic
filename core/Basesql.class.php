<?php
class basesql{

	private $table;
	private $pdo;
	private $columns = [];

	public function __construct(){
		$this->table = strtolower(get_called_class());
		
		Singleton::getInstance();

		$all_vars = get_object_vars($this);
		$class_vars = get_class_vars(get_class());
		$this->columns = array_keys(array_diff_key($all_vars, $class_vars));

	}

	public function setColumn(){
		$this->columns = array_diff_key(get_object_vars($this), get_class_vars(get_class())) ;
	}

	public function save(){
		$this->setColumn();

		if(isset($this->id) && is_numeric($this->id)) {
			//UPDATE
			//création des SET
			$sets = "";
			foreach ($this->columns as $key => $value) {
				$sets += $key." = :".$key." ";
			}
			//query
			$sql = "UPDATE ".$this->table." SET ".$sets." WHERE id = :id";
			$query = $this->pdo->prepare($sql);

			$query->execute($this->columns);
		} else {
			//INSERT
			unset($this->columns['id']);
			$sql = "INSERT INTO ".$this->table." (".implode(",", array_keys($this->columns)).")
			VALUES (:".implode(",:", array_keys($this->columns)).")";
			$query = $this->pdo->prepare($sql);

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

