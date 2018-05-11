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
		echo "<pre>";
		print_r($var);
		
		if($die == true){
			die();
		}
	}
	static function humanTime($date)
	{

	}
}
