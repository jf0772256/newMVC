<?php

	/**
	 *@var $this \Jesse\SimplifiedMVC\View
	 */
	/**
	 *@var $model \Jesse\SimplifiedMVC\Http\Models\User
	 */
	
	use Jesse\SimplifiedMVC\Form\Form;
	
	$this->title = 'Log in';

?>
<!-- HTML code goes here for the view -->
<div class="row">
	<div class="col-6 offset-3">
		<h1>Log in to your account</h1>
	</div>
</div>
<?php
	$form = Form::begin('', 'post', 'row g-3');
	$form->field($model, 'email')->emailField()->generateTextField('col-6 offset-3')->renderField();
	$form->field($model, 'password')->passwordField()->generateTextField('col-6 offset-3')->renderField();
	$form->field($model, '')->generateSubmit('btn-group col-6 offset-3', 'Log In')->renderField();
	Form::end();
?>
<div class="row">
	<div class="col-6 offset-3 text-center">
		<a href="/register" class="btn btn-link">New user? Register here</a>
	</div>
</div>