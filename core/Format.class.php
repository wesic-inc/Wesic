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


	static function dump($var,$die = false,$type = 1){
		echo "<div>";
		echo '<pre style="
		position:relative;
		top:0;
		left:0;
		width:100%;
		display:block;
		min-height:50px;
		z-index:1000;
		background:#FFF;
		margin:0;color:#000;font-weight:bold">';
		if($type == 1){
		var_dump($var);
		}
		if($type == 2){
		print_r($var);
		}
			
		echo "</pre>";
		echo "</div>";
		if($die == true){
			die();
		}
	}
	static function humanTime($date)
	{

	}

	static function pageCalc($count,$elementPerPage){

		if($count < $elementPerPage){
			return 1;
		}
		
		if($count%$elementPerPage != 0 ){
			return ceil($nbPage);
		}

		return intval($nbPage);

	}
}
