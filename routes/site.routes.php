<?php
	
	use Jesse\SimplifiedMVC\Request;
	use Jesse\SimplifiedMVC\Response;
	use Jesse\SimplifiedMVC\Router;
	use Jesse\SimplifiedMVC\Http\Controllers\homeController;
	
	require_once __DIR__ . "/../vendor/autoload.php";
	
	$router = new Router(new Request(), new Response());
	
	$router->get('/', [homeController::class, 'home']);
	
	$router->get("/about", [homeController::class, 'about']);
	
	// return completed router
	return $router;