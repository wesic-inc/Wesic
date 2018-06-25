<?php

class Form
{
    public static function render($form, $data, $type = "default")
    {
        switch ($type) {
            case 'group':
            self::renderAdvanced($form, $data);
            break;
            case 'default':
            self::renderBasic($form, $data);
            break;
            default:
            return false;
            break;
        }
    }

    public static function renderBasic($form, $data)
    {
        $output = '<form action="'.$form["options"]["action"].'" method="'.$form["options"]["method"].'">';

        foreach ($form["struct"] as $name => $option) {

            $fieldType = $option["type"];
            $params = [$name, $option, isset($data[$name])?$data[$name]:""];

            if ($fieldType == "text"|| $fieldType == "password" || $fieldType =="email") {
                $output .= self::input($params);
            } elseif ($fieldType =="textarea") {
                $output .= self::text($params);
            } elseif ($fieldType =="texteditor") {
                $output .= self::texteditor($params);
            } elseif ($fieldType =="select") {
                $output .= self::select($params);
            } elseif ($fieldType  == "datetime-local" || $fieldType == "date" || $fieldType == "time") {
                $output .= self::date($params);
            } elseif ($fieldType  == "submit") {
                $output .= self::submit($params);
            } elseif ($fieldType  == "link") {
                $output .= self::link($params);
            } elseif ($fieldType  == "radio") {
                $output .= self::radio($params);
            } elseif ($fieldType == "info") {
                $output .= self::info($params);
            } elseif ($fieldType == "title") {
                $output .= self::title($params);
            } elseif ($fieldType == "custom-datepicker") {
                $output .= self::datepicker($params);
            } elseif ($fieldType == "separator") {
                $output .= '<div class="separator"></div>';
            } elseif ($fieldType == "captcha") {
                $output .= self::captcha($params);
            }
        }
        if ($form['options']['submit-custom'] != true) {
            $output .= '<input type="submit"  value="'.$form["options"]["submit"].'">';
        }
        $output .= self::getCSRF();
        $output .= '</form>';
        echo $output
 ;   }
    public static function renderAdvanced($form, $data)
    {
        global $forms_group;

        $output = '<form action="'.$form["options"]["action"].'" method="'.$form["options"]["method"].'"><div class="row row-forms">';
        $output_array = $form["groups"];

        $main = '<div class="col-lg-8">';
        $aside = '<div class="col-lg-4 col-tools-add">';

        foreach ($form["groups"] as $group => $children) {
            $step = '<div class="'.$forms_group[$group]['container'].'"><p class="form-group-title">'.ucfirst($forms_group[$group]['label']).'</p><ul>';

            foreach ($children as $child) {
                $step .= "<li>";

                $fieldType = $form["struct"][$child]["type"];
                $params = [$child,$form["struct"][$child],(isset($data[$child])?$data[$child]:null)];

                dump($child);

                if ($fieldType == "text"|| $fieldType =="password") {
                    $step .= self::input($params);
                } elseif ($fieldType =="textarea") {
                    $step .= self::text($params);
                } elseif ($fieldType =="select") {
                    $step .= self::select($params);
                } elseif ($fieldType =="texteditor") {
                    $step .= self::texteditor($params);
                } elseif ($fieldType == "datetime-local" || $fieldType == "date" || $fieldType == "time") {
                    $step .= self::date($params);
                } elseif ($fieldType == "submit") {
                    $step .= self::submit($params);
                } elseif ($fieldType == "separator") {
                    $step .= '<div class="separator"></div>';
                } elseif ($fieldType == "link") {
                    $step .= self::link($params);
                } elseif ($fieldType == "info") {
                    $step .= self::info($params);
                } elseif ($fieldType == "title") {
                    $step .= self::title($params);
                } elseif ($fieldType == "custom-datepicker") {
                    $step .= self::datepicker($params);
                } elseif ($fieldType == "captcha") {
                    $step .= self::captcha($params);
                } elseif ($fieldType == "radio") {
                    $step .= self::radio($params);
                }
                $step .= "</li>";
            }

            $step .= '</ul></div>';

            if ($forms_group[$group]['aside'] === true) {
                $aside .= $step;
            } else {
                $main .= $step;
            }
        }
        
        $main .= "</div>";
        $aside .= "</div>";
        $output .= $main;
        $output .= $aside;
        if ($form['options']['submit-custom'] != true) {
            $output .= '<input type="submit" name="'.$child.'" id="'.$child.'" value="'.$form["options"]["submit"].'">';
        }
        $output .= self::getCSRF();
        $output .= '</form>';
        echo $output;
    }

