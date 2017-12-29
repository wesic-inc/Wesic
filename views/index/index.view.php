<?php require('views/templates/navbar.tpl.php'); ?>
<?php echo "Bonjour ".$pseudo." !"; ?>

<?php foreach ($articles as $article) :?>
	<h1><a href="<?php echo $article['slug'] ?>"> <?php echo $article['title'] ?> </a></h1>
	<p> <?php echo $article['content'] ?></p>
<?php endforeach; ?>