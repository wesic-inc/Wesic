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
	<?php require('views/templates/navbar-admin-sidebar.tpl.php'); ?>
	<?php if($_COOKIE["toggled-sidebar"] == 'true'): ?>
		<div class="content-wrapper" id="main-container">
			<?php else: ?>
				<div class="content-wrapper collapsed" id="main-container"> 
				<?php endif; ?>

				<?php if(isset($_SESSION['flash-body'])): ?>
				<div class="alert alert-top alert-<?php echo $_SESSION['flash-type'];?>" id="<?php echo $_SESSION['flash-id']; ?>" role="alert">
					<strong><?php echo $_SESSION['flash-title'];?></strong> <?php echo $_SESSION['flash-body'];?>
						<a type="btn" onclick="destroyFlash('<?php echo $_SESSION['flash-id']; ?>')" class="close push-right">
						<span class="icon icon-cross"></span>
					</a>
					<hidden value="<?php echo $_SESSION['flash-id']; ?>">
				</div>
				<?php endif; ?>

				<?php include $this->view;?>	
			</div>
			<script type="text/javascript" src="/public/js/jquery.min.js"></script>
			<script src="/public/js/trumbowyg/trumbowyg.min.js"></script>
			<script type="text/javascript" src="/public/js/code.js"></script>
			<script type="text/javascript" src="/public/js/ajax.js"></script>
		</body>
		</html>