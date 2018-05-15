	<div class="container-fluid" >
			<div class="row">
				<div class="col-md-12 bloc article-bloc">
					<a href="<?php echo ROOT_URL; ?>admin/ajouter-utilisateur" class="btn btn-sm btn-add">Ajouter un utilisateur</a></h1> 
					<header>
						<input type="text" class="search-input sm-input hidden-xs" >
						<a href="#" class="btn btn-sm btn-alt hidden-xs">Rechercher</a> 
					</header>
					<article>
						<ul class="inline group-action">
							<li><a href="<?php Route::echo('AllUsers'); ?>" 
								class="<?php echo !isset($filter)?'active':''; ?>"> Tous (<?php echo $elementNumber; ?>) </a></li>
							<li><a class="<?php echo $filter==1?'active':''; ?>" href="<?php Route::echo('AllUsers'); ?>/filter/1"> Abonnés (2) </a></li>
							<li><a class="<?php echo $filter==2?'active':''; ?>" href="<?php Route::echo('AllUsers'); ?>/filter/2"> Modérateurs (3) </a></li>
							<li><a class="<?php echo $filter==3?'active':''; ?>" href="<?php Route::echo('AllUsers'); ?>/filter/3"> CM (3) </a></li>
							<li><a class="<?php echo $filter==4?'active':''; ?>" href="<?php Route::echo('AllUsers'); ?>/filter/4"> Admin (3) </a></li>
							<li><a class="<?php echo $filter==5?'active':''; ?>" href="<?php Route::echo('AllUsers'); ?>/filter/5"> Utilisateurs supprimés </a></li>
						</ul>
						<table class="table table-stripped">
							<thead>
								<tr>
									<th><label class="checkbox-container">
								<input type="checkbox">
								<span class="checkmark checkmark-header"></span>
							</label></th>
									<th>Identifiant</th>
									<th>Nom</th>
									<th>E-mail</th>
									<th>Rôle</th>
									<th>Posts</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<td><label class="checkbox-container">
								<input type="checkbox">
								<span class="checkmark checkmark-footer"></span>
							</label></td>
									<td>Identifiant</td>
									<td>Nom</td>
									<td>E-mail</td>
									<td>Rôle</td>
									<td>Posts</td>
								</tr>
							</tfoot>
							<tbody>

								<?php foreach($users as $user): ?>
								<tr">
									<td class="hidden-xs"><label class="checkbox-container">
								<input type="checkbox">
								<span class="checkmark"></span>
							</label></td>
									<td class="entity-key"><a href="#post=id"><?php echo ucfirst($user['login']); ?></a>
										<ul class="grid-actions">
											<a href="/admin/afficher-utilisateur/<?php echo $user['id']; ?>"><li>Afficher</li></a>
											<a href="/admin/modifier-utilisateur/<?php echo $user['id']; ?>"><li>Modifier</li></a>
											<a href="#"><li>Supprimer</li></a>
										</ul>
									</td>
									<td data-label="Nom"><?php echo $user['lastname']." ".$user['firstname']; ?></td>
									<td data-label="E-mail"><a href="#"><?php echo $user['email']; ?></a></td>
									<td data-label="Rôle"><?php echo Format::getRole($user['role']); ?></td>
									<td data-label="Posts">0</td>

								</tr>
							<?php endforeach; ?>
							<?php if(empty($users)): ?>
									<tr>
										<td> Aucune utilisateurs trouvés </td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
							<? endif; ?>
							</tbody>
						</table>
					</article>
					<footer>
<!-- 						<nav>
							<ul class="pagination">
								<li class="page-item disabled"><a href="#" tabindex="-1">Précédent</a></li>
								<li class="page-item active"><a href="/admin/utilisateurs/1">1</a></li>
								<li class="page-item"><a href="/admin/utilisateurs/2">2</a></li>
								<li class="page-item"><a href="/admin/utilisateurs/3">3</a></li>
								<li class="page-item"><a href="#">Suivant</a>
								</li>
							</ul>
						</nav> -->
						<?php $this->addModal("pagination", ['nbElements'=>$elementNumber,'nbPage'=>$nbPage,'elementPerPage'=>$elementPerPage,'currentPage'=>$currentPage,'targetUri'=>$targetUri]); ?>

						<ul class="inline hidden-xs">
							<li>Actions groupées :  </li>
							<li><a href="#"> Supprimer</a></li>
						</ul>
						<span class="push-right"> <?php echo $elementNumber; ?> élément(s) </span>
					</footer>
				</div>
</div>
			</div>