<?php
	
	namespace Jesse\SimplifiedMVC;
	
	use http\Exception\InvalidArgumentException;
	
	class IRouter
	{
		protected array $routes;
		
		protected function __construct()
		{
			$this->routes = [
				"get" => [],
				"post" => [],
				"put" => [],
				"update"=> [],
				"patch" => [],
				"delete" => []
			];
		}
		
		protected function requestRoutesArray($caller, ?string $method = null, ?string $route = null) : array
		{
			if ($caller instanceof Router) throw new InvalidArgumentException("Caller type mismatch. must be caller type of Jesse\SimplifiedMVC\Router", 400);
			if (empty($method) && empty($route)) return $this->routes;
			if (!empty($method) && empty($route)) return $this->routes[$method];
			if (!empty($method) && !empty($route)) return $this->routes[$method][$route];
			throw new InvalidArgumentException("Out of order parameters", 400);
		}
		
		protected function add(string $method, string $route, array|callable|string $action) : void
		{
			$this->routes[$method] = [$route => $action];
		}
	}