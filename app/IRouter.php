<?php
	
	namespace Jesse\SimplifiedMVC;
	
	use InvalidArgumentException;
	
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
		
		protected function requestRoutesArray($caller, ?string $method = null, ?string $route = null) : array|callable|bool
		{
			if ($caller instanceof Router) throw new InvalidArgumentException("Caller type mismatch. must be caller type of Jesse\SimplifiedMVC\Router", 400);
			if (empty($method) && empty($route)) return $this->routes;
			if (!empty($method) && empty($route)) return $this->routes[$method];
			if (!empty($method) && !empty($route) && array_key_exists($route, $this->routes[$method])) return $this->routes[$method][$route];
			if (!empty($method) && !empty($route) && !array_key_exists($route, $this->routes[$method])) return false;
			throw new InvalidArgumentException("Out of order parameters", 400);
		}
		
		protected function add(string $method, string $route, array|callable|string $action) : void
		{
			$this->routes[$method] = [$route => $action];
		}
	}