<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	
	<?php the_sitename(); ?>
	<?php seo_description(); ?>

	<meta name="viewport" content="width=device-width, initial-scale=0.5, maximum-scale=1, user-scalable=no">

	<?php the_favicon(); ?>
	<?php get_css();?>

</head>
<body>

	<?php admin_bar(); ?>

	<div class="layout">
		<?php the_navbar(); ?>
		<?php include $this->view;?>
	</div>

	<?php get_scripts(); ?>

</body>
</html>