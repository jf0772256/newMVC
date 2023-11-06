<?php
	
	namespace Jesse\SimplifiedMVC\Utilities;
	
	class SimpleEncoder
	{
		private static string $key;
		
		public function __construct(string $key)
		{
			SimpleEncoder::$key = $key;
		}
		
		public function encode (string $token) : string
		{
			
			$token = str_rot13($token);
			$token = $this->xor($token);
			$token = base64_encode($token);
			// make url safe
			$token = str_replace(['+','/','='],['_','.',''],$token);
			return $token;
		}
		public function decode (string $token) : string
		{
			// make url safe
			$token = str_replace(['_','.'],['+','/'],$token);
			$token = base64_decode($token);
			$token = $this->xor($token);
			$token = str_rot13($token);
			return $token;
		}
		
		private function xor(string $input) : string
		{
			for($i = 0; $i < strlen($input); $i++) $input[$i] = ($input[$i] ^ SimpleEncoder::$key[$i % strlen(SimpleEncoder::$key)]);
			return $input;
		}
	}