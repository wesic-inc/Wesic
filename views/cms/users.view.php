<?php require('views/templates/navbar-admin.tpl.php'); ?>
<h1 class="page-title"><span class="icon-users">

		</span>	 Utilisateurs <a href="addarticle.html" class="btn btn-sm btn-add"> Ajouter </a></h1> 
		<div class="container">
			<div class="row">
				<div class="col-md-12 bloc ignore-me article-bloc">
					<header>
						<input type="text" class="search-input" ><a href="#" class="btn btn-sm ">Rechercher</a> 
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
									<th><input type="checkbox" name="" id="test1"><label for="test1"></label></th>
									<th>Identifiant</th>
									<th class="hidden-sm hidden-xs">Nom</th>
									<th class="hidden-sm hidden-xs">E-mail</th>
									<th class="hidden-sm hidden-xs">Rôle</th>
									<th class="hidden-sm hidden-xs">Posts</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<td><input type="checkbox" name="" id="test2"><label for="test2"></label></td>
									<td>Identifiant</td>
									<td class="hidden-sm hidden-xs">Nom</td>
									<td class="hidden-sm hidden-xs">E-mail</td>
									<td class="hidden-sm hidden-xs">Rôle</td>
									<td class="hidden-sm hidden-xs">Posts</td>
								</tr>
							</tfoot>
							<tbody>

								<?php foreach($users as $user): ?>
								<tr>
									<td><input type="checkbox" name="" id="test3"><label for="test3"></label></td>
									<td><a href="#post=id"><?php echo $user['login']; ?></a>
										<ul class="grid-actions">
											<a href="#"><li>Afficher</li></a>
											<a href="#"><li>Modifier</li></a>
											<a href="#"><li>Supprimer</li></a>
										</ul>
									</td>
									<td class="hidden-sm hidden-xs"><?php echo $user['name']; ?></td>
									<td class="hidden-sm hidden-xs"><a href="#"><?php echo $user['email']; ?></a></td>
									<td class="hidden-sm hidden-xs"><?php echo Format::getRole($user['role']); ?></td>
									<td class="hidden-sm hidden-xs">0</td>

								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</article>
					<footer>
						<ul class="inline">
							<li>Actions groupées :  </li>
							<li><a href="#"> Place dans la corbeille</a></li>
							<li><a href="#">Dépublier</a></li>
						</ul>
						<span class="push-right"> 4 éléments </span>
					</footer>
				</div>

			</div>
		</div>