<?php
	require_once 'core/init.php';
	//Redirect::to('dashboard.php');
	//require_once 'Routes.php';
    //static $errors = [];
    $categoryObj = new Categories();
    $subCategoryObj = new SubCategories();
    $cardObj = new Card();
	$route = new Routes();
    $linkObj = new Link();
	$route->add('/');
	$route->add('/logout');
	$route->add('/register');
	$route->add('other_app_link');
	$route->add('addlink');
	$route->add('savesort');
	$route->add('/adduser');
	$route->add('profile');
	$route->add('subcategory');
	$route->add('updateuser');
	$route->add('deletecard');
	$route->add('deletecategory');
	$route->add('deletesubcategory');
	$route->add('/cards');
	$route->add('/login');
	$route->add('/dashboard');
    $route->add('/addcategory');
    $route->add('/addcard');
    $route->add('/_checkforsub');
	$query = $route->submit();
	$Qstring = '';
	if(!empty($query[1])) $Qstring = html_entity_decode($query[1]);
	if(file_exists($query[0].'.php')) {
		require_once($query[0].'.php');
	} else{
		require_once('includes/errors/404.php');
	}