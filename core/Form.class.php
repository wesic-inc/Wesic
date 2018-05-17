<?php

class Form{


	public static function render($form,$data,$type = "default"){
		switch ($type) {
			case 'group':
			self::renderAdvanced($form,$data);
			break;
			case 'default':
			self::renderBasic($form,$data);
			break;
			default:
			return false;
			break;
		}
	}

	public static function renderBasic($form, $data){

		$output = '<form action="'.$form["options"]["action"].'" method="'.$form["options"]["method"].'">';

		foreach($form["struct"] as $name => $option){

			if($option["type"] == "text"|| $option["type"]=="password" || $option["type"]=="email"){
				$output .= self::input($name,$option,$data[$name]);
			}
			elseif($option["type"]=="textarea"){
				$output .= self::text($name,$option,$data[$name]);
			}
			elseif($option["type"]=="texteditor"){
				$output .= self::texteditor($name,$option,$data[$name]);
			}
			elseif($option["type"]=="select" ){
				$output .= self::select($name,$option,$data[$name]);
			}
			elseif($option["type"] == "datetime-local" || $option["type"] == "date" || $option["type"] == "time"){
				$output .= self::date($name,$option,$data[$name]);
			}
			elseif($option["type"] == "submit"){
				$output .= self::submit($name,$option,$data[$name]);
			}
			elseif($option["type"] == "link"){
				$output .= self::link($name,$option,$data[$name]);
			}
			elseif($option["type"] == "radio"){
				$output .= self::radio($name,$option,$data[$name]);
			}
			elseif($option["type"] == "info"){
				$output .= self::info($name,$option,$data[$name]);
			}
			elseif($option["type"] == "title"){
				$output .= self::title($name,$option,$data[$name]);
			}
			elseif($option["type"] == "separator"){
				$output .= '<div class="separator"></div>';
			}
			elseif($option["type"] == "captcha"){
				$output .= self::captcha($name,$option,$data[$name]);
			}
		}
		if($form['options']['submit-custom'] != true){
			$output .= '<input type="submit" value="'.$form["options"]["submit"].'">';
		}
		
		$output .= '</form>';
		echo $output;

	}
	public static function renderAdvanced($form, $data){

		global $forms_group;

		$output = '<form action="'.$form["options"]["action"].'" method="'.$form["options"]["method"].'"><div class="row row-forms">';
		$output_array = $form["groups"];

		$main = '<div class="col-md-9">'; 	
		$aside = '<div class="col-md-3 col-tools-add">';

		foreach ($form["groups"] as $group => $children) {

			$step = '<div class="'.$forms_group[$group]['container'].'"><p class="form-group-title">'.ucfirst($forms_group[$group]['label']).'</p><ul>';

			foreach ($children as $child) {
				$step .= "<li>";

				if($form["struct"][$child]["type"] == "text"|| $form["struct"][$child]["type"] =="password"){
					$step .= self::input($child,$form["struct"][$child],$data[$child]);
				}
				elseif($form["struct"][$child]["type"] =="textarea"){
					$step .= self::text($child,$form["struct"][$child],$data[$child]);
				}
				elseif($form["struct"][$child]["type"] =="select" ){
					$step .= self::select($child,$form["struct"][$child],$data[$child]);
				}
				elseif($form["struct"][$child]["type"] =="texteditor"){
					$step .= self::texteditor($child,$form["struct"][$child],$data[$child]);
				}
				elseif($form["struct"][$child]["type"] == "datetime-local" || $form["struct"][$child]["type"] == "date"){
					$step .= self::date($child,$form["struct"][$child],$data[$child]);
				}
				elseif($form["struct"][$child]["type"] == "submit"){
					$step .= self::submit($child,$form["struct"][$child],$data[$child]);
				}
				elseif($form["struct"][$child]["type"] == "separator"){
					$step .= '<div class="separator"></div>';
				}
				elseif($form["struct"][$child]["type"] == "link"){
					$step .= self::link($child,$form["struct"][$child],$data[$child]);
				}				
				elseif($form["struct"][$child]["type"] == "info"){
					$step .= self::info($child,$form["struct"][$child],$data[$child]);
				}
				elseif($form["struct"][$child]["type"] == "title"){
					$step .= self::title($child,$form["struct"][$child],$data[$child]);
				}				
				elseif($form["struct"][$child]["type"] == "captcha"){
					$step .= self::captcha($child,$form["struct"][$child],$data[$child]);
				}
				elseif($form["struct"][$child]["type"] == "radio"){
					$step .= self::radio($child,$form["struct"][$child],$data[$child]);
				}
				$step .= "</li>";
			}

			$step .= '</ul></div>';

			if($forms_group[$group]['aside'] === true){
				$aside .= $step;
			}else{
				$main .= $step;
			}
		}
		
		$main .= "</div>";
		$aside .= "</div>";
		$output .= $main;
		$output .= $aside;
		if($form['options']['submit-custom'] != true){
			$output .= '<input type="submit" value="'.$form["options"]["submit"].'">';
		}

		$output .= '</form>';
		echo $output;

	}

