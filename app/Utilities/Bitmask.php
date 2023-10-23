<?php
	
	namespace Jesse\SimplifiedMVC\Utilities;
	
	class Bitmask
	{
		private array $values = [];
		
		public function __construct(array $values)
		{
			$this->values = $values;
		}
		
		public function GetMask(array $items) : int
		{
			return $this->bitmapEncode($items);
		}
		
		public function CheckMask(int $mask, string $valueToValidate) : bool
		{
			return $this->bitmapDecode($mask, $valueToValidate);
		}
		
		private function bitmapEncode(array $items) : int
		{
			$return = 0;
			$newRoles = array_flip($this->values); // swap the keys and values
			foreach ($items as $item) {
				$i = $newRoles[$item]; // get the decimal key value for the item on the list
				$i = 2**$i; // use 2 to the nth power to get the decimal bitmap value for the item
				$return += $i; // add $i to the return value
			}
			return $return;
		}
		
		private function bitmapDecode(int $mask, string $checkItem) : bool
		{
			$newRoles = array_flip( $this->values ); // swap the keys and values
			$i = $newRoles[ $checkItem ]; // get the decimal key value for the item on the list
			$i =  2**$i; // use 2 to the nth power to get the decimal bitmap value for the item
			return (bool)($mask & $i); // use the & operator to determine if the value is true or false. return 1 or 0 accordingly
		}
	}