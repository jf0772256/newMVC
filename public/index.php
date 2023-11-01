<?php
	
	use Jesse\SimplifiedMVC\Application;
	use Jesse\SimplifiedMVC\Exception\NotFound;
	use Jesse\SimplifiedMVC\Utilities\Utility;
	
	require_once __DIR__ . "/../vendor/autoload.php";
	$config = require_once "../app/config/config.php";
	
	$app = new Application($config);
	
	$siteRouter = require_once $config['routesPath'] . '/site.routes.php';
	$app->router->use($siteRouter);
	
	//$userRouter = require_once $config['routesPath'] . '/user.routes.php';
	//$app->router->use($userRouter);
	$app->router->use(require_once $config['routesPath'] . '/user.routes.php');
	
	$app->router->get('/test/serverTest', function ($request, $response)
	{
		header('Content-Type: application/json');
		Utility::dieAndDumpPretty($_SERVER);
	})->only('local');
	
	$app->router->get('/test/route_dump', function($req, $res)
	{
		Utility::dieAndDumpPretty(Application::$app->router->test());
	})->only('local');
	
	try
	{
		$app->router->resolve();
	}
	catch (NotFound $e)
	{
		$app->response->statusCode(404);
		die($app->response->errorTitle($app->response->statusCode()));
	}
	catch (Exception $e)
	{
		die($e);
	}
	// $app->run();