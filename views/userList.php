<?php
	
	if (!empty($id))
	{
		$contentStr = "<p>User Requested {$id}.</p>";
	}
	else
	{
		// we will change this later
		$contentStr = "<p>No users were found.</p>";
	}
?>

<h1>Hello Welcome to the guest users page</h1>
<?=$contentStr?>