<div class="container-fluid" >
	<div class="row">
		<div class="col-md-12 bloc article-bloc">
			<div class="inner-bloc">
				<a href="<?php Route::echo('AddUser') ?>" class="btn btn-sm btn-add">Ajouter un utilisateur</a>
				<header>
					<form action="<?php Route::echo('AllUsers') ?>" method="get">
						<?php if(isset($search)): ?>
						<a href="<?php echo Route::echo('AllUsers') ?>"><span class="icon icon-cross"></span></a><span>Recherche : "<?php echo $search ?>"</span> 
						<?php endif ?>
						<input name="s" type="text" class="search-input sm-input hidden-xs" >
						<button type="submit" class="btn btn-sm btn-alt hidden-xs">Rechercher</button>
					</form>
				</header>
				<article>
					<ul class="inline group-action">
						<?php if(!isset($search)):?>
							<li><a href="<?php Route::echo('AllUsers'); ?>" class="<?php echo !isset($filter)?'active':''; ?>"> Tous <?php echo !isset($filter)?'('.$elementNumber.')':''; ?> </a></li>
							<li><a class="<?php echo $filter==1?'active':''; ?>" href="<?php Route::echo('AllUsers'); ?>/filter/1"> Abonnés <?php echo $filter==1?'('.$elementNumber.')':''; ?> </a></li>
							<li><a class="<?php echo $filter==2?'active':''; ?>" href="<?php Route::echo('AllUsers'); ?>/filter/2"> Modérateurs <?php echo $filter==2?'('.$elementNumber.')':''; ?> </a></li>
							<li><a class="<?php echo $filter==3?'active':''; ?>" href="<?php Route::echo('AllUsers'); ?>/filter/3"> CM <?php echo $filter==3?'('.$elementNumber.')':''; ?> </a></li>
							<li><a class="<?php echo $filter==4?'active':''; ?>" href="<?php Route::echo('AllUsers'); ?>/filter/4"> Admin <?php echo $filter==4?'('.$elementNumber.')':''; ?> </a></li>
							<li><a class="<?php echo $filter==5?'active':''; ?>" href="<?php Route::echo('AllUsers'); ?>/filter/5"> Utilisateurs supprimés <?php echo $filter==5?'('.$elementNumber.')':''; ?></a></li>
							<li><a class="<?php echo $filter==6?'active':''; ?>" href="<?php Route::echo('AllUsers'); ?>/filter/5"> Bannis <?php echo $filter==6?'('.$elementNumber.')':''; ?></a></li>
						<?php endif ?>
					</ul>
					<table class="table table-stripped">
						<thead>
							<tr >
								<th><label class="checkbox-container"><input type="checkbox" id="checkAll"><span class="checkmark checkmark-header"></span></label></th>
								<th><a class="<?php echo $sort==1?'active-sort':''; ?>" href="<?php echo Route::makeParams('sort',$sort==1?-1:1,['p']) ?>" > Identifiant <span class="icon <?php echo $sort==-1?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span></a></th>
								<th><a class="<?php echo $sort==2?'active-sort':''; ?>" href="<?php echo Route::makeParams('sort',$sort==2?-2:2,['p']) ?>" > Nom <span class="icon <?php echo $sort==-2?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span> </a></th>
								<th><a class="<?php echo $sort==3?'active-sort':''; ?>" href="<?php echo Route::makeParams('sort',$sort==3?-3:3,['p']) ?>" > E-mail <span class="icon <?php echo $sort==-3?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span> </a></th>
								<th><a class="<?php echo $sort==4?'active-sort':''; ?>" href="<?php echo Route::makeParams('sort',$sort==4?-4:4,['p']) ?>" > Rôle <span class="icon <?php echo $sort==-4?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span> </a></th>
								<?php if(!isset($filter)): ?>
								<th><a class="<?php echo $sort==5?'active-sort':''; ?>" href="<?php echo Route::makeParams('sort',$sort==5?-5:5,['p']) ?>" > Statut <span class="icon <?php echo $sort==-5?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span> </a></th>
								<?php endif; ?>
							</tr>
						</thead>
						<tbody id="body-ajax">
						<?php foreach($users['data'] as $user): ?>
							<tr id="<?php echo $user['id'] ?>" >
								<td class="hidden-xs"><label class="checkbox-container">
									<input type="checkbox">
									<span class="checkmark"></span>
								</label></td>
								<td class="entity-key"><a href="#"><?php echo ucfirst($user['login']); ?></a>
								<ul class="grid-actions">
									<a href="/admin/afficher-utilisateur/id/<?php echo $user['id']; ?>" ><li>Afficher</li></a>
									<a href="/admin/modifier-utilisateur/id/<?php echo $user['id']; ?>"><li>Modifier</li></a>
									<?php if( (Auth::id() != $user['id']) && $user['status'] != 5 ): ?>
									<a onclick="deleteModalUser(<?php echo $user['id'] ?>)"><li>Supprimer</li></a>
									<?php endif; ?>
								</ul>
								</td>
								<td data-label="Nom"><?php echo $user['lastname']." ".$user['firstname']; ?></td>
								<td data-label="E-mail"><a href="#"><?php echo $user['email']; ?></a></td>
								<td data-label="Rôle"><?php echo Format::getRole($user['role']); ?></td>
								<?php if(!isset($filter)): ?>
								<td data-label="Statut"><?php echo Format::getStatusUser($user['status']); ?></td>
								<?php endif ?>
							</tr>
						<?php endforeach; ?>
						<?php if(isset($users['data']) && empty($users['data'])): ?>
							<tr>
								<td> Aucune utilisateur trouv‚ </td>
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
				<?php $this->addModal("pagination",$users['pagination']); ?>
				<ul class="inline hidden-xs">
					<li>Actions group‚es :  </li>
					<li><a href="#" onclick="deleteUsersAction()"> Supprimer</a></li>
					<li><a href="#" onclick="banUsersAction()"> Bannir</a></li>
				</ul>
				<span class="push-right"> <?php echo count($users['pagination']['total']); ?> ‚l‚ment(s) </span>
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