    public static function input($params)
    {
        $name = $params[0];
        $option = $params[1];
        $data = $params[2];

        if (isset($option['helper'])) {
            $helper =  '<p class="form-helper">'.$option['helper'].'</p>';
        }
        return '<div class="input-group"><label class="label-input" for="' . $name .'">'. $option["label"].'</label>		<input 	name="'.$name.'" type="'.$option["type"].'" id="'.$option["id"].'" placeholder="'.$option["placeholder"].'"' . ((isset($option["required"]))?"required='required'":"") . ' value="'.((isset($data)&&$option["type"]!="password")?$data:"").'" ' . (isset($option["disabled"])&&$option["disabled"]?"disabled":"") . '>'.(isset($helper)?$helper:"").'</div>';
    }
    public static function text($params)
    {
                $name = $params[0];
        $option = $params[1];
        $data = $params[2];

        if (isset($option['helper'])) {
            $helper =  '<p class="form-helper">'.$option['helper'].'</p>';
        }
        return '<div class="input-group"><label class="label-input" for="'.$name.'">'.$option["label"].'</label>
		<textarea name="'.$name.'"
		id="'.$option["id"].'" "'
        .((isset($option["required"]))?"required='required'":"").' ' . ((isset($option["disabled"])&&$option["disabled"])?"disabled'":"") . '>'
        .((isset($data))?$data:"").'</textarea>'.(isset($helper)?$helper:"").'</div>';
    }
    

    public static function texteditor($params)
    {

               $name = $params[0];
        $option = $params[1];
        $data = $params[2];

        return '<div class="input-group"><label class="label-input" for="'.$name.'">'.$option["label"].'</label>
		<a href="#" class="btn btn-sm add-media"> Ajouter un mÃ©dia </a>
		<div id="wesic-wysiwyg" ' . ((isset($option["disabled"])&&$option["disabled"])?"disabled":"") . '>'.((isset($data))?$data:"").'</div></div>';
    }

    public static function datepicker($params)
    {


               $name = $params[0];
        $option = $params[1];
        $data = $params[2];
        return '<div class="datepicker" name="lolilol" id="timestampdiv"><label class="label-input">'.$option['label'].'</label>
		<div class="timestamp-wrap"><input type="text" id="jj" name="jj" value="'.((isset($data['jj']))?$data['jj']:date("d")).'" size="2" maxlength="2" autocomplete="off"><select id="mm" name="mm">
		<option value="01" '.(($data['mm']=="01")||date("m")=="01"?'selected="selected"':"").'>01-Jan</option>
		<option value="02" '.(($data['mm']=="02")||date("m")=="02"?'selected="selected"':"").'>02-Fev</option>
		<option value="03" '.(($data['mm']=="03")||date("m")=="03"?'selected="selected"':"").'>03-Mar</option>
		<option value="04" '.(($data['mm']=="04")||date("m")=="04"?'selected="selected"':"").'>04-Avr</option>
		<option value="05" '.(($data['mm']=="05")||date("m")=="05"?'selected="selected"':"").'>05-Mai</option>
		<option value="06"" '.(($data['mm']=="06")||date("m")=="06"?'selected="selected"':"").'>06-Juin</option>
		<option value="07"" '.(($data['mm']=="07")||date("m")=="07"?'selected="selected"':"").'>07-Juil</option>
		<option value="08"" '.(($data['mm']=="08")||date("m")=="08"?'selected="selected"':"").'>08-Aout</option>
		<option value="09" '.(($data['mm']=="09")||date("m")=="09"?'selected="selected"':"").'>09-Sep</option>
		<option value="10" '.(($data['mm']=="10")||date("m")=="10"?'selected="selected"':"").'>10-Oct</option>
		<option value="11" '.(($data['mm']=="11")||date("m")=="11"?'selected="selected"':"").'>11-Nov</option>
		<option value="12" '.(($data['mm']=="12")||date("m")=="12"?'selected="selected"':"").'>12-Dec</option>
		</select>
		<input type="text" id="aa" name="aa" value="'
        .((isset($data['aa']))?$data['aa']:date("Y")).'" size="4" maxlength="4" autocomplete="off"> 
		<input type="text" id="hh" name="hh" value="'
        .((isset($data['hh']))?$data['hh']:date("H")).'" size="2" maxlength="2" autocomplete="off">&nbsp;h&nbsp;
		<input type="text" id="mn" name="mn" value="'
        .((isset($data['mn']))?$data['mn']:date("i")).'" size="2" maxlength="2" autocomplete="off">
		</div>
		</div>';
    }

