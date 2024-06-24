<?php
	
	namespace Jesse\SimplifiedMVC;
	
	abstract class Model extends Validator
	{
		function loadData ($data) : void
		{
			foreach ($data as $key => $value) if (property_exists($this, $key)) $this->{$key} = $value;
		}
		function addError($attribute, $message) : void { $this->errors[$attribute][] = $message; }
		function errorMessages () : array {
			return [
				self::RULE_REQUIRED => "This field is required",
				self::RULE_EMAIL => "This field must be a valid email address",
				self::RULE_MIN => "Min length of this field must be {min}",
				self::RULE_MAX => "Max length of this field must be {max}",
				self::RULE_MATCH => "This field must be the same as {match}",
				self::RULE_UNIQUE => "Record with this {field} already exists"
			];
		}
		function hasError($attribute) { return $this->errors[$attribute] ?? false; }
		function getFirstError($attribute) { return $this->errors[$attribute][0] ?? false; }
	}