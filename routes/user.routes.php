<?php
	
	use Jesse\SimplifiedMVC\Request;
	use Jesse\SimplifiedMVC\Response;
	use Jesse\SimplifiedMVC\Router;
	
	require_once __DIR__ . "/../vendor/autoload.php";
	
	$router = new Router(new Request(), new Response());
	
	// internal routes -- Note though that any routes added with teh same route and method will overwrite preceding routes
	$router->get('/users', function()
	{
		echo "<h1>Hello Welcome to the users page</h1>";
		echo "<p>No Users were found</p>";
	});
	
	// testing that the params works
	$router->get('/users/{id}', function(Request $request)
	{
		echo "<h1>Hello Welcome to the authenticated users page</h1>";
		echo "<p>you requested user {$request->params['id']}</p>";
	})->only('auth');
	
	// testing that the params works
	$router->get('/user', function(Request $request)
	{
		echo "<h1>Hello Welcome to the guest users page</h1>";
	})->only('guest');
	
	// return completed router
	return $router;