<?php ?>

<h1>Hello World</h1>
<?php
	
	use Jesse\SimplifiedMVC\Form\Form;
	use Jesse\SimplifiedMVC\Http\Models\User;
	
	$user = new User();
	$form = Form::begin('/logout', 'post', '');
	$form->field($user, '')->generateSubmit('','Log Out')->renderField();
	Form::end();
?>