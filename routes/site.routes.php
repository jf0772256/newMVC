<?php
	
	use Jesse\SimplifiedMVC\Facades\Router\RequestFacade as Request;
	use Jesse\SimplifiedMVC\Facades\Router\ResponseFacade as Response;
	use Jesse\SimplifiedMVC\Facades\Router\RouterFacade as Router;
	use Jesse\SimplifiedMVC\Http\Controllers\homeController;
	
	require_once __DIR__ . "/../vendor/autoload.php";
	
	$router = new Router(new Request(), new Response());
	
	$router->get('/', [homeController::class, 'home'])->only('auth');
	
	$router->get("/about", [homeController::class, 'about']);
	
	$router->get("/contact", [homeController::class, 'contact']);
	$router->post("/contact", [homeController::class, 'contact']);
	
	// return completed router
	return $router;