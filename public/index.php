<?php
	
	use Jesse\SimplifiedMVC\Application;
	
	require_once __DIR__ . "/../vendor/autoload.php";
	$config = require_once "../app/config/config.php";
	
	$app = new Application($config);
	
	$siteRouter = require_once $config['routesPath'] . '/site.routes.php';
	$app->router->use($siteRouter);
	
	$userRouter = require_once $config['routesPath'] . '/user.routes.php';
	$app->router->use($userRouter);
	
	
	$app->run();