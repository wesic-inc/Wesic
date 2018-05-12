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


	static function dump($var,$die = false){
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
		margin:0">';
		print_r($var);
		echo "</pre>";
		echo "</div>";
		if($die == true){
			die();
		}
	}
	static function humanTime($date)
	{

	}
}
