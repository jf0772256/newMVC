<?php
	
	namespace Jesse\SimplifiedMVC\Middleware;
	
	use Jesse\SimplifiedMVC\Response;
	use Jesse\SimplifiedMVC\Utilities\Signature;
	use Jesse\SimplifiedMVC\Utilities\URL;
	
	class Signed
	{
		public function handle() : void
		{
			Signature::setKey($_ENV['SIGNATURE_KEY']);
			$url = new URL($_SERVER);
			// check signature if not pass throw an error or redirect
			$incomingServerRequest = $url->getURLRequestQuery();
			$signature = $url->getSignature();
			// check if the signature exists and is valid
			if (empty($signature) || !Signature::verify($signature, $incomingServerRequest))
			{
				// missing signature
				(new Response)->redirect('/');
			}
		}
	}