<?php

$cof = yaml_parse_file('config/config.yml');
$rof = yaml_parse_file('config/routing.yml');


define("DBHOST", $cof['config']['mysql']['host']);
define("DBUSER", $cof['config']['mysql']['dbuser']);
define("DBPWD", $cof['config']['mysql']['password']);
define("DBNAME", $cof['config']['mysql']['dbname']);
define('PATH_ROOT', $cof['config']['path']['root']);  
define('PATH_FILE', $cof['config']['path']['files']);
define('PROTOCOL',(!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://',true);



$route_access = $rof['routing'];
$debug = $cof['config']['debug'];

define("WESIC_VERSION","0.0.1-alpha");