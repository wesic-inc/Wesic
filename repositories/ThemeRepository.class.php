<?php

class ThemeRepository extends Basesql{

	public static function getConf(){
		return yaml_parse_file('themes/'.setting('theme')."/theme.yml");
	}

}