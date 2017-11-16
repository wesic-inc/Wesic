<?php

$cof = yaml_parse_file('config/config.yml');
$rof = yaml_parse_file('config/routing.yml');
$erf = yaml_parse_file('config/errors.yml');

define("DBHOST", $cof['config']['mysql']['host']);
define("DBUSER", $cof['config']['mysql']['dbuser']);
define("DBPWD", $cof['config']['mysql']['password']);
define("DBNAME", $cof['config']['mysql']['dbname']);
define('PATH_ROOT', $cof['config']['path']['root']); // chemin vers le site sur le serveur 
define('PATH_FILE', $cof['config']['path']['files']);
define('ROOT_URL',getenv('HTTP_HOST')."/");

$errors_msg = $erf['errors'];
$route_access = $rof['routing'];