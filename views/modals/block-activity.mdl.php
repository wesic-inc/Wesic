						<div class="col-lg-12 bloc draggable activity" id="activity">
							<div class="inner-bloc">
								<?php if(Auth::role() == 4): ?>
								<span class="icon-menu bloc-close handle"> </span>
								<?php endif; ?>
								<header>
									<h2 class="bloc-title"><span class="icon-earth"></span> Activité</h2>
								</header>
								<article>
									<?php if(!empty($config['data'])): ?>
									<header>Publiés récemment</header>
									<?php else: ?>
									<header>Aucune activité pour le moment</header>
									<?php endif ?>
									<ul>
										<?php foreach($config['data'] as $lastPost): ?>
											<li><small><?php echo $lastPost['type']=='1'?'Publié':'Nouvelle page' ?> le <?php echo Format::dateDisplay($lastPost['published_at'],1);?> : </small> <a target="_blank" href="/<?php echo $lastPost['slug'] ?>"> “<?php echo $lastPost['title']; ?>”</a> par <?php echo ucfirst($lastPost['login']); ?> </li>
										<?php endforeach ?>
									</ul>
								</article>
							</div>
						</div>