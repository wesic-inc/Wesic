<div class="container">
	<div class="row">
		<div class="col-md-12">
			<img src="<?php echo $article['path']; ?>">
			<h3><?php echo $article['title']; ?></h3>
			<p><?php echo $article['content']; ?></p>
			<p>Posté <?php echo Format::humanTime($article['date']); ?></p>
			<?php $this->addModal("comments", ['comments'=>$data,'form'=>$form,'errors'=>$errors]); ?>
		</div>
	</div>
</div>
