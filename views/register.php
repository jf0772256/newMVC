<?php

/**
 *@var $this \Jesse\SimplifiedMVC\View
 */
	
	/**
	 * @var $model Jesse\SimplifiedMVC\Http\Models\User
	 */
	
	use Jesse\SimplifiedMVC\Form\Form;
	
	$this->title = 'Register User';

?>
<!-- HTML code goes here for the view -->
<h2>Register</h2>

<?php
	$form = Form::begin('', 'post', 'row g3');
	$form->field($model, 'firstName')->generateTextField('col-6')->renderField();
	$form->field($model, 'lastName')->generateTextField('col-6')->renderField();
	$form->field($model, 'email')->generateTextField('col-12')->renderField();
	$form->field($model, 'password')->passwordField()->generateTextField('col-12')->renderField();
	$form->field($model, 'passwordConfirm')->passwordField()->generateTextField('col-12')->renderField();
	$form->field($model, '')->generateSubmit('col-6 offset-6 text-end mt-3', 'Register')->renderField();
	Form::end();
?>