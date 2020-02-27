<?php
	/*	
		definition all the routes of system
		first parameter is the route
		/home
		second parameter is the controller the responsible for the route 
		@[action]
	*/

	$route[] = ['/', 'HomeController@index'];
	$route[] = ['/posts', 'PostsController@index'];
	$route[] = ['/posts/{id}/show', 'PostsController@show'];

	return $route;

?>