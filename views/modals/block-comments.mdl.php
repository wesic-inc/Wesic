					<div class="col-md-12 bloc draggable last-comments" id="comments">
						<div class="inner-bloc">
							<?php if(Auth::role() == 4): ?>
							<span class="icon-menu bloc-close handle"> </span>
							<?php endif ?>
							<header>
								<h2 class="bloc-title"><span class="icon-bubbles"></span> Derniers commentaires</h2>
							</header>
							<article>
								<?php foreach($config['data'] as $comment): ?>
								<div class="comment">
									<header>
										<?php if(isset($comment['login'])): ?>
										<b> <?php echo ucfirst($comment['login']) ?></b>
										<?php else: ?>
										<b> <?php echo $comment['email'] ?></b>
										<?php endif ?>
										 sur<a target="_blank" href="<?php echo $comment['slug'] ?>"> "<?php echo $comment['title']; ?>" </a></header>
									<content> <?php echo $comment['body']; ?> </content>
									<footer> <small>Le <?php echo Format::dateDisplay($comment['created_at'],1);?></small></footer>
									<div class="admin-actions">
										<a href="#"> Afficher  </a>
										<a href="#"> Modérer  </a>
										<a href="#"> Supprimer </a>
									</div>
								</div>
								<?php endforeach ?>
								<?php if(empty($config['data'])): ?>
									<div class="comment">
										<span> Aucun commentaire pour le moment. </span>
									</div>
								<?php endif ?>
							</article>
						</div>
					</div>