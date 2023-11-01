<?php
	
	namespace Jesse\SimplifiedMVC\Middleware;
	
	use Jesse\SimplifiedMVC\Response;
	
	class Local
	{
		public function handle () : void
		{
			if (!($_SERVER['REMOTE_ADDR'] === "127.0.0.1" || $_SERVER['REMOTE_ADDR'] === "127.0.1.1" || $_SERVER['REMOTE_ADDR'] === "::1"))
			{
				(new Response)->redirect('/');
			}
		}
	}