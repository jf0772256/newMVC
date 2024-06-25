<?php
	namespace Jesse\SimplifiedMVC\Http\Models;
	use Jesse\SimplifiedMVC\DataModel;
	
	class User extends DataModel
	{
		public int $id;
		public string $firstName = "";
		public string $lastName = "";
		public string $email = "";
		public string $password = "";
		public string $passwordConfirm = "";
		public string $created_at = "";
		public string|null $updated_at;
		static public function tableName (): string
		{
			return "users";
		}
		static public function attributes (): array
		{
			return [
				"firstName",
				"lastName",
				"email",
				"password"
			];
		}
		static public function primaryKey (): string
		{
			return "id";
		}
		public function rules () : array {
			return  [
				"firstName" => [self::RULE_REQUIRED],
				"lastName" => [self::RULE_REQUIRED],
				"email" => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
				"password" => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 36]],
				"passwordConfirm" => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
			];
		}
		public function labels() : array
		{
			return [
				"firstName" => 'First Name',
				"lastName" => 'Last Name',
				"email" => 'Email Address',
				"password" => 'Password',
				"active" => 'User Status',
				"passwordConfirm" => 'Confirm Password'
			];
		}
		public function getDisplayName() : string
		{
			return "{$this->firstName} {$this->lastName}";
		}
		public static function find(array $paramsToFind) : User
		{
			$statement =  parent::findOne($paramsToFind);
			$result = $statement->fetch();
			if ($result && count($result) > 0) {
				//found user, return User model object;
				$user = new User();
				$user->loadData($result);
				$statement->closeCursor();
				return $user;
			}
			$statement->closeCursor();
			return new User();
		}
		public static function every() : array
		{
			$statement = parent::fetchAll();
			$result = $statement->fetchAll();
			$retArray = [];
			foreach ($result as $row)
			{
				$user = new User();
				$user->loadData($row);
				$retArray[] = $user;
			}
			$statement->closeCursor();
			return $retArray;
		}
	}