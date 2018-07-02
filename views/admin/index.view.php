<div class="container-fluid" >
	<div class="row">
		<div class="col-md-6" id="left">
			<?php if( Setting::getParam('welcome-bloc') == '1'): ?>
				<div class="col-md-12 bloc welcome-bloc" id="welcome-bloc">
					<div class="inner-bloc">
						<span class="icon-cross bloc-close" onclick="dismissWelcome()"></span>
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
			<?php endif; ?>
			<?php if( Setting::getParam('links-bloc') == '1'): ?>
				<div class="col-md-12 bloc links-bloc" id="links-bloc">
					<div class="inner-bloc">
						<span class="icon-cross bloc-close" onclick="dismissLinks()">
						</span>
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
					<?php endif; ?>
					<div class="col-lg-12 bloc gutter-bloc stats">
						<div class="inner-bloc">

							<span class="icon-menu bloc-close handle"> </span>
							<header>
								<h2 class="bloc-title"><span class="icon-stats-dots"></span> Statistiques</h2>
							</header>
							<article>
								<ul class="numbers">
									<li><span>4400</span><p> utilisateurs unique les 30 derniers jours</p></li>
									<li><span>15</span><p> nouveaux commentaires aujourd’hui</p></li>
									<li><span>+50%</span><p> de traffic sur les 30 derniers jours</p></li>
								</ul>
								<canvas id="myChart" height="200"></canvas>

								<ul class="btns">
									<li><a href="#" class="btn btn-sm btn-alt-inverted"> 1 an </a></li>
									<li><a href="#" class="btn btn-sm btn-alt-inverted"> 6 mois </a></li>
									<li><a href="#" class="btn btn-sm btn-alt-inverted"> 3 mois </a></li>
									<li><a href="#" class="btn btn-sm btn-alt-inverted"> 30 jours </a></li>
									<li><a href="#" class="btn btn-sm btn-alt-inverted"> Aujourd'hui </a></li>
								</ul>
							</article>
						</div>
					</div>
				</div>
				<div class="col-md-6" id="right">
					<div class="col-lg-12 bloc quick-view">
						<div class="inner-bloc">

							<span class="icon-menu bloc-close handle">
							</span>
							<header>
								<h2 class="bloc-title"><span class="icon-eye"></span> Coup d’oeil</h2>
							</header>
							<article>
								<div class="row">
									<div class="col-sm-6">
										<ul>
											<li><span class="icon-newspaper stat-number"></span> <?php echo $articles; ?> articles</li>
											<li><span class="icon-file-empty stat-number"></span> <?php echo $pages; ?>  pages</li>
										</ul>
									</div>
									<div class="col-sm-6">
										<ul>
											<li><span class="icon-bubbles stat-number"></span> <?php echo $comments; ?> commentaires</li>
											<li><span class="icon-sphere stat-number"></span> <?php echo $events; ?> événements</li>
										</ul>
									</div>
								</div>
								<p> Wesic est en version <?php echo WESIC_VERSION; ?> avec le thème <span> Minimalism </span> </p>
								<a class="btn btn-sm btn-danger update-wesic"> Mettre à jour </a>
							</article>
						</div>
					</div>
						<div class="col-lg-12 bloc activity">
							<div class="inner-bloc">
							<span class="icon-menu bloc-close handle"> </span>
							<header>
								<h2 class="bloc-title"><span class="icon-earth"></span> Activité</h2>
							</header>
							<article>
								<header>Publiés récemment</header>
								<ul>
									<?php foreach($lastPosts as $lastPost): ?>
									<li><small><?php echo $lastPost['type']=='1'?'Publié':'Nouvelle page' ?> le <?php echo Format::dateDisplay($lastPost['published_at'],1);?> : </small> <a target="_blank" href="/<?php echo $lastPost['slug'] ?>"> “<?php echo $lastPost['title']; ?>”</a> par <?php echo ucfirst($lastPost['login']); ?> </li>
									<?php endforeach ?>
								</ul>
							</article>
						</div>
					</div>
					<div class="col-md-12 bloc last-comments">
						<div class="inner-bloc">
							
							<span class="icon-menu bloc-close handle"> </span>
							<header>
								<h2 class="bloc-title"><span class="icon-bubbles"></span> Derniers commentaires</h2>
							</header>
							<article>
								<?php foreach($lastComments as $comment): ?>
								<div class="comment">
									<header>
										<?php if(isset($comment['login'])): ?>
										<b> <?php echo ucfirst($comment['login']) ?></b>
										<?php else: ?>
										<b> <?php echo $comment['email'] ?></b>
										<?php endif ?>
										 sur<a href="#"> "<?php echo $comment['title']; ?>" </a></header>
									<content> <?php echo $comment['body']; ?> </content>
									<footer> <small>Le <?php echo Format::dateDisplay($comment['created_at'],1);?></small></footer>
									<div class="admin-actions">
										<a href="#"> Afficher  </a>
										<a href="#"> Modérer  </a>
										<a href="#"> Supprimer </a>
									</div>
								</div>
								<?php endforeach ?>
							</article>
						</div>
					</div>
				</div>
			</div>
			<script>
				var ctx = document.getElementById("myChart").getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
						datasets: [{
							label: '# of Votes',
							data: [12, 19, 3, 5, 2, 3],
							backgroundColor: [
							'rgba(255, 99, 132, 0.2)',
							'rgba(54, 162, 235, 0.2)',
							'rgba(255, 206, 86, 0.2)',
							'rgba(75, 192, 192, 0.2)',
							'rgba(153, 102, 255, 0.2)',
							'rgba(255, 159, 64, 0.2)'
							],
							borderColor: [
							'rgba(255,99,132,1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							'rgba(75, 192, 192, 1)',
							'rgba(153, 102, 255, 1)',
							'rgba(255, 159, 64, 1)'
							],
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true
								}
							}]
						}
					}
				});
			</script>