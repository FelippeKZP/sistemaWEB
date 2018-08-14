<?php
require 'environment.php';

global $config;
global $db;

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/farmacia/");
	$config['dbname'] = 'farmacia';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'felippe';
	$config['dbpass'] = 'camaro';
} else {
	define("BASE_URL", "http://localhost/farmacia/");
	$config['dbname'] = 'farmacia';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'felippe';
	$config['dbpass'] = 'camaro';
}

$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>