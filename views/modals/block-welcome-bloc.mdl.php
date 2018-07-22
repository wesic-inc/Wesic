<?php if( Setting::getParam('welcome-bloc') == '1'): ?>
				<?php if(Auth::role() == 4): ?>
				<div class="col-md-12 bloc welcome-bloc draggable handle" id="welcome-bloc">
				<?php else: ?>
				<div class="col-md-12 bloc welcome-bloc" id="welcome-bloc">
				<?php endif ?>
					<div class="inner-bloc">
						<?php if(Auth::role() == 4): ?>
						<span class="icon-cross bloc-close" onclick="dismissWelcome()"></span>
						<?php endif ?>
						<header>
							<h2 class="bloc-title"> Bienvenue sur Wesic ! </h2>
							<span class="bloc-subtitle"> Nous vous avons préparé de quoi partir du bon pied </span>
						</header>
						<article class="welcome-article">
							<div class="row">
								<div class="col-md-6">
									<p> Nous sommes là pour vous aidez à promouvoir votre musique ! Wesic n’est pas un CMS classique. Il a été conçu par des musiciens pour des musiciens. Il répond aux besoins actuels d’un groupe ou d’un artiste en terme de site web. Amusez vous bien ! <i> - L’équipe de Wesic Inc.</i></p> 
								</div>
								<div class="col-md-6 text-center welcome-start">
									<a href="#" class="btn btn-lg welcome-btn"> Démarage rapide </a>
									<p class="subtext"> Vous découvrez notre outil pour la première fois ? Suivez le guide ! </p>
								</div>
							</div>
						</article>
					</div>
				</div>
<?php endif ?>