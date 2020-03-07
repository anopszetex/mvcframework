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
	$route[] = ['/post/{id}/show', 'PostsController@show'];
	$route[] = ['/post/create', 'PostsController@create'];
	$route[] = ['/post/store', 'PostsController@store'];
	$route[] = ['/post/{id}/edit', 'PostsController@edit'];
	$route[] = ['/post/{id}/update', 'PostsController@update'];

	return $route;

?>