	public static function input($name,$option,$data){

		if(isset($option['helper'])){
			$helper =  '<p class="form-helper">'.$option['helper'].'</p>';
		}
		return '<div class="input-group"><label class="label-input" for="' . $name .'">'. $option["label"].'</label>
		<input 	name="'.$name.'" type="'.$option["type"].'" id="'.$option["id"].'" placeholder="'.$option["placeholder"].'"' . ((isset($option["required"]))?"required='required'":"") . ' value="'.((isset($data)&&$option["type"]!="password")?$data:"").'" ' . (($option["disabled"])?"disabled":"") . '>'.(isset($helper)?$helper:"").'</div>';
	}
	public static function text($name,$option,$data){

		if(isset($option['helper'])){
			$helper =  '<p class="form-helper">'.$option['helper'].'</p>';
		}
		return '<div class="input-group"><label class="label-input" for="'.$name.'">'.$option["label"].'</label>
		<textarea name="'.$name.'"
		id="'.$option["id"].'"
		placeholder="'.$option["placeholder"].'"' 
		.((isset($option["required"]))?"required='required'":"").' ' . (($option["disabled"])?"disabled'":"") . '>'
		.((isset($data))?$data:"").'</textarea>'.(isset($helper)?$helper:"").'</div>';
	}
	

	public static function texteditor($name,$option,$data){
		return '<div class="input-group"><label class="label-input" for="'.$name.'">'.$option["label"].'</label>
		<a href="#" class="btn btn-sm add-media"> Ajouter un média </a>
		<div id="wesic-wysiwyg" ' . (($option["disabled"])?"disabled":"") . '></div></div>';
	}

	public static function select($name,$option,$data){

		if(isset($option['helper'])){
			$helper =  '<p class="form-helper">'.$option['helper'].'</p>';
		}

		$output = '<div class="input-group"><label class="label-input" for="'.$name.'">'.$option["label"].'</label>
		<select name="'.$name.'" id="'.$option["id"].'" placeholder="'.$option["placeholder"].'" '.((isset($option["required"]))?"required='required'":"").' ' . (($option["disabled"])?"disabled":"") . '>';

		foreach ($option["choices"] as $value=>$title){

			$output = $output.'<option '.(($data==$value)?'selected="selected"':"").'value="'.$value.'">' 
			.ucfirst($title).'</option>';
		}

		$output .= '</select>'.(isset($helper)?$helper:"").'</div>';
		return $output;
	}
	public static function date($name,$option,$data){

		if(isset($option['helper'])){
			$helper =  '<p class="form-helper">'.$option['helper'].'</p>';
		}
		return '<div class="input-group"><label class="label-input" for="'.$name.'">'.$option["label"].'</label>
		<input name="'.$name.'" 
		type="'.$option["type"].'"
		id="'.$option["id"].'"
		placeholder="'.$option["placeholder"].'"'
		.((isset($option["required"]))?"required='required'":"").'
		value="'.((isset($data))?$data:"").'" ' . (($option["disabled"])?"disabled":"") . '></div>'; 
	}

	public static function submit($name,$option,$data){
		if(isset($option['helper'])){
			$helper =  '<p class="form-helper">'.$option['helper'].'</p>';
		}
		if($option['button'] == "btn-alt"){
			$class = "btn btn-alt btn-sm";
		}else{
			$class = "btn btn-sm";
		}
		return '<input class="'.$class.'" type="submit" value="'.$option['label'].'"> '.(isset($helper)?$helper:""); 
	}
	public static function info($name,$option,$data){
		
		return '<div class="input-group"><p>'.$option['text'].'</p></div>'; 
	}
	public static function title($name,$option,$data){
		
		return '<div class="input-group"><p class="title-form">'.$option['text'].'</p></div>'; 
	}
	public static function link($name, $option, $data){
		if(isset($option['helper'])){
			$helper =  '<p class="form-helper">'.$option['helper'].'</p>';
		}
		if(isset($option['link'])){
			return '<div class="input-group"><a href="'.$option['link'].'" class="form-link '.$option["class"].'">' . $option['label'] .'</a>'.(isset($helper)?$helper:"").'</div>';

		}else{
			
			return '<div class="input-group"><a href="'.$data.'" class="form-link '.$option["class"].'">' . $option['label'] .'</a>'.(isset($helper)?$helper:"").'</div>';
		}
	}	
	public static function captcha($name, $option, $data){
		return '<img class="captcha" src="captcha.view.php"><div class="input-group"><label class="label-input" for="' . $name .'">'. $option["label"].'</label>
		<input 	name="'.$name.'" type="'.$option["type"].'" id="'.$option["id"].'" placeholder="'.$option["placeholder"].'"' . (($option["required"])?"required='required'":"") . ' value="'.((isset($data)&&$option["type"]!="password")?$data:"").'" ' . ((isset($option["required"]))?"required='required'":"") . '></div>';
	}
	public static function radio($name, $option, $date){

		if(isset($option['helper'])){
			$helper =  '<p class="form-helper">'.$option['helper'].'</p>';
		}
		$output = "";

		foreach ($option["choices"] as $value=>$title){

			$output = $output.'<input type="radio" name="'.$name.'" id="'.$option["id"].'"'.(($data==$value)?'checkeds="checked"':"").'value="'.$value.'">' 
			.ucfirst($title);
		}

		return $output.(isset($helper)?$helper:"");
	}
}
