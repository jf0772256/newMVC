<?php
	
	namespace Jesse\SimplifiedMVC\Facades\Router;
	
	use \Jesse\SimplifiedMVC\Router\Router;
	use Jesse\SimplifiedMVC\Middleware\Middleware;
	use Jesse\SimplifiedMVC\Application;
	
	class RouterFacade extends Router
	{
		public function __construct()
		{
			parent::__construct();
		}
	}