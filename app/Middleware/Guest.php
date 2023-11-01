<?php
	
	namespace Jesse\SimplifiedMVC\Middleware;
	
	use Jesse\SimplifiedMVC\Response;
	
	class Guest
	{
		public function handle () : void
		{
			// do auth check... if authenticated redirect to new location
		}
	}