<?php

namespace Jesse\SimplifiedMVC\Http\Models;
use Jesse\SimplifiedMVC\Model;
use Jesse\SimplifiedMVC\Application;

class LoginForm extends Model {
	public string $email = "";
	public string $password = "";
	function rules() : array {
		return [
			'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
			'password' => [self::RULE_REQUIRED]
		];
	}
	function labels () : array {
		return [
			"email" => "Email Address",
			"password" => "Password"
		];
	}
	function login() : bool
	{
		if (empty($this->email) || empty($this->password))
		{
			$this->addError('email', "User Email is incorrect");
			$this->addError('password', 'User Password is incorrect');
			$this->email = "";
			$this->password = "";
			return false;
		}
		$user = User::find(['email' => $this->email]);
		if (!password_verify($this->password, $user->password))
		{
			$this->addError('email', "User Email is incorrect");
			$this->addError('password', 'User Password is incorrect');
			$this->email = "";
			$this->password = "";
			return false;
		}
		return true;
	}
}

?>