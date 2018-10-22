<?php
require 'environment.php';

global $config;
global $db;

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/farmacia/");
	$config['dbname'] = 'farmacia';
	$config['host'] = 'localhost:3306';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
} else {
	define("BASE_URL", "http://localhost/farmacia/");
	$config['dbname'] = 'farmacia';
	$config['host'] = 'localhost:3306';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
}

$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>