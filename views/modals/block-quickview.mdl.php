					<div class="col-lg-12 bloc draggable quick-view" id="quickview">
						<div class="inner-bloc">
							<?php if(Auth::role() == 4): ?>
							<span class="icon-menu bloc-close handle">
							<?php endif ?>
							</span>
							<header>
								<h2 class="bloc-title"><span class="icon-eye"></span> Coup d’oeil</h2>
							</header>
							<article>
								<div class="row">
									<div class="col-sm-6">
										<ul>
											<li><span class="icon-newspaper stat-number"></span> <?php echo $config['data'][0]; ?> articles</li>
											<li><span class="icon-file-empty stat-number"></span> <?php echo $config['data'][1]; ?>  pages</li>
										</ul>
									</div>
									<div class="col-sm-6">
										<ul>
											<li><span class="icon-bubbles stat-number"></span> <?php echo $config['data'][2] ?> commentaires</li>
											<li><span class="icon-sphere stat-number"></span> <?php echo $config['data'][3]; ?> événements</li>
										</ul>
									</div>
								</div>
								<p> Wesic est en version <?php echo WESIC_VERSION; ?> avec le thème <span> Minimalism </span> </p>
								<?php if(Auth::role() == 4): ?>
								<a class="btn btn-sm btn-danger update-wesic"> Mettre à jour </a>
								<?php endif ?>
							</article>
						</div>
					</div>