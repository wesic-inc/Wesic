<?php if( Setting::getParam('links-bloc') == '1'): ?>
				<?php if(Auth::role() == 4): ?>
				<div class="col-md-12 bloc links-bloc draggable handle" id="links-bloc">
				<?php else: ?>
				<div class="col-md-12 bloc links-bloc" id="links-bloc">
				<?php endif ?>
					<div class="inner-bloc">
						<?php if(Auth::role() == 4): ?>
						<span class="icon-cross bloc-close" onclick="dismissLinks()"></span>
						<?php endif ?>
						<header>
							<h2 class="bloc-title">
								<span class="icon-link"></span> Liens rapides </h2>
							</header>
							<article class="links-article">
								<div class="row">
									<div class="col-md-12 theme-links">
										<header>Apparence</header>
										<content>
											<ul>
												<li>Pas de temps à perdre ? </li>
												<li>Vous êtes un créatif ?</li>
												<li>Vous êtes développeur ?</li>
											</ul>
											<ul>
												<li><a href="<?php Route::echo('Themes'); ?>"> Voir nos templates Ready To Go</a></li>
												<li><a href="<?php Route::echo('ThemeCreator'); ?>"> Testez notre Theme Creator</a></li>
												<li><a href="https://doc.wesic.me/"> Découvrez notre documentation</a></li>
											</content>
										</div>
										<div class="col-md-12 pub-links">
											<header>Publication</header>
											<content>
												<ul>
													<li><a href="<?php Route::echo('NewArticle'); ?>"> Créer votre premier article</a></li>
													<li><a href="<?php Route::echo('NewPage'); ?>"> Ajouter une page A propos</a></li>
													<li><a href="<?php Route::echo('NewEvent'); ?>"> Créer un évènement</a></li>
												</ul>
												<ul>
													<li><a href="#"> Ajouter des photos</a></li>
													<li><a href="#"> Ajouter une page A propos</a></li>
													<li><a href="#"> Créer un évènement</a></li>
												</ul>
											</content>
										</div>
									</div>
								</article>
							</div>
						</div>
<?php endif ?>