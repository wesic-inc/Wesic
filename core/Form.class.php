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
			elseif($option["type"] == "separator"){
				$output .= '<div class="separator"></div>';
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

		return '<div class="input-group"><label class="label-input" for="' . $name .'">'. $option["label"].'</label>
		<input 	name="'.$name.'" type="'.$option["type"].'" id="'.$option["id"].'" placeholder="'.$option["placeholder"].'"' . (($option["required"])?"required='required'":"") . ' value="'.((isset($data)&&$option["type"]!="password")?$data:"").'" ' . (($option["disabled"])?"disabled":"") . '></div>';
	}
	public static function text($name,$option,$data){

		return '<div class="input-group"><label class="label-input" for="'.$name.'">'.$option["label"].'</label>
		<textarea name="'.$name.'"
		id="'.$option["id"].'"
		placeholder="'.$option["placeholder"].'"' 
		.(($option["required"])?"required='required'":"").' ' . (($option["disabled"])?"disabled'":"") . '>'
		.((isset($data))?$data:"").'</textarea></div>';
	}

	public static function texteditor($name,$option,$data){
		return '<div class="input-group"><label class="label-input" for="'.$name.'">'.$option["label"].'</label>
		<a href="#" class="btn btn-sm add-media"> Ajouter un média </a>
		<div id="wesic-wysiwyg" ' . (($option["disabled"])?"disabled":"") . '></div></div>';
	}

	public static function select($name,$option,$data){

		$output = '<div class="input-group"><label class="label-input" for="'.$name.'">'.$option["label"].'</label>
		<select name="'.$name.'" id="'.$option["id"].'" placeholder="'.$option["placeholder"].'" '.(($option["required"])?"required='required'":"").' ' . (($option["disabled"])?"disabled":"") . '>';

		foreach ($option["choices"] as $value=>$title){

			$output = $output.'<option '.(($data==$value)?'selected="selected"':"").'value="'.$value.'">' 
			.ucfirst($title).'</option>';
		}

		$output .= "</select></div>";
		return $output;
	}
	public static function date($name,$option,$data){

		return '<div class="input-group"><label class="label-input" for="'.$name.'">'.$option["label"].'</label>
		<input name="'.$name.'" 
		type="'.$option["type"].'"
		id="'.$option["id"].'"
		placeholder="'.$option["placeholder"].'"'
		.(($option["required"])?"required='required'":"").'
		value="'.((isset($data))?$data:"").'" ' . (($option["disabled"])?"disabled":"") . '></div>'; 
	}

	public static function submit($name,$option,$data){
		if($option['button'] == "btn-alt"){
			$class = "btn btn-alt btn-sm";
		}else{
			$class = "btn btn-sm";
		}
		return '<input class="'.$class.'" type="submit" value="'.$option['label'].'">'; 
	}
	public static function link($name, $option, $data){
		if(isset($option['link'])){
		return '<div class="input-group"><a href="'.$option['link'].'" class="form-link '.$option["class"].'">' . $option['label'] .'</a></div>';

		}else{
			
		return '<div class="input-group"><a href="'.$data.'" class="form-link '.$option["class"].'">' . $option['label'] .'</a></div>';
		}
	}	
}
