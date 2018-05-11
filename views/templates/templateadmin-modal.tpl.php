<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title><?php if(isset($title)) echo $title ?></title>
		<meta name="description" content="description de ma page">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		<link rel="icon" type="image/png" href="/public/img/light.png" />
		
		<link rel="stylesheet" type="text/css" href="/public/css/admin.css">
		<link rel="stylesheet" href="/public/icomoon/style.css"></head>
		<link rel="stylesheet" href="/public/js/trumbowyg/ui/trumbowyg.min.css"></head>

	</head>
	<body>
		<?php include $this->view;?>
		<script type="text/javascript" src="/public/js/jquery.min.js"></script>
		<script src="/public/js/trumbowyg/trumbowyg.min.js"></script>
		<script type="text/javascript" src="/public/js/code.js"></script>
	</body>
</html>