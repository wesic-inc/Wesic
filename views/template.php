<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Titre de ma page</title>
		<meta name="description" content="description de ma page">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		<link rel="icon" type="image/png" href="<?php echo routing::getRoot() ?>assets/img/favicon.png" />

		<link rel="stylesheet" type="text/css" href="<?php echo routing::getRoot() ?>assets/css/core.css">
		<link rel="stylesheet" type="text/css" href="<?php echo routing::getRoot() ?>assets/css/grid.css">
		<link rel="stylesheet" type="text/css" href="<?php echo routing::getRoot() ?>assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo routing::getRoot() ?>assets/css/theme.css">
		<title><?php if(isset($title)) echo $title ?></title>
	</head>
	<body>

		<?php include $this->view;?>	
		<script type="text/javascript" src="<?php echo routing::getRoot() ?>assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo routing::getRoot() ?>assets/js/code.js"></script>
	</body>
</html>