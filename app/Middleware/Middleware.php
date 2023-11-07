<?php
	
	namespace Jesse\SimplifiedMVC\Middleware;
	use Jesse\SimplifiedMVC\Exception\MiddlewareNotFound;
	class Middleware
	{
		const MAP = [
			'local' => Local::class,
			'auth' => Auth::class,
			'guest' => Guest::class,
			'signed' => Signed::class
		];
		
		/**
		 * @throws Exception
		 */
		public static function resolve ($key) : void
		{
			if (!$key) return;
			if (!array_key_exists($key, static::MAP)) throw new MiddlewareNotFound($key);
			$middleware = static::MAP[$key];
			(new $middleware)->handle();
		}
	}