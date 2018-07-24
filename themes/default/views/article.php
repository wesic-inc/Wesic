<div class="container">
	<div class="row">
		<div class="col-md-12">

			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<?php article_tags(); ?>
			<br>
			<br>
			<?php article_category(); ?>
			<br>
			<br>
			<img width="200px" src="<?php article_featured_raw(); ?>">
			<?php article_title(); ?>
			<?php article_date(); ?>
			<?php article_content(); ?>
			
			<h3> Les derniers commentaires : </h3>
			<?php the_comments(); ?>
		</div>
	</div>
</div>
