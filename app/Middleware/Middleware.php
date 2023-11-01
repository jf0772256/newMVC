<?php
	
	namespace Jesse\SimplifiedMVC\Middleware;
	use Exception;
	class Middleware
	{
		const MAP = [
			'local' => Local::class,
			'auth' => Auth::class,
			'guest' => Guest::class
		];
		
		/**
		 * @throws Exception
		 */
		public static function resolve ($key) : void
		{
			if (!$key) return;
			if (!array_key_exists($key, static::MAP)) throw new Exception("No matching middleware found for '{$key}'.", 404);
			$middleware = static::MAP[$key];
			(new $middleware)->handle();
		}
	}