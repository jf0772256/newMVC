<?php
//
	
	$title = $title ?? 'MyMVC Home';
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?=$title?></title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<script src="/js/bootstrap.bundle.js"></script>
	<link rel="stylesheet" href="/fontawesome/css/all.css">
</head>
<body>
	<div class="container">
		{{content}}
	</div>
</body>
</html>