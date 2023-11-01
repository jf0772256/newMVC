<?php
	
	use Jesse\SimplifiedMVC\Request;
	use Jesse\SimplifiedMVC\Response;
	use Jesse\SimplifiedMVC\Router;
	use Jesse\SimplifiedMVC\Utilities\Utility;
	
	require_once __DIR__ . "/../vendor/autoload.php";
	
	$router = new Router(new Request(), new Response());
	
	$router->get('/', function ()
	{
		echo "<h1>Hello World!</h1>";
	});
	
	$router->get("/about", function ()
	{
		echo "<h1>About Us!</h1>";
		echo "<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aspernatur cumque enim error, exercitationem facere maxime minus molestiae nam nobis non perferendis porro quidem temporibus unde! Earum in itaque repellendus!</p>";
	});
	
	// return completed router
	return $router;