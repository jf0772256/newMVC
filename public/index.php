<?php
	
	use Jesse\SimplifiedMVC\Application;
	use Jesse\SimplifiedMVC\Router\Request;
	use Jesse\SimplifiedMVC\Router\Utilities\URL;
	
	require_once __DIR__ . "/../vendor/autoload.php";
	$config = require_once "../app/config/config.php";
	
	$url = new URL($_SERVER);
	$app = new Application($config);
	$app->request->setUrl($url);
	
	
//	$siteRouter = require_once $config['routesPath'] . '/site.routes.php';
//	$app->router->use($siteRouter);
	
	//$app->router->use(require_once $config['routesPath'] . '/user.routes.php');
	
	$app->router->use('site.routes')
		->use('user.routes')
		->use('api.routes');
	
	$app->run();