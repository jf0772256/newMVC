<?php
	
	namespace Jesse\SimplifiedMVC\Middleware;
	
	use Jesse\SimplifiedMVC\Response;
	use Jesse\SimplifiedMVC\Utilities\Signature;
	
	class Signed
	{
		public function handle() : void
		{
			Signature::setKey($_ENV['SIGNATURE_KEY']);
			// check signature if not pass throw an error or redirect
			$incomingServerRequest = $_SERVER['REQUEST_SCHEME'] . "://" .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . (!empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '');
			$parts = explode('&signature=', $incomingServerRequest);
			// check if the signature exists and is valid
			if (count($parts) <=1 || empty($parts[1]) || !Signature::verify($parts[1], $parts[0]))
			{
				// missing signature
				(new Response)->redirect('/');
			}
		}
	}