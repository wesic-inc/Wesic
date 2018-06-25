<?php

class Format {

	static function getRole($code){
		
		switch ($code) {
			case 1:
			return 'Utilisateur';
			break;
			case 2:
			return 'Community Manager';
			break;
			case 3:
			return 'Modérateur';
			break;
			case 4:
			return 'Administrateur';
			break;
			case 5:
			return 'Abonné';
			break;
			default:
			return false;
			break;
		}
	}

	static function getStatusUser($code){
		
		switch ($code) {
			case 1:
			return 'Actif';
			break;
			case 2:
			return 'En attente de confirmation e-mail';
			break;
			case 3:
			return 'Inactif';
			break;
			case 4:
			return 'Banni';
			break;
			case 5:
			return 'Supprimé';
			break;
			default:
			return false;
			break;
		}
	}


	static function translateCategory($code){
		$qb = new QueryBuilder();
		return $qb->findAll('category')
		->addWhere('id = :id')
		->setParameter('id',$code)
		->fetchOne()['label'];
	}

	static function getStatusArticle($code){
		
		switch ($code) {
			case 1:
			return 'Publié';
			break;
			case 2:
			return 'Brouillon';
			break;
			case 3:
			return 'Programmé';
			break;
			default:
			return false;
			break;
		}
	}

	static function getAuthorName($id){

		$qb = new QueryBuilder();

		$author = $qb->select('login')->from('user')->addWhere("id = :id")->setParameter("id",$id)->fetchOne();

		return ucfirst($author['login']);
	}


	static function dump($var,$die = false,$type = 1){

		if($type == 1){
			highlight_string("<?php\n\$data =\n" . var_export($var, true) . ";\n?>");
		}
		if($type == 2){
			print_r($var);
		}
		if($die == true){
			die();
		}
	}
	static function humanTime($datetime, $full = false)
	{

		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';

	}

	static function pageCalc($count,$elementPerPage){

		$nbPage = $count/$elementPerPage;

		if($count < $elementPerPage){
			return 1;
		}
		
		if($count%$elementPerPage != 0 ){
			return ceil($nbPage);
		}

		return intval($nbPage);

	}

	static function img($name){
		echo ROOT_URL.'public/img/'.$name;
	}

	static function dateDisplay($date,$type){

		if($date==0){
			$date = date("Y-m-d");
		}

		switch ($type) {
			case 1:
			return date("j F Y", strtotime($date));
			break;
			case 2:
			return date("Y-m-d", strtotime($date));
			break;
			case 3:
			return date("m/d/Y", strtotime($date));
			break;
			case 4:
			return date("d/m/Y", strtotime($date));
			break;
			default:
			return false;
			break;
		}
	}
	static function timeDisplay($time,$type){
		
		if($time==0){
			$time = date("Y-m-d");
		}

		switch ($type) {
			case 1:
			return date("j F Y", strtotime($time));
			break;
			case 2:
			return date("Y-m-d", strtotime($time));
			break;
			case 3:
			return date("m/d/Y", strtotime($time));
			break;
			case 4:
			return date("d/m/Y", strtotime($time));
			break;
			default:
			return false;
			break;
		}
	}
}
