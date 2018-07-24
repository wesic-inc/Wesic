<div class="container-fluid" >
	<div class="row">
		<div class="col-md-12 bloc article-bloc">
			<div class="inner-bloc">
				<header>
					<form action="<?php Route::echo('Comments') ?>" method="get">
						<input name="s" type="text" class="search-input sm-input hidden-xs" >
						<a href="#" class="btn btn-sm btn-alt hidden-xs">Rechercher</a>
					</form>
				</header>
				<article>
					<ul class="inline group-action">
						<li><a href="<?php Route::echo('Comments'); ?>"
							class="<?php echo !isset($filter)?'active':''; ?>"> Tous <?php echo !isset($filter)?'('.$elementNumber.')':''; ?> </a></li>
							<li><a class="<?php echo $filter==1?'active':''; ?>" href="<?php Route::echo('Comments'); ?>/filter/1"> En attente <?php echo $filter==1?'('.$elementNumber.')':''; ?> </a></li>
							<li><a class="<?php echo $filter==2?'active':''; ?>" href="<?php Route::echo('Comments'); ?>/filter/2"> Approuvé <?php echo $filter==2?'('.$elementNumber.')':''; ?> </a></li>
							<li><a class="<?php echo $filter==3?'active':''; ?>" href="<?php Route::echo('Comments'); ?>/filter/3"> Désaprouvé <?php echo $filter==3?'('.$elementNumber.')':''; ?> </a></li>
							<li><a class="<?php echo $filter==4?'active':''; ?>" href="<?php Route::echo('Comments'); ?>/filter/4"> Signalés <?php echo $filter==4?'('.$elementNumber.')':''; ?> </a></li>
							<li><a class="<?php echo $filter==5?'active':''; ?>" href="<?php Route::echo('Comments'); ?>/filter/5"> Supprimés <?php echo $filter==5?'('.$elementNumber.')':''; ?></a></li>
						</ul>
						<table class="table table-stripped">
							<thead>
								<tr >
									<th>
										<label class="checkbox-container">
											<input type="checkbox" id="checkAll">
											<span class="checkmark checkmark-header"></span>
										</label>
									</th>
									<th><a class="<?php echo $sort==1?'active-sort':''; ?>" id="filter1" href="<?php echo Route::makeParams('sort',$sort==1?-1:1,['p']) ?>" > Auteur <span class="icon <?php echo $sort==-1?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span></a></th>
									<th><a class="<?php echo $sort==2?'active-sort':''; ?>" id="filter2" href="<?php echo Route::makeParams('sort',$sort==2?-2:2,['p']) ?>" > Status <span class="icon <?php echo $sort==-2?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span> </a></th>
									<th><a class="<?php echo $sort==3?'active-sort':''; ?>" id="filter2" href="<?php echo Route::makeParams('sort',$sort==3?-3:3,['p']) ?>" > Commentaire <span class="icon <?php echo $sort==-3?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span> </a></th>
									<th><a class="<?php echo $sort==4?'active-sort':''; ?>" id="filter2" href="<?php echo Route::makeParams('sort',$sort==4?-4:4,['p']) ?>" > Article <span class="icon <?php echo $sort==-4?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span> </a></th>
									<th><a class="<?php echo $sort==5?'active-sort':''; ?>" id="filter2" href="<?php echo Route::makeParams('sort',$sort==5?-5:5,['p']) ?>" > Date <span class="icon <?php echo $sort==-5?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span> </a></th>
								</tr>
							</thead>
							<tbody id="body-ajax">
								<?php foreach($comments['data'] as $comment): ?>
									<tr id="<?php echo $comment['id'] ?>" >
										<td class="hidden-xs"><label class="checkbox-container">
											<input type="checkbox">
											<span class="checkmark"></span>
										</label></td>
										<?php if(isset($comment['login'])): ?>
											<td class="entity-key"><a href="#"><?php echo ucfirst($comment['login']); ?></a>
										<?php else: ?>
											<td class="entity-key"><a href="#"><?php echo $comment['email']; ?></a>
										<?php endif ?>
												<ul class="grid-actions">
														<?php if($comment['status'] != '5'):?>
															<a onclick="deleteModalUser(<?php echo $comment['id'] ?>)"><li>Supprimer</li></a>
														<?php endif ?>
														<?php if($comment['status'] == '2' || $comment['status'] == '3'):?>
															<a href="<?php Route::echo('ApproveComment','/id/'.$comment['id'].'/redirect/1'); ?>"><li>Approuver</li></a>
														<?php endif ?>
														<?php if($comment['status'] != '5' && $comment['status'] != '3'): ?>
															<a href="<?php Route::echo('DisapproveComment','/id/'.$comment['id'].'/redirect/1'); ?>"><li>Désapprouver</li></a>
														<?php endif ?>
													</ul>
												</td>
												<td class="entity-key"><a href="#"><?php echo Format::getStatusComment($comment['status']); ?></a>
													<td data-label="Nom"><?php echo $comment['body']; ?></td>
													<td data-label="E-mail"><a target="_blank" href="/<?php echo $comment['slug']; ?>"><?php echo $comment['title']; ?></a></td>
													<td data-label="Rôle"><?php echo $comment['created_at']; ?></td>
												</tr>
											<?php endforeach; ?>
											<?php if(isset($comments['data']) && empty($comments['data'])): ?>
												<tr>
													<td> Aucun commentaire trouvé </td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>

												</tr>
											<?php endif; ?>

										</tbody>
									</table>
									<input type="hidden" id="params">
								</article>
								<footer>
									<?php $this->addModal("pagination",$comments['pagination']); ?>
									<ul class="inline hidden-xs">
										<li>Actions groupées :  </li>
									<?php if($filter==5): ?>
										<li><a onclick="restoreCommentsAction()" > Restaurer</a></li>
									<?php else: ?>
										<li><a onclick="deleteCommentsAction()" > Supprimer</a></li>
									<?php endif ?>
										<li><a onclick="disapproveCommentsAction()" > Désapprouver</a></li>
										<li><a onclick="approveCommentsAction()" > Approuver</a></li>
									</ul>
									<span class="push-right"> <?php echo $comments['pagination']['total']; ?> élément(s) </span>
								</footer>
							</div>
						</div>
					</div>
				</div>