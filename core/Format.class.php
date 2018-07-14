<?php

class Format {
/**
 * [getRole description]
 * @param  [type] $code [description]
 * @return [type]       [description]
 */
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
/**
 * [getStatusUser description]
 * @param  [type] $code [description]
 * @return [type]       [description]
 */
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

/**
 * [translateCategory description]
 * @param  [type] $code [description]
 * @return [type]       [description]
 */
	static function translateCategory($code){
		$qb = new QueryBuilder();
		return $qb->findAll('category')
		->addWhere('id = :id')
		->setParameter('id',$code)
		->fetchOne()['label'];
	}
/**
 * [getStatusArticle description]
 * @param  [type] $code [description]
 * @return [type]       [description]
 */
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
/**
 * [getAuthorName description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
	static function getAuthorName($id){

		$qb = new QueryBuilder();

		$author = $qb->select('login')->from('user')->addWhere("id = :id")->setParameter("id",$id)->fetchOne();

		return ucfirst($author['login']);
	}

/**
 * [dump description]
 * @param  [type]  $var  [description]
 * @param  boolean $die  [description]
 * @param  integer $type [description]
 * @return [type]        [description]
 */
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
/**
 * [humanTime description]
 * @param  [type]  $datetime [description]
 * @param  boolean $full     [description]
 * @return [type]            [description]
 */
	static function humanTime($datetime, $full = false)
	{

		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'an',
			'm' => 'mois',
			'w' => 'semaine',
			'd' => 'jour',
			'h' => 'heure',
			'i' => 'minute',
			's' => 'seconde',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? 'il y a '.implode(', ', $string) : "à l'instant";

	}
/**
 * [pageCalc description]
 * @param  [type] $count          [description]
 * @param  [type] $elementPerPage [description]
 * @return [type]                 [description]
 */
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
/**
 * [img description]
 * @param  [type] $name [description]
 * @return [type]       [description]
 */
	static function img($name){
		return ROOT_URL.'public/img/'.$name;
	}
/**
 * [dateDisplay description]
 * @param  [type] $date [description]
 * @param  [type] $type [description]
 * @return [type]       [description]
 */
	static function dateDisplay($date,$type){

		if($date==0){
			$date = date("Y-m-d");
		}
		switch ($type) {
			case 1:
			return date("d/m/Y à H:i", strtotime($date));
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
	/**
	 * [timeDisplay description]
	 * @param  [type] $time [description]
	 * @param  [type] $type [description]
	 * @return [type]       [description]
	 */
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

	static function videoImg($id){
		return "https://img.youtube.com/vi/".$id."/0.jpg";
	}
}
