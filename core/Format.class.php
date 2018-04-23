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

}
