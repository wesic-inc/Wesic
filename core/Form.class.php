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

			if($option["type"] == "text"|| $option["type"]=="password"){
				$output .= self::input($name,$option,$data[$name]);
			}
			elseif($option["type"]=="textarea"){
				$output .= self::text($name,$option,$data[$name]);
			}
			elseif($option["type"]=="select" ){
				$output .= self::select($name,$option,$data[$name]);
			}
			elseif($option["type"] == "datetime-local" || $option["type"] == "date"){
				$output .= self::date($name,$option,$data[$name]);
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

		$main = '<div class="col-md-7"><div class="row">'; 	
		$aside = '<div class="col-md-offset-1 col-md-4 col-tools-add"><div class="row">';

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
				elseif($form["struct"][$child]["type"] == "datetime-local" || $form["struct"][$child]["type"] == "date"){
					$step .= self::date($child,$form["struct"][$child],$data[$child]);
				}
				elseif($form["struct"][$child]["type"] == "submit"){
					$step .= self::submit($child,$form["struct"][$child],$data[$child]);
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
		
		$main .= "</div></div>";
		$aside .= "</div></div>";
		$output .= $main;
		$output .= $aside;
		if($form['options']['submit-custom'] != true){
			$output .= '<input type="submit" value="'.$form["options"]["submit"].'">';
		}

		$output .= '</form>';
		echo $output;

	}

	public static function input($name,$option,$data){

		return '<label for="' . $name .'">'. $option["label"].'</label>
		<input 	name="'.$name.'" type="'.$option["type"].'" id="'.$option["id"].'" placeholder="'.$option["placeholder"].'"' . (($option["required"])?"required=\'required\'":"") . 'value="'.((isset($data)&&$option["type"]!="password")?$data:"").'">';
	}
	public static function text($name,$option,$data){
		return '<label for="'.$name.'">'.$option["label"].'</label>
		<textarea name="'.$name.'"
		id="'.$option["id"].'"
		placeholder="'.$option["placeholder"].'"' 
		.(($option["required"])?"required='required'":"").'>'
		.((isset($data))?$data:"").'</textarea>';
	}
	public static function select($name,$option,$data){

		$output = '<label for="'.$name.'">'.$option["label"].'</label>
		<select name="'.$name.'" id="'.$option["id"].'" placeholder="'.$option["placeholder"].'" '.(($option["required"])?"required='required'":"").'>';

		foreach ($option["choices"] as $value=>$title){

			$output = $output.'<option '.(($data==$value)?'selected="selected"':"").'value="'.$value.'">' 
			.ucfirst($title).'</option>';
		}

		$output .= "</select>";
		return $output;
	}
	public static function date($name,$option,$data){

		return '<label for="'.$name.'">'.$option["label"].'</label>
		<input name="'.$name.'" 
		type="'.$option["type"].'"
		id="'.$option["id"].'"
		placeholder="'.$option["placeholder"].'"'
		.(($option["required"])?"required='required'":"").'
		value="'.((isset($data))?$data:"").'" >'; 
	}

	public static function submit($name,$option,$data){

		return '<input type="submit" value="'.$name.'">'; 
	}
}
