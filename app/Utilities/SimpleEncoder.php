<?php
	
	namespace Jesse\SimplifiedMVC\Utilities;
	
	class SimpleEncoder
	{
		private string $token;
		private static string $key;
		
		public function __construct(string $token, ?string $key)
		{
			if (!empty($key)) SimpleEncoder::$key = $key;
			if (empty(SimpleEncoder::$key)) openssl_random_pseudo_bytes(512);
			$this->token = $token;
		}
		
		public function encode () : string
		{
			$this->token = str_rot13($this->token);
			$this->token = gzdeflate($this->token,7);
			$this->token = $this->xor($this->token);
			$this->token = base64_encode($this->token);
			// make url safe
			$this->token = urlencode($this->token);
			return $this->token;
		}
		public function decode () : string
		{
			// make url safe
			$this->token = urldecode($this->token);
			$this->token = base64_decode($this->token);
			$this->token = $this->xor($this->token);
			$this->token = gzinflate($this->token);
			$this->token = str_rot13($this->token);
		}
		
		private function xor(string $input) : string
		{
			for($i = 0; $i < strlen($input); $i++) $input[$i] = ($input[$i] ^ SimpleEncoder::$key[$i % strlen(SimpleEncoder::$key)]);
			return $input;
		}
	}