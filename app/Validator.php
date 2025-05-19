<?php
	
	namespace Jesse\SimplifiedMVC;
	
	abstract class Validator
	{
		public const string RULE_REQUIRED = "required";
		public const string RULE_EMAIL = "email";
		public const string RULE_MIN = "min";
		public const string RULE_MAX = "max";
		public const string RULE_UNIQUE = "unique";
		public const string RULE_MATCH = "match";
		public array $errors = [];
		abstract public function rules() : array ;
		function validate () : bool
		{
			foreach ($this->rules() as $attribute => $rules) {
				$value = $this->{$attribute};
				foreach ($rules as $rule) {
					$ruleName = $rule;
					if (is_array($ruleName)) $ruleName = $rule[0];
					// validation part
					if ($ruleName === self::RULE_REQUIRED && !$value) $this->addErrorForRule($attribute, self::RULE_REQUIRED);
					if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) $this->addErrorForRule($attribute, self::RULE_EMAIL);
					if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) $this->addErrorForRule($attribute, self::RULE_MIN, $rule);
					if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) $this->addErrorForRule($attribute, self::RULE_MAX, $rule);
					if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) $this->addErrorForRule($attribute, self::RULE_MATCH, $rule);
					if ($ruleName === self::RULE_UNIQUE) {
						$className = $rule['class'];
						$uniqueAttribute = $rule['attribute'] ?? $attribute;
						$tableName = $className::tableName();
						// $statement = Application::$app->connection->ExecuteQuery("SELECT * FROM {$tableName} WHERE {$uniqueAttribute} = ?", [$value]);
						$statement = Application::$app->builder->build(Application::$app->builder()->select($tableName, ['*'])->where((string) $uniqueAttribute, '=', (string) $value));
						if ($statement->fetchObject()) $this->addErrorForRule($attribute, self::RULE_UNIQUE, ['field' => $uniqueAttribute]);
						// $statement->closeCursor();
					}
				}
			}
			return empty($this->errors);
		}
		private function addErrorForRule($attribute, $rule, $params = []) : void
		{
			$message = $this->errorMessages()[$rule] ?? '';
			foreach ($params as $key => $value) $message = str_replace("{{$key}}", $value, $message);
			$this->errors[$attribute][] = $message;
		}
	}