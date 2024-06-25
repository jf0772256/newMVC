<?php
	
	use Jesse\SimplifiedMVC\Http\Controllers\ApiController;
	use Jesse\SimplifiedMVC\Http\Controllers\userController;
	use Jesse\SimplifiedMVC\Facades\Router\RequestFacade as Request;
	use Jesse\SimplifiedMVC\Facades\Router\ResponseFacade as Response;
	use Jesse\SimplifiedMVC\Facades\Router\RouterFacade as Router;
	
	require_once __DIR__ . "/../vendor/autoload.php";
	
	$router = new Router(new Request(), new Response());
	
	$router->get('/api/users', [ApiController::class, 'users']);
	$router->get('/api/users/{id}', [ApiController::class, 'user']);
	
	$router->post('/api/user', [userController::class, 'create']);
	
	return $router;