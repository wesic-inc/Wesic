<?php

// Chargement de tous les fichiers YAML de configuration
$cof = yaml_parse_file('config/config.yml');
$rof = yaml_parse_file('config/routing.yml');
$erf = yaml_parse_file('config/errors.yml');
$fof = yaml_parse_file('config/forms.yml');


// Déclaration des constantes
define("DBHOST", $cof['config']['mysql']['host']);
define("DBUSER", $cof['config']['mysql']['dbuser']);
define("DBPWD", $cof['config']['mysql']['password']);
define("DBNAME", $cof['config']['mysql']['dbname']);
define('PATH_ROOT', $cof['config']['path']['root']);  
define('PATH_FILE', $cof['config']['path']['files']);
define('PROTOCOL',(!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://',true);
define('DOMAIN',$_SERVER['HTTP_HOST']);
define('ROOT_URL', preg_replace("/\/$/",'',PROTOCOL.DOMAIN.str_replace(array('\\',"index.php","index.html"), '', dirname(htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES))),1).'/',true);


// Sépration des différentes parties des fichiers de conf en sous tableaux
$errors_msg = $erf['errors'];
$route_access = $rof['routing'];
$forms_group = $fof['forms'];
$debug = $cof['config']['debug'];

define("WESIC_VERSION","0.0.1-alpha");

ini_set('upload_max_filesize', '10M');
