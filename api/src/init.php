<?php
ini_set("display_errors", 'on');

$GLOBALS['config'] = array(
    'app' => array(
        'name' => 'Placeholder',
        'version' => "1.0",
        'title' => "Cards",
        'header' => "Admin",
        'copyright' => "valence solutions",
        'designer' => "CEO",
    ),
    'cards' => array(
        'max_size' => 1000000,
        'image/jpeg','image/png','image/'
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
    require_once '../../admin/classes/' . $class . '.php';	//requires a class only when needed
}
);
require_once '../../admin/functions/sanitize.php'; //includes the function file