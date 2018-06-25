<?php

class validator{



	public function __construct(){

	}


	public static function check($struct, $data){
		if(!isset($_SESSION)){
		session_start();
		}

		$listErrors = [];
		if(isset($data['jj']) 
			&& isset($data['mm']) 
			&& isset($data['aa'])
			&& isset($data['hh'])
			&& isset($data['mn'])){
			$data['datepicker-custom'] = 
		$data['aa']."-".$data['mm']."-".$data['jj']." ".$data['hh'].":".$data['mn'].":00";
	}

	foreach ($struct as $name => $options) {
		if(isset($options["required"]) && $options["required"] == true && self::isEmpty($data[$name])){
			$listErrors[]=$options["msgerror"];
		}
		if($options["type"]=="password" && !self::passwordDevEnvCorrect($data[$name])) {
			$listErrors[]=$options["msgerror"];
		}
		if($options["type"]=="text" && !self::simpleEntryCorrect($data[$name])) {
			if(isset($options["required"]) && $options["required"] == true && self::isEmpty($data[$name])){
				$listErrors[]=$options["msgerror"];
			}
		}

		if($name=="login" && !self::simpleEntryCorrect($data[$name])) {
			$listErrors[]=$options["msgerror"];
		}			
		if($name=="datepicker-custom" && !self::dateCorrect($data[$name])) {
			$listErrors[]=$options["msgerror"];
		}
		if($name=="login" && isset($options['checkexist']) && $options['checkexist'] && User::loginExists($data[$name]) ){
			$listErrors[]=$options["msgerror"];
		}	
		if($name=="csrf" && self::csrfCorrect($data[$name]) ){
			$listErrors[]='csrf';
		}			
		if($options["type"]=="email" && !self::emailCorrect($data[$name])) {
			$listErrors[]= $email;
		}
		if($options["type"]=="captcha" && !self::captchaCorrect($data[$name])) {
			$listErrors[]= $options["msgerror"];
		}
		if($options["type"]=="email" && isset($options['checkexist']) && $options['checkexist'] == true && User::emailExists($data[$name]) ){
			$listErrors[]=$options["msgerror"];
		}
		if($name=="slug" && $options['checkexist'] && self::slugCorrect($data[$name],$data['id']) ){
			$listErrors[]=$options["msgerror"];
		}
		if($name=="password2" && $data["password1"] != $data["password2"] ) {
			$listErrors[]=$options["msgerror"];
		}
		if(isset($options["confirm"]) && $data[$name]!==$data[$options["confirm"]] ){
			$errorsMsg[] = $name." doit être identique à ".$options["confirm"];
		}

		else if(!isset($options["confirm"])){
			if($options["type"]=="email" && !self::emailCorrect($data[$name])){

				$listErrors[]=$options["msgerror"];

			}else if($options["type"]=="password" && !self::passwordDevEnvCorrect($data[$name])){
				$listErrors[]=$options["msgerror"];
			}

		}

	}

	if(count(array_keys($listErrors, 'password2')) > 1){
		unset($listErrors[array_keys($listErrors, 'password2')[0]]);
	}

		// echo "<pre>";
		// var_dump($listErrors);
		// var_dump($data);
		// var_dump($struct);
		// die();
	return $listErrors;
}


public static function process($struct, $data, $form){
	switch ($form) {
		case 'signin':
		return Auth::signIn($data);
		break;
		case 'signup':
		return User::signUp($data);
		break;
		case 'articlenew':
		return Post::newArticle($data);
		break;			
		case 'pagenew':
		return Post::newPage($data);
		break;			
		case 'edit-page':
		return Post::editPage($data);
		break;			
		case 'edit-article':
		return Post::editArticle($data);
		break;
		case 'edit-user':
		return User::editUser($data);
		break;
		case 'add-user':
		return User::addUser($data);
		break;
		case 'new-category':
		return Category::newCategory($data);
		break;
		case 'edit-category':
		return Category::editCategory($data);
		break;
		case 'newpassword':
		return Passwordrecovery::sendResetPassword($data['login']);
		case 'modifypassword':
		return User::modifyPassword($data);
		case 'signup-newsletter':
		return User::signUpNewsletter($data);
		case 'setting':
		return Setting::editSettings($data);
		case 'setting-view':
		return Setting::editSettingsView($data);
		case 'setting-post':
		return Setting::editSettingsPost($data);
		default:
		return false;
		break;
	}
}




public static function isEmpty($var){
	return empty(trim($var));
}

public static function passwordCorrect($var){
	return !( strlen($var)<8 || strlen($var)>12 ||
		!preg_match("/[0-9]/", $var) ||
		!preg_match("/[a-z]/", $var) ||
		!preg_match("/[A-Z]/", $var) );
}

public static function passwordDevEnvCorrect($var){
	return !( strlen($var)<2 || strlen($var)>25);
}

public static function captchaCorrect($var){
	session_start();
	return !($var != $_SESSION['captcha']);
}

public static function urlCorrect($var){
	return !( filter_var($var, FILTER_VALIDATE_URL) === FALSE || strlen($var)<2 || strlen($var)>500 );
}	
public static function csrfCorrect($var){
	session_start();

	if($_SESSION['csrf'] != $var){
		Route::redirect('403');
	}else{
		return true;
	}
}
public static function dateCorrect($date, $format = 'Y-m-d H:i:s')
{
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) == $date;
}

public static function selectEntryCorrect($var){
	return !( $var == 0 || $var == 1 );
}
public static function emailCorrect($var){
	return ( filter_var($var, FILTER_VALIDATE_EMAIL) );
}
public static function simpleEntryCorrect($var){
	return !( strlen($var)<2 || strlen($var)>100 );
}
public static function simpleEntryTextCorrect($var){
	return !( strlen($var)<2 || strlen($var)>170 );
}
public static function loginCorrect($var){
	return !( 	strlen($var)<8 || strlen($var)>50 );
}	
public static function slugCorrect($var,$id){
	
	if(isset($id)){
		return Slug::slugExistsWithId($var,$id);
	}else{
		return Basesql::slugExists($var);
	}
}

}