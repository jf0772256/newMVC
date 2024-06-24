<div class="container-fluid">
<h1>Contact</h1>
<?php
	
	use Jesse\SimplifiedMVC\Form\Form;
	
	/**
	 * @var $this Jesse\SimplifiedMVC\View
	 * @var $model Jesse\SimplifiedMVC\Http\Models\Contact
	 */
	
	$form = Form::begin("","post", "row g-3");
	$form->field($model, 'firstName')->generateTextField('col-md-6')->renderField();
	$form->field($model, 'lastName')->generateTextField('col-md-6')->renderField();
	$form->field($model, 'email')->emailField()->generateTextField('col-md-12')->renderField();
	$form->field($model, 'subject')->generateTextField('col-md-12')->renderField();
	$form->field($model, 'body')->generateTextArea('col-md-12')->renderField();
	$form->field($model, '')->generateSubmitAndReset('col-12', 'Submit Contact', 'Reset Form')->renderField();
	Form::end();
?>
</div>