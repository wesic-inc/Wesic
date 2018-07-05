<?php

class Faker {
/**
 * [title description]
 * @param  integer $nb [description]
 * @return [type]      [description]
 */
	public static function title($nb = 1){
		$output = "";

		for($i=0;$i<$nb;$i++){
			$output .= ucfirst(self::dic()[rand(0,149)]);
			if($nb > 1 && $i<$nb-1 ){
				$output .= " ";
			}
		}

		return $output;
	}		
/**
 * [slug description]
 * @return [type] [description]
 */
	public static function slug(){
		$output = "";
		$iter = rand(3,6);

		for($i=0;$i<$iter;$i++){
			$output .= self::dic()[rand(0,149)];
			if($iter > 1 && $i<$iter-1 ){
				$output .= "-";
			}
		}

		return $output;
	}		
/**
 * [html description]
 * @return [type] [description]
 */
	public static function html(){
		return file_get_contents('http://loripsum.net/api/10/verylong/headers/decorate/bq/ul/link');
	}	
/**
 * [text description]
 * @param  integer $nb   [description]
 * @param  string  $size [description]
 * @return [type]        [description]
 */
	public static function text($nb = 1,$size = "small"){
		return file_get_contents('http://loripsum.net/api/plaintext/'.$size."".$size);
	}
/**
 * [dic description]
 * @return [type] [description]
 */
	public static function dic(){
		return explode(' ','lorem ipsum dolor sit amet consectetur adipiscing elit vestibulum non nulla eget quam commodo pharetra aliquam ac sollicitudin velit donec aliquam convallis nisl vel maximus nulla lacus est pharetra nec arcu et luctus congue mauris morbi rutrum eleifend gravida praesent non urna vel quam pretium efficitur non sit amet tortor integer faucibus orci a ultricies scelerisque velit ligula aliquam risus sed blandit libero enim varius dolor cras eu arcu et massa hendrerit accumsan eu non eros sed dapibus massa nec lacus malesuada tincidunt cras quis sagittis metus suspendisse ac posuere augue curabitur laoreet elit eget eros rhoncus venenatis at sed ipsum pellentesque luctus leo et rhoncus mattis morbi velit lorem, maximus ac imperdiet vel, sodales non ipsum. vivamus eget risus at lorem malesuada cursus eu sit amet urna. etiam eget elementum ipsum id consectetur mi in et facilisis urna nec auctor dui aliquam nec laoreet erat interdum et malesuada fames');
	}
}