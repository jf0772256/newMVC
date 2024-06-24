<?php
	
	namespace Jesse\SimplifiedMVC\Facades\Router;
	
	use \Jesse\SimplifiedMVC\Router\Router;
	use Jesse\SimplifiedMVC\Middleware\Middleware;
	use Jesse\SimplifiedMVC\Application;
	use \Jesse\SimplifiedMVC\Facades\Router\RequestFacade;
	use \Jesse\SimplifiedMVC\Facades\Router\ResponseFacade;
	
	class RouterFacade extends Router
	{
		public function __construct(RequestFacade $request, ResponseFacade $response)
		{
			parent::__construct($request, $response);
			$this->__set_facade_classes(Application::class, Middleware::class);
		}
	}