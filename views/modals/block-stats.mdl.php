					<div class="col-lg-12 bloc draggable gutter-bloc stats" id="stats">
						<div class="inner-bloc">
							<?php if(Auth::role() == 4): ?>
							<span class="icon-menu bloc-close handle"> </span>
							<?php endif ?>
							<header>
								<h2 class="bloc-title"><span class="icon-stats-dots"></span> Statistiques</h2>
							</header>
							<article>
								<ul class="numbers">
									<li><span><?php echo Stat::uniqLastMonth() ?></span><p> utilisateurs unique les 30 derniers jours</p></li>
									<li><span><?php echo Stat::commentToday() ?></span><p> nouveaux commentaires aujourd’hui</p></li>
									<li><span><?php echo Stat::uniqOverall() ?></span><p> visites depuis la mise en ligne</p></li>
								</ul>
								<canvas id="myChart" height="200"></canvas>
							</article>
						</div>
					</div>