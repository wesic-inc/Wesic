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