<?php  
	/*
		Options: mysql and sqlite
	*/

	return [
		'driver' => 'mysql',
		
		'sqlite' => [
			'host'      => 'database.bd',
		], 
		
		'mysql' => [
			'host'      => 'localhost',
			'database'  => 'miniframework_mvc',
			'user'      => 'root',
			'password'  => '',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci'
		]
	];


?>