    public static function select($params)
    {

               $name = $params[0];
        $option = $params[1];
        $data = $params[2];


        if (isset($option['helper'])) {
            $helper =  '<p class="form-helper">'.$option['helper'].'</p>';
        }

        $output = '<div class="input-group"><label class="label-input" for="'.$name.'">'.$option["label"].'</label>
		<select name="'.$name.'" id="'.$option["id"].'" placeholder="'.$option["placeholder"].'" '.((isset($option["required"]))?"required='required'":"").' ' . ((isset($option["disabled"])&&$option["disabled"])?"disabled":"") . '>';

        if (is_array($option["choices"])) {
            foreach ($option["choices"] as $value=>$title) {
                $output = $output.'<option '.(($data==$value)?'selected="selected"':"").' value="'.$value.'">'
                .ucfirst($title).'</option>';
            }
        } else {
            switch ($option["choices"]) {
                case 'category':
                    $output .= self::categoryChoices($data);
                break;
                case 'tag':
                    $output .= self::tagChoices();
                break;
                default:
                break;
            }
        }

        $output .= '</select>'.(isset($helper)?$helper:"").'</div>';
        return $output;
    }

    public static function categoryChoices($data)
    {
        $qb = new QueryBuilder();
        $categories = $qb->findAll('category')
        ->addWhere('type = :type')
        ->setParameter('type', 1)
        ->or()
        ->addWhere('type = :type2')
        ->setParameter('type2', 3)
        ->execute();



        $output = "";
        foreach ($categories as $value) {
            if (isset($data['id'])) {
                $current = $data['id'];
            } else {
                $current = Setting::getParam('default-cat');
            }
            $output = $output.'<option '.(($current==$value['id'])?'selected="selected"':"").' value="'.$value['id'].'">'
                .ucfirst($value['label']).'</option>';
        }

        return $output;
    }
    public static function date($params)
    {

                       $name = $params[0];
        $option = $params[1];
        $data = $params[2];
        if (isset($option['helper'])) {
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

    public static function submit($params)
    {

                               $name = $params[0];
        $option = $params[1];
        $data = $params[2];
        if (isset($option['helper'])) {
            $helper =  '<p class="form-helper">'.$option['helper'].'</p>';
        }
        if (isset($option['button']) && $option['button'] == "btn-alt") {
            $class = "btn btn-alt btn-sm";
        } else {
            $class = "btn btn-sm";
        }
        return '<input class="submit-form '.$class.'" name="'.$name.'" id="'.$name.'" type="submit" value="'.$option['label'].'"> '.(isset($helper)?$helper:"");
    }
    public static function info($params)
    {
                                       $name = $params[0];
        $option = $params[1];
        $data = $params[2];

        return '<div class="input-group"><p>'.$option['text'].'</p></div>';
    }
    public static function title($params)
    {
                                               $name = $params[0];
        $option = $params[1];
        $data = $params[2];
        return '<div class="input-group"><p class="title-form">'.$option['text'].'</p></div>';
    }
    public static function link($params)
    {
                                               $name = $params[0];
        $option = $params[1];
        $data = $params[2];
        if (isset($option['helper'])) {
            $helper =  '<p class="form-helper">'.$option['helper'].'</p>';
        }
        if (isset($option['link'])) {
            return '<div class="input-group"><a href="'.$option['link'].'" class="form-link '.$option["class"].'">' . $option['label'] .'</a>'.(isset($helper)?$helper:"").'</div>';
        } else {
            return '<div class="input-group"><a href="'.$data.'" class="form-link '.$option["class"].'">' . $option['label'] .'</a>'.(isset($helper)?$helper:"").'</div>';
        }
    }
    public static function captcha($params)
    {
                                               $name = $params[0];
        $option = $params[1];
        $data = $params[2];
        return '<img class="captcha" src="captcha.php"><div class="input-group"><label class="label-input" for="' . $name .'">'. $option["label"].'</label>
		<input 	name="'.$name.'" type="'.$option["type"].'" id="'.$option["id"].'" placeholder="'.$option["placeholder"].'"' . (($option["required"])?"required='required'":"") . ' value="'.((isset($data)&&$option["type"]!="password")?$data:"").'" ' . ((isset($option["required"]))?"required='required'":"") . '></div>';
    }
    public static function radio($params)
    {
                                                       $name = $params[0];
        $option = $params[1];
        $data = $params[2];
        if (isset($option['helper'])) {
            $helper =  '<p class="form-helper">'.$option['helper'].'</p>';
        }
        $output = "";

        foreach ($option["choices"] as $value=>$title) {
            $output = $output.'<input type="radio" name="'.$name.'" id="'.$option["id"].'"'.(($data==$value)?'checkeds="checked"':"").'value="'.$value.'">'
            .ucfirst($title);
        }

        return $output.(isset($helper)?$helper:"");
    }
    
    public static function getCSRF()
    {

        $token = md5(uniqid(rand(), true));
        if (!isset($_SESSION)){
            session_start();
        }
        $_SESSION['csrf'] = $token;
        return '<input type="hidden" name="csrf" id="csrf" value="'.$token.'">';
    }
}
