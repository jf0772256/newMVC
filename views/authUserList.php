<?php
	/**
	 * @var \Jesse\SimplifiedMVC\Http\Models\User $model
	 */
	$displayName = $model->getDisplayName();
	
echo "<h1>Hello! welcome to the authenticated users page</h1>";
if (!empty($id)) echo "<p>You requested user {$displayName}</p>";
if (empty($id)) echo "<p>Unable to locate the requested user</p>";