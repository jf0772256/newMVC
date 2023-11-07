<?php
	
	namespace Jesse\SimplifiedMVC\Exception;
	use Exception;
	class BadRequest extends Exception
	{
		protected $code = 400;
		protected $message = "The server wasn't able to understand or accept this request";
	}