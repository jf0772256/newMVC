<?php
	
	namespace Jesse\SimplifiedMVC\Utilities;
	
	class Signature
	{
		private static string $hashKey;
		static function sign(string $data) : string
		{
			$raw_hash = hash_hmac('sha256', $data, self::$hashKey);
			return str_replace(['+','/','='],['_','.',''],base64_encode($raw_hash));
		}
		static function verify(string $signature, string $userProvided) : bool
		{
			$raw_hash = base64_decode(str_replace(['_','.'], ['+','/'], $signature));
			return $raw_hash === hash_hmac('sha256', $userProvided, self::$hashKey);
		}
		
		static function setKey(string $keyValue) : bool
		{
			if (empty(self::$hashKey) || $keyValue === self::$hashKey)
			{
				self::$hashKey = $keyValue;
				return true;
			}
			return false;
		}
	}