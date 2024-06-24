<?php
	
	use Jesse\SimplifiedMVC\Http\Controllers\userController;
	use Jesse\SimplifiedMVC\Facades\Router\RequestFacade as Request;
	use Jesse\SimplifiedMVC\Facades\Router\ResponseFacade as Response;
	use Jesse\SimplifiedMVC\Facades\Router\RouterFacade as Router;
	
	require_once __DIR__ . "/../vendor/autoload.php";
	
	$router = new Router(new Request(), new Response());
	
	// internal routes -- Note though that any routes added with the same route and method will overwrite preceding routes
	// see below... the last route overwrites this one
	$router->get('/user', function(Request $request, Response $response) { $response->redirect('/users'); });
	$router->post('/user', [userController::class, 'create']);
	$router->get('/user/{id}', [userController::class, 'authUserView'])->only('auth');
	$router->get('/users', [userController::class, 'guestUserView'])->only('guest');
	$router->get('/users/{id}', [userController::class, 'guestUserView'])->only('guest');
	
	$router->get('/register', [userController::class, 'register'])->only('guest');
	$router->post('/register', [userController::class, 'register'])->only('guest');
	
	$router->get('/login', [userController::class, 'login'])->only('guest');
	$router->post('/login', [userController::class, 'login'])->only('guest');
	
	$router->post('/logout', [userController::class, 'logout'])->only('auth');
	
	// return completed router
	return $router;