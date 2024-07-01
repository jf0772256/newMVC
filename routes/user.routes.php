<?php
	
	use Jesse\SimplifiedMVC\Http\Controllers\userController;
	use Jesse\SimplifiedMVC\Facades\Router\RequestFacade as Request;
	use Jesse\SimplifiedMVC\Facades\Router\ResponseFacade as Response;
	use Jesse\SimplifiedMVC\Facades\Router\RouterFacade as Router;
	
	require_once __DIR__ . "/../vendor/autoload.php";
	
	$router = new Router(new Request(), new Response());
	$router->controller(userController::class)->prefix('/user');
	
	// internal routes -- Note though that any routes added with the same route and method will overwrite preceding routes
	// see below... the last route overwrites this one
	
	$router->get('/', function(Request $request, Response $response) { $response->redirect('/users'); });
	$router->get('/{id}', 'authUserView')->only('auth');
	
	//change the prefix to a different one
	$router->prefix('/users');
	
	$router->get('/', 'guestUserView')->only('guest');
	$router->get('/{id}', 'guestUserView')->only('guest');
	
	// clearing the prefix
	$router->prefix();
	
	$router->get('/register', 'register')->only('guest');
	$router->post('/register', 'register')->only('guest');
	
	$router->get('/login', 'login')->only('guest');
	$router->post('/login', 'login')->only('guest');
	
	$router->post('/logout', 'logout')->only('auth');
	
	// return completed router
	return $router;