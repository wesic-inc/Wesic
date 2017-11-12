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

	static function verifyLogin($login, $password){

		$user = new user();

		$user = $user->getUser(["login"=>$login]);
		if(empty($user)){
			return false;
		}else{

			$userFound = $user[0];

			if(!password_verify($password, $userFound["password"]) || $userFound["state"] == 2){				
				return false;
			}
			else{
				if(isset($_SESSION['token'])){
					session_unset();
					session_destroy();
				}
				if(!isset($_SESSION)){
					session_start();
				}
				iptable::resetAttempts(base::getIp());

				$validator = new validator();

				$_SESSION['id'] =  $userFound["id"];

				$_SESSION['token'] = login::createTokenAction($userFound);

				$_SESSION['time'] = time();

				error_log("[User] Connection succeed | Login ".$userFound["login"]);

				return true;
			}

		}

	}

	public static function verifyEmail($email,$id = ''){

		$user = new user();

		$user = $user->getUser(["email"=>$email]);
		if(count($user) != 0){
			if($id != '' && $user[0]['id'] == $id){
				return false;
			}
			return true;
		}
		return false;
	}

	public static function verifyIdLogin($login,$id = ''){

		$user = new user();

		$user = $user->getUser(["login"=>$login]);
		if(count($user) != 0){
			if($id != '' && $user[0]['id'] == $id){
				return false;
			}
			return true;
		}
		return false;
	}

}

