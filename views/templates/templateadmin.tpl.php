<!DOCTYPE HTML>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?php if(isset($title)) echo $title ?></title>
	<meta name="description" content="description de ma page">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<link rel="icon" type="image/png" href="<?php echo ROOT_URL.Setting::getParam('favicon'); ?>">

	<link rel="stylesheet" type="text/css" href="/public/css/admin.css">
	<link rel="stylesheet" href="/public/icomoon/style.css"></head>
	<link rel="stylesheet" href="/public/js/trumbowyg/ui/trumbowyg.min.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>



</head>
<body>
	<div id="loader-wrapper">
		<div id="loader" class="spinner icon-spinner2" aria-hidden="true"></div>
	</div>

	<?php require('views/templates/navbar-admin-sidebar.tpl.php'); ?>
	<?php if(isset($_COOKIE["toggled-sidebar"]) && $_COOKIE["toggled-sidebar"] == "true"): ?>
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
				<script src="/public/js/trumbowyg/plugins/fontfamily/trumbowyg.fontfamily.min.js"></script>
				<script src="https://rawgit.com/RickStrahl/jquery-resizable/master/dist/jquery-resizable.min.js"></script>
				<script src="/public/js/trumbowyg/plugins/resizimg/trumbowyg.resizimg.js"></script>
				<script src="/public/js/trumbowyg/plugins/insertaudio/trumbowyg.insertaudio.js"></script>


				<script type="text/javascript" src="/public/js/dragula.min.js"></script>
				<script type="text/javascript" src="/public/js/code.js"></script>
				<script type="text/javascript" src="/public/js/ajax.js"></script>
				<script type="text/javascript" src="/public/js/stats.js"></script>
				
				<?php if(isset($medias)): ?>
				<script type="text/javascript" src="/public/js/medias.js"></script>
				<?php endif; ?>


			</body>
			</html>