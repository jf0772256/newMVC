<?php
	
	namespace Jesse\SimplifiedMVC;
	
	class Response
	{
		private array $errorTitles = [
			"403" => "403: You're Not Authorized",
			"404" => "404: Page Not Found"
		];
		function statusCode(?int $code) : ?int
		{
			return http_response_code($code ?? 0);
		}
		function errorTitle(int $error, ?string $errorTitle = NULL) : ?string
		{
			if (!empty($errorTitle))
			{
				$this->errorTitles[(string)$error] = $errorTitle;
				return null;
			}
			if (!array_key_exists((string)$error, $this->errorTitles)) return "Error";
			return $this->errorTitles[(string)$error];
		}
		function redirect(string $path) : never
		{
			header("Location: $path");
			exit;
		}
	}