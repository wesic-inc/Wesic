<div class="container">
	<div class="row">
		<div class="col-md-12">

			<?php article_featured(); ?>
			<?php article_title(); ?>
			<?php article_date(); ?>
			<?php article_content(); ?>
			
			<h3> Les derniers commentaires : </h3>
			<?php the_comments(); ?>
		</div>
	</div>
</div>
