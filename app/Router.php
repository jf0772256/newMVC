<?php
	
	namespace Jesse\SimplifiedMVC;
	
	use Exception;
	use \Jesse\SimplifiedMVC\exception\NotFound;
	
	class Router extends IRouter
	{
		private Request $request;
		private Response $response;
		function __construct(Request $request, Response $response)
		{
			// Set up the parent class
			parent::__construct();
			$this->request = $request;
			$this->response = $response;
		}
		/**
		 * Takes an instance of Router and combines it to the router that use is called from. Routes with the same
		 * method=>route in the use() will overwrite the existing route.
		 *
		 * @param Router $router router with routes defined
		 *
		 * @return void
		 */
		public function use(Router $router) : self
		{
			$_incomingRoutes = $router->requestRoutesArray($this);
			foreach ($_incomingRoutes as $method => $routeArray)
			{
				foreach ($routeArray as $route => $action)
				{
					parent::add($method,$route, $action);
				}
			}
			return $this;
		}
		public function get (string $route, array|callable|string $action) : self
		{
			parent::add('get', $route, $action);
			return $this;
		}
		public function post (string $route, array|callable|string $action) : self
		{
			parent::add('post', $route, $action);
			return $this;
		}
		public function put (string $route, array|callable|string $action) : self
		{
			parent::add('put', $route, $action);
			return $this;
		}
		public function patch (string $route, array|callable|string $action) : self
		{
			parent::add('patch', $route, $action);
			return $this;
		}
		public function delete (string $route, array|callable|string $action) : self
		{
			parent::add('delete', $route, $action);
			return $this;
		}
		public function update (string $route, array|callable|string $action) : self
		{
			parent::add('update', $route, $action);
			return $this;
		}
		
		/**
		 * Resolves the routes and completes any actions
		 * @return mixed
		 * @throws NotFound
		 * @throws Exception
		 */
		public function resolve() : mixed
		{
			$path = $this->request->getPath();
			$method = $this->request->method();
			$path = $this->request->parameterSearch($this->requestRoutesArray($this,$method), $path);
			// route action
			$callback = $this->requestRoutesArray($this,$method,$path) ?? false;
			// action cannot be null / not set
			if (!$callback)
			{
				// call back is not set
				$this->response->statusCode(404);
				throw new NotFound();
			}
			
			if (is_string($callback))
			{
				// this is a loaded view
				// not yet implemented
				throw new Exception("Not Yet Implemented", 404);
			}
			
			if (is_array($callback))
			{
				// this is the controller process
				// not yet implemented
				throw new Exception("Not Yet Implemented", 404);
			}
			
			// call back is a render function.
			return  call_user_func($callback, $this->request, $this->response);
		}
	}