<?php
	
	use Jesse\SimplifiedMVC\Http\Controllers\ApiController;
	use Jesse\SimplifiedMVC\Http\Controllers\userController;
	use Jesse\SimplifiedMVC\Facades\Router\RequestFacade as Request;
	use Jesse\SimplifiedMVC\Facades\Router\ResponseFacade as Response;
	use Jesse\SimplifiedMVC\Facades\Router\RouterFacade as Router;
	
	require_once __DIR__ . "/../vendor/autoload.php";
	
	$router = new Router(new Request(), new Response());
	$router->prefix('/api/v1');
	
	$router->get('/users', [ApiController::class, 'users']);
	$router->get('/users/{id}', [ApiController::class, 'user']);
	
	$router->post('/user', [userController::class, 'create']);
	
	return $router;