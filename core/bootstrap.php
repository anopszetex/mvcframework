<?php
	/* 
		Start Session
	*/
	
	if(!session_id()) 
		session_start();
	
	/* 
		Initialization the routes
	*/

	$routes = require_once(__DIR__.'/../app/routes.php');
	$route  = new \Core\Route($routes);

?>