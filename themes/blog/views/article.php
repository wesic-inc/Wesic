<div class="container">
	<div class="row">
		<div class="col-md-12 article-solo">
			<?php article_featured(); ?>
			<h1><?php article_title(); ?></h1>
			
			<?php article_content(); ?>
			<p class="date"><?php article_date(); ?></p>
			<div class="separator"></div>
			<h3 class="last-comment"> Les derniers commentaires : </h3>
			<div id="comments"><?php the_comments(); ?></div>
		</div>
	</div>
</div>
