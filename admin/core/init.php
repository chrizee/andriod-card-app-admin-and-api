<?php
ob_start();
session_start();
ini_set("smtp_port", "25");
ini_set("sendmail_from", "example@gmail.com");
ini_set("display_errors", 'on');
ini_set("SMTP", "gmail");

$GLOBALS['config'] = array(
	'app' => array(
		'name' => 'Placeholder',
		'version' => "1.0",
		'title' => "Cards",
		'header' => "Admin",
		'currency' => 'N',
		'copyright' => "valence solutions",
		'designer' => "CEO",
        'delete_files_permanently' => 1
	),
	'cards' => array(
		'max_size' => 2000000,
		'formats' => array('image/jpeg', 'image/png', 'image/gif'),
	),
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'root',
		'password' => 'christo16',
		'db' => 'app'
	),
	'session' => array(
		'session_admin' => 'admin',
		'token_name' => 'token'
	),
	'cookie' => array(
		'cookie_name' => 'cook',
		'remember' => 'remember',
		'expiry_one_day' => 86400,
		'expiry_one_week' => 604800
	),
	'status' => array(
		'deleted' => 0,
		'active' => 1,
	),
	'tag' => array(
		'free' => 0,
		'paid' => 1,
	)
);

spl_autoload_register(function($class) {
	require_once 'classes/' . $class . '.php';	//requires a class only when needed
	}
);
require_once 'functions/sanitize.php'; //includes the function file