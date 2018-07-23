<header class="bg">
</header>
	<main>
		<div class="container">
		<section class="Medias" >
				<div class="anchor" id="medias"></div>
				<div class="row">
					<div class="col-md-12">
						<br>
						<br>
						<br>
						<div class="row">
							<div class="col-md-12">
								<h3 class="text-left">Pictures</h3>
								<div class="row magic-margin">
									<?php get_medias(1, 3, true, false, 10, "col-md-12 no-gutter media-container"); ?>
								</div>
							<div class="text-right wd100"> <h5 ><a href="#"> More Pictures </a></h5> </div>
							</div>
						</div>
						<br>
						<br>
						<br>
						<div class="row">
							<div class="col-md-12">
								<h3 class="text-left">Videos</h3>
								<div class="row magic-margin">
								<?php get_medias(3, 3, true, false, 10, "col-md-12 no-gutter media-container"); ?>
								</div>
							<div class="text-right wd100"> <h5 ><a href="#"> More Videos </a></h5> </div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<div class="separator"></div>

			
			<div class=	"separator"></div>

			<section class="about-us">
				<div class="anchor" id="aboutus"></div>
				<div class="row">
					<div class="col-md-12">
						<header>
							<h2 class="uppercase"> About uszzz </h2>
							<p class="subtext"> What are we made of </p>
						</header>
						<div class="row">
							<div class="col-md-6 text-right border-timeline ">
								<div class="timeline-item magic-margin">
								<span class="icon-minus timeline-bullet-right"></span>
								<h4 class="uppercase "> Lorem ipsum <small>01/01/2018</small></h4>
								<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
									cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
								</div>
								<div class="timeline-item magic-margin">
								<span class="icon-minus timeline-bullet-right"></span>
								<h4 class="uppercase"> Lorem ipsum <small>01/01/2018</small></h4>
								<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
									cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
								</div>
							</div>
							<div class="col-md-6 text-left">
								<div class="timeline-item magic-margin">
								<img class="img-responsive img-timeline-right" src="/public/img/used/img2.jpg">
							</div>
							</div>
							<div class="col-md-6 text-right border-timeline">
								<div class="timeline-item magic-margin">
								<img class="img-responsive img-timeline" src="/public/img/used/img3.jpg">
								</div>
							</div>
							<div class="col-md-6 text-left ">
								<div class="timeline-item magic-margin">
								<span class="icon-minus timeline-bullet-left"></span>
								<h4 class="uppercase "> Lorem ipsum <small>01/01/2018</small></h4>
								<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
									cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
									proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
									cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
							</div>
						</div>
							<div class="col-md-6 text-right border-timeline">
								<div class="timeline-item magic-margin">
								<span class="icon-minus timeline-bullet-right"></span>
								<h4 class="uppercase "> Lorem ipsum <small>01/01/2018</small></h4>
								<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat.</p>
							</div>
							</div>
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