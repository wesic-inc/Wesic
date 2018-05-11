	<div class="container-fluid" >
			<div class="row">
				<div class="col-md-12 bloc article-bloc">
					<a href="ajouter-utilisateur" class="btn btn-sm btn-add">Ajouter un utilisateur</a></h1> 
					<header>
						<input type="text" class="search-input sm-input hidden-xs" >
						<a href="#" class="btn btn-sm btn-alt hidden-xs">Rechercher</a> 
					</header>
					<article>
						<ul class="inline">
							<li><a href="#"> Tous (4) </a></li>
							<li><a href="#"> Abonnés (2) </a></li>
							<li><a href="#"> Modérateurs (3) </a></li>
							<li><a href="#"> Admin (3) </a></li>
							<li><a href="#"> CM (3) </a></li>
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
								<tr ">
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
							</tbody>
						</table>
					</article>
					<footer>
						<ul class="inline hidden-xs">
							<li>Actions groupées :  </li>
							<li><a href="#"> Place dans la corbeille</a></li>
							<li><a href="#">Dépublier</a></li>
						</ul>
						<span class="push-right"> <?php echo $number; ?> élément(s) </span>
					</footer>
				</div>
</div>
			</div>