<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title><?php echo isset($title)?$title:"Mon site !" ?></title>
		<meta name="description" content="<?php echo isset($description)?$description:"Mon site !" ?>">
		<meta name="viewport" content="width=device-width, initial-scale=0.5, maximum-scale=1, user-scalable=no">

		<link rel="icon" type="image/png" href="<?php echo ROOT_URL.Setting::getParam('favicon'); ?>" />

		<link rel="stylesheet" href="/public/icomoon/style.css"></head>
		<link rel="stylesheet" type="text/css" href="/public/css/homepage.css">
	</head>
	<body>
		<?php if(Auth::isConnected()){ $this->addModal("admin-navbar",""); } ?>	
		
		<?php include $this->view;?>
		<script type="text/javascript" src="/public/js/jquery.min.js"></script>
		<script type="text/javascript" src="../public/js/theme-1/code-theme-1.js"></script>
	</body>
</html>