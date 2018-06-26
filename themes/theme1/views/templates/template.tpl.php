<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?php echo isset($title)?$title:"Mon site !" ?></title>
	<meta name="description" content="<?php echo isset($description)?$description:"Mon site Wesic" ?>">
	<meta name="viewport" content="width=device-width, initial-scale=0.5, maximum-scale=1, user-scalable=no">

	<link rel="icon" type="image/png" href="<?php echo ROOT_URL.setting('favicon'); ?>" />

	<link rel="stylesheet" href="/public/icomoon/style.css"></head>
	<link rel="stylesheet" type="text/css" href="/themes/<?php echo setting('theme'); ?>/assets/css/style.css">

</head>
<body>
	<?php if(Auth::isConnected()){ $this->addModal("admin-navbar",""); } ?>	
	<div class="layout">
		
		<?php require('themes/'.setting('theme').'/views/templates/navbar.tpl.php'); ?>
		<?php include $this->view;?>
		
	</div>
	<script type="text/javascript" src="/public/js/jquery.min.js"></script>
	<script type="text/javascript" src="/themes/<?php echo setting('theme'); ?>/assets/js/code.js"></script>
</body>
</html>s