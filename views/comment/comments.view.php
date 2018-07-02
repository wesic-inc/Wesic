<div class="container-fluid" >
	<div class="row">
		<div class="col-md-12 bloc article-bloc">
			<div class="inner-bloc">
				<a href="<?php Route::echo('AddUser') ?>" class="btn btn-sm btn-add">Faire une review des commentaires</a>
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
								<th><label class="checkbox-container">
									<input type="checkbox" id="checkAll">
									<span class="checkmark checkmark-header"></span>
								</label></th>
								<th><a class="<?php echo $params['sort']==1?'active-sort':''; ?>" id="filter1" sort="" onclick="test(this.id)" > Auteur <span class="icon icon-sort-alpha-asc"></span></a></th>
								<th><a class="<?php echo $params['sort']==2?'active-sort':''; ?>" id="filter2" sort="" onclick="test(this.id)" > Commentaire <span class="icon icon-sort-alpha-asc"></span> </a></th>
								<th><a class="<?php echo $params['sort']==3?'active-sort':''; ?>" id="filter3" sort="" onclick="test(this.id)" > Article <span class="icon icon-sort-alpha-asc"></span> </a></th>
								<th><a class="<?php echo $params['sort']==4?'active-sort':''; ?>" id="filter4" sort="" onclick="test(this.id)" > Date <span class="icon icon-sort-alpha-asc"></span> </a></th>
							</tr>
						</thead>
						<tbody id="body-ajax">
							<?php foreach($comments as $comment): ?>
							<tr id="<?php echo $user['id'] ?>" >
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
									<a href="/admin/afficher-commentaire/id/<?php echo $comment['id']; ?>" ><li>Afficher</li></a>
									<a href="/admin/modifier-utilisateur/id/<?php echo $comment['id']; ?>"><li>Modifier</li></a>
									<a onclick="deleteModalUser(<?php echo $user['id'] ?>)"><li>Supprimer</li></a>
									<a onclick="deleteModalUser(<?php echo $user['id'] ?>)"><li>Approuver</li></a>
									<a onclick="deleteModalUser(<?php echo $user['id'] ?>)"><li>Désapprouver</li></a>
								</ul>
							</td>
							<td data-label="Nom"><?php echo $comment['body']; ?></td>
							<td data-label="E-mail"><a target="_blank" href="/<?php echo $comment['slug']; ?>"><?php echo $comment['title']; ?></a></td>
							<td data-label="Rôle"><?php echo $comment['created_at']; ?></td>
						</tr>
						<?php endforeach; ?>
						<?php if(empty($comments)): ?>
						<tr>
							<td> Aucun commentaire trouvé </td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<? endif; ?>
						
					</tbody>
				</table>
				<input type="hidden" id="params">
			</article>
			<footer>
				<?php $this->addModal("pagination"); ?>
				<ul class="inline hidden-xs">
					<li>Actions groupées :  </li>
					<li><a href="#"> Supprimer</a></li>
					<li><a href="#"> Désapprouver</a></li>
					<li><a href="#"> Approuver</a></li>
					<li><a href="#"> Spam</a></li>
				</ul>
				<span class="push-right"> <?php echo count($comments); ?> élément(s) </span>
			</footer>
		</div>
	</div>
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