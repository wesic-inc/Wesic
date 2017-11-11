<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Titre de ma page</title>
		<meta name="description" content="description de ma page">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php if(isset($title)) echo $title ?></title>
		<link rel="icon" type="image/png" href="<?php echo routing::getRoot() ?>assets/img/favicon.png" />
		<link href="<?php echo routing::getRoot() ?>assets/css/font-awesome.min.css" rel="stylesheet" >
	</head>
	<body>

		<?php include $this->view;?>	

	</body>
</html>