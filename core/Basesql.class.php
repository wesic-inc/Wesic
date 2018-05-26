<?php
class Basesql{

	private $table;
	protected $pdo;
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

	function delete() {

		$this->setColumns();

		$query = $this->pdo->prepare("DELETE FROM ".$this->table." WHERE id=:id ");
		$query->execute(array("id" => $this->columns["id"]));
		
	}

	function flagDelete() {

		$this->setColumns();
		$query = $this->pdo->prepare("UPDATE ".$this->table." SET status= 5 WHERE id=:id");
		$query->execute(array("id" => $this->columns["id"]));
	}

	function cleanUserSlugPasswordRecovery() {
		$this->setColumns();
		
		$query = $this->pdo->prepare("DELETE passwordrecovery, slug  
			FROM passwordrecovery
			INNER JOIN slug 
			ON slug.slug = passwordrecovery.slug
			WHERE passwordrecovery.user_id  =:id");

		$query->execute(array("id" => $this->columns["id"]));
	}

	function deleteSlugReference($table, $target){
		
		$query = $this->pdo->prepare("DELETE " . $table . ", slug  
			FROM " . $table . "
			INNER JOIN slug 
			ON slug.slug = " . $table . ".slug
			WHERE " . $table . ".slug  =:slug");

		$query->execute(array("slug" => " . $target . "));
	}


	function getData($table, $condition = [], $operator = [], $orderby = "", $groupby = "", $limit = [], $columns = "*" ){
		$sql = 'SELECT '. $columns .' FROM '.$table.' ';

		if(!empty($condition))
		{
			$sql .='WHERE ';

			foreach ($condition as $key => $value) {

				if(is_array($value)){
					$i = 0;
					foreach($value as $subvalue){
						if(is_string($subvalue)){
							$list_of_conditions[] = $key."= :".$key.$i;
						}else{
							switch ($subvalue[0]) {
								case 'NOW()':
								$list_of_conditions[] = $key.' '.$subvalue[1].' NOW()';
								break;
								case $subvalue[1]=='LIKE':
								$list_of_conditions[] = $key.' '.$subvalue[1].' \'%'.$subvalue[0].'%\' ';
								break;
								case is_int($subvalue[0]) || is_string($subvalue[0]):
								$list_of_conditions[] = $key.' '.$subvalue[1].' :'.$key.$i;
								break;

							}
							$condition[$key.$i] = $subvalue[0];
						}
						$i++;
					}
				}
				else{
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

	function fetchObject($dataFound){
		
	}

	public static function slugExists($slug){
		return in_array($slug, Slug::getSlugTable());
	}

	public static function userDisplayFilters($obj,$filter){

		switch ($filter) {
			case 1:
			$obj->openBracket()->addWhere('status != :status1')->setParameter('status1',5)->or()->addWhere('status != :status2')->setParameter('status2',2)->closeBracket()->and()->addWhere('role = :role')->setParameter('role',5);
			break;
			case 2:
			$obj->openBracket()->addWhere('status != :status1')->setParameter('status1',5)->or()->addWhere('status != :status2')->setParameter('status2',2)->closeBracket()->and()->addWhere('role = :role')->setParameter('role',2);
			break;
			case 3:
			$obj->openBracket()->addWhere('status != :status1')->setParameter('status1',5)->or()->addWhere('status != :status2')->setParameter('status2',2)->closeBracket()->and()->addWhere('role = :role')->setParameter('role',3);
			break;
			case 4:
			$obj->openBracket()->addWhere('status != :status1')->setParameter('status1',5)->or()->addWhere('status != :status2')->setParameter('status2',2)->closeBracket()->and()->addWhere('role = :role')->setParameter('role',4);
			break;
			case 5:
			$obj->addWhere('status = :status1')->setParameter('status1',5);
			break;
		}
		return $obj;
	}

	public static function userDisplaySorting($obj,$sort){

			switch ($sort) {
				case 1:
					$obj->OrderBy('login','DESC');
					break;
				case -1:
					$obj->OrderBy('login','ASC');
					break;
				case 2:
					$obj->OrderBy('lastname','DESC');
					break;
				case -2:
					$obj->OrderBy('lastname','ASC');
					break;
				case 3:
					$obj->OrderBy('email','ASC');
					break;
				case -3:
					$obj->OrderBy('email','DESC');
					break;
				case 4:
					$obj->OrderBy('role','DESC');
					break;
				case -4:
					$obj->OrderBy('role','ASC');
					break;
				default:
					return $obj;
				break;
			}
			return $obj;	
	}
		public static function articleDisplayFilters($obj,$filter){

		switch ($filter) {
			case 1:
			$obj
			->and()
			->addWhere('status = :status')
			->setParameter('status',1);
			break;
			case 2:
			$obj
			->and()
			->addWhere('status = :status')
			->setParameter('status',2);
			break;
		}
		return $obj;
	}

	public static function pageDisplayFilters($obj,$filter){

		switch ($filter) {
			case 1:
			$obj
			->and()
			->addWhere('status = :status')
			->setParameter('status',1);
			break;
		}
		return $obj;
	}

}


