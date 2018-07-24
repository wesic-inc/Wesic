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
										<?php if($comment['status'] == 2 || $comment['status'] == 3): ?>
										<a href="<?php Route::echo('ApproveComment','/id/'.$comment['id'].'/redirect/admin'); ?>"> Approuver  </a>
										<?php endif ?>
										<?php if($comment['status'] == 1): ?>
										<a href="<?php Route::echo('DisapproveComment','/id/'.$comment['id'].'/redirect/admin'); ?>"> Désapprouver</a>
										<?php endif ?>
										<?php if($comment['status'] != 5): ?>
										<a href="<?php Route::echo('DeleteComment','/id/'.$comment['id'].'/redirect/admin'); ?>"> Supprimer </a>
										<?php endif ?>
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

				<div id="myModal" class="modal">
					<div class="modal-content">
						<div class="modal-header">
							<h3>Confirmation suppression</h3>
						</div>
						<div class="modal-body">
							<p id="modal-body"></p>
							<p id="modal-helper"></p>
						</div>
						<div class="modal-footer">
							<a class="btn btn-primary btn-sm" id="valid-action" onclick="">Confirmer</a>
							<a class="btn btn-sm btn-alt" id="close-modal">Annuler</a>
						</div>
					</div>
					</div>