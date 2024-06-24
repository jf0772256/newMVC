<?php
	
	namespace Jesse\SimplifiedMVC\Form;
	
	use Jesse\SimplifiedMVC\Model;
	
	class Form
	{
		static function begin (string $action, string $method, string $classes = '') : Form
		{
			echo "<form action='{$action}' method='{$method}' class='{$classes}'>";
			return new Form();
		}
		
		static function end () : void
		{
			echo "</form>";
		}
		
		function field(Model $model, $attribute) : Field
		{
			return new Field($model, $attribute);
		}
	}