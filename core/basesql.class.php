<?php
class basesql{

	private $table;
	private $pdo;
	private $columns = [];

	public function __construct(){
		$this->table = get_called_class();
		$dsn = 'mysql:dbname='.DBNAME.';host='.DBHOST;

		try{
			$this->pdo = new PDO($dsn,DBUSER,DBPWD);
		}catch(Exception $e){
			die("Erreur SQL : ".$e->getMessage());
		}

		$all_vars = get_object_vars($this);
		$class_vars = get_class_vars(get_class());
		$this->columns = array_keys(array_diff_key($all_vars, $class_vars));

	}


	public function save(){
		
		if(is_numeric($this->id)){
			//UPDATE

		}else{
			//INSERT
			$sql = "INSERT INTO ".$this->table." (".implode(",", $this->columns).")
					VALUES (:".implode(",:", $this->columns).")";
			$query = $this->pdo->prepare($sql);

			foreach ($this->columns as $column) {
				$data[$column] = $this->$column;
			}
			
			$query->execute($data);
		}

	}


}




