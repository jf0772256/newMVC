<?php
	
	use Jesse\SimplifiedMVC\Application;
	use Jesse\SimplifiedMVC\Router\Request;
	use Jesse\SimplifiedMVC\Router\Utilities\URL;
	
	require_once __DIR__ . "/../vendor/autoload.php";
	$config = require_once "../app/config/config.php";
	
	$url = new URL($_SERVER);
	Request::setUrl($url);
	
	$app = new Application($config);
	
	$siteRouter = require_once $config['routesPath'] . '/site.routes.php';
	$app->router->use($siteRouter);
	
	//$userRouter = require_once $config['routesPath'] . '/user.routes.php';
	//$app->router->use($userRouter);
	$app->router->use(require_once $config['routesPath'] . '/user.routes.php');
	
	$app->router->use(require_once $config['routesPath'] . '/api.routes.php');
	
	$app->run();