<header class="bg">
</header>
	<main>
		<div class="container">
	
		<section class="news" >
				<div class="anchor" id="news"></div>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h2 class="uppercase magic-margin"> News </h2>
						<div class="row">

						<?php get_articles(6,['featured'=>true,'title'=>'h1','excerpt'=>'p','date'=>'p' ], "article-container col-md-12"); ?>

						</div>
					</div>
				</div>
			</section>
		</div>		
	</main>
	<footer>
		<nav class="footer" id="footer">

				<ul class="nav sitename push-left">
					<li> <a href="#"><?php the_sitename(); ?></a></li>
				</ul>
				<ul class="nav mentions push-right">
					<li> All rights reserved. </li>
					<li><?php the_quote(); ?></li>
				</ul>
		</nav>
	</footer>