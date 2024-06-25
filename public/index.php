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
	
	//$app->router->use(require_once $config['routesPath'] . '/user.routes.php');
	
	$app->router->use('user.routes')->use('api.routes');
	
	$app->run();