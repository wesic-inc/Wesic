						<div class="col-lg-12 bloc draggable activity" id="activity">
							<div class="inner-bloc">
								<span class="icon-menu bloc-close handle"> </span>
								<header>
									<h2 class="bloc-title"><span class="icon-earth"></span> Activité</h2>
								</header>
								<article>
									<header>Publiés récemment</header>
									<ul>
										<?php foreach($config['data'] as $lastPost): ?>
											<li><small><?php echo $lastPost['type']=='1'?'Publié':'Nouvelle page' ?> le <?php echo Format::dateDisplay($lastPost['published_at'],1);?> : </small> <a target="_blank" href="/<?php echo $lastPost['slug'] ?>"> “<?php echo $lastPost['title']; ?>”</a> par <?php echo ucfirst($lastPost['login']); ?> </li>
										<?php endforeach ?>
									</ul>
								</article>
							</div>
						</div>