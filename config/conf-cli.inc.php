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
define("DOMAIN",$cof['config']['domain']);
define('ROOT_URL', preg_replace("/\/$/",'',PROTOCOL.DOMAIN.str_replace(array('\\',"index.php","index.html"), '', dirname(htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES))),1).'/',true);



$route_access = $rof['routing'];
$sitename = $cof['config']['sitename'];
$debug = $cof['config']['debug'];

define("WESIC_VERSION","0.0.1-alpha");