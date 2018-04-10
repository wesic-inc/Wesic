<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title><?php if(isset($title)) echo $title ?></title>
		<meta name="description" content="description de ma page">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		<link rel="icon" type="image/png" href="/public/img/favicon.png" />

		<link rel="stylesheet" type="text/css" href="/public/css/homepage.css">
	</head>
	<body>

		<?php include $this->view;?>	
		<script type="text/javascript" src="/public/js/jquery.min.js"></script>
		<script type="text/javascript" src="../public/js/theme-1/code-theme-1.js"></script>
	</body>
</html>