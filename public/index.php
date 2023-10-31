<?php
	
	use Jesse\SimplifiedMVC\Application;
	use Jesse\SimplifiedMVC\Request;
	
	require_once __DIR__ . "/../vendor/autoload.php";
	$config = require_once "../app/config/config.php";
	
	$app = new Application($config);
	
	$baselRouter = require_once '../routes/base.routes.php';
	$app->router->use($baseRouter);
	
	// internal routes -- Note though that any routes added with teh same route and method will overwrite preceding routes
	$app->router->get('/users', function()
	{
		echo "<h1>Hello Welcome to the users page</h1>";
		echo "<p>No Users were found</p>";
	});
	
	// testing that the params works
	$app->router->get('/user/{id}', function(Request $request)
	{
		echo "<h1>Hello Welcome to the users page</h1>";
		echo "<p>you requested user {$request->params['id']}</p>";
	});
	// testing that the params works
	$app->router->get('/user', function(Request $request)
	{
		echo "<h1>Hello Welcome to the users page</h1>";
		echo "<p>you requested user {$request->params['id']}</p>";
	});
	
	
	$app->run();