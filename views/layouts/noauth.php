<?php

use Jesse\SimplifiedMVC\Application;
/**
 *@var $this \Jesse\SimplifiedMVC\View
 */

?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=$this->title ?></title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
		<link rel="stylesheet" href="/fontawesome/css/all.css">
	</head>
	<body class="container">
		{{content}}
	</body>
</html>
