<?php
	
	namespace Jesse\SimplifiedMVC\Http\Models;
	
	use Jesse\SimplifiedMVC\DataModel;
	
	class Contact extends DataModel
	{
		public int $id = 0;
		public string $firstName = '';
		public string $lastName = '';
		public string $email = '';
		public string $subject = '';
		public string $body = '';
		
		static public function tableName (): string
		{
			return 'contacts';
		}
		
		static public function attributes (): array
		{
			return [
				'firstName',
				'lastName',
				'email',
				'subject',
				'body'
			];
		}
		
		static public function primaryKey (): string
		{
			return 'id';
		}
		
		public function rules (): array
		{
			return  [
				"firstName" => [self::RULE_REQUIRED],
				"lastName" => [self::RULE_REQUIRED],
				"body" => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 1000]],
				"subject" => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 255]],
				"email" => [self::RULE_REQUIRED, self::RULE_EMAIL]
			];
		}
		
		function labels() : array {
			return [
				"firstName" => 'First Name',
				"lastName" => 'Last Name',
				"email" => 'Email Address',
				'subject' => "Subject",
				'body' => "Body",
			];
		}
	}