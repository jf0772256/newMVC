<?php
	
	use Jesse\SimplifiedMVC\Facades\Router\RequestFacade as Request;
	use Jesse\SimplifiedMVC\Facades\Router\ResponseFacade as Response;
	use Jesse\SimplifiedMVC\Facades\Router\RouterFacade as Router;
	use Jesse\SimplifiedMVC\Http\Controllers\homeController;
	
	require_once __DIR__ . "/../vendor/autoload.php";
	
	$router = new Router(new Request(), new Response());
	$router->controller(homeController::class);
	
	$router->get('/', 'home')->only('auth');
	
	$router->get("/about", 'about');
	
	$router->get("/contact", 'contact');
	$router->post("/contact", 'contact');
	
	// return completed router
	return $router;