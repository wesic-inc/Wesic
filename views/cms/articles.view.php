<?php require('views/templates/navbar-admin.tpl.php'); ?>
<h1 class="page-title"><span class="icon-newspaper">

		</span>	 Articles <a href="addarticle.html" class="btn btn-sm btn-add"> Ajouter </a></h1> 
		<div class="container">
			<div class="row">
				<div class="col-md-12 bloc ignore-me article-bloc">
					<header>
						<input type="text" class="search-input" ><a href="#" class="btn btn-sm ">Rechercher</a> 
					</header>
					<article>
						<ul class="inline">
							<li><a href="#"> Tous (4) </a></li>
							<li><a href="#"> Publiés (2) </a></li>
							<li><a href="#"> Brouillons (3) </a></li>
						</ul>
						<table class="table table-stripped">
							<thead>
								<tr>
									<th><input type="checkbox" name="" id="test1"><label for="test1"></label></th>
									<th>Titre</th>
									<th class="hidden-sm hidden-xs">Statut</th>
									<th class="hidden-sm hidden-xs">Auteur</th>
									<th class="hidden-sm hidden-xs">Catégorie</th>
									<th class="hidden-sm hidden-xs">Tags</th>
									<th class="hidden-sm hidden-xs">Date</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<td><input type="checkbox" name="" id="test2"><label for="test2"></label></td>
									<td>Titre</td>
									<td class="hidden-sm hidden-xs">Statut</td>
									<td class="hidden-sm hidden-xs">Auteur</td>
									<td class="hidden-sm hidden-xs">Catégorie</td>
									<td class="hidden-sm hidden-xs">Tags</td>
									<td class="hidden-sm hidden-xs">Date</td>
								</tr>
							</tfoot>
							<tbody>
								<tr>
									<td><input type="checkbox" name="" id="test3"><label for="test3"></label></td>
									<td><a href="#post=id">Lorem ipsum</a>
										<ul class="grid-actions">
											<a href="#"><li>Afficher</li></a>
											<a href="#"><li>Modifier</li></a>
											<a href="#"><li>Supprimer</li></a>
										</ul>
									</td>
									<td class="hidden-sm hidden-xs">Brouillon</td>
									<td class="hidden-sm hidden-xs"><a href="#">Admin</a></td>
									<td class="hidden-sm hidden-xs"><a href="#">News</a></td>
									<td class="hidden-sm hidden-xs"><a href="#">Article</a>, <a href="#">musique</a>, <a href="#">2018</a></td>
									<td class="hidden-sm hidden-xs">01/01/2018</td>

								</tr>
								<tr>
									<td><input type="checkbox" name="" id="test4"><label for="test4"></label></td>
									<td><a href="#post=id">Concert 2018</a>
										<ul class=" grid-actions">
											<a href="#"><li>Afficher</li></a>
											<a href="#"><li>Modifier</li></a>
											<a href="#"><li>Supprimer</li></a>
										</ul>
									</td>
									<td class="hidden-sm hidden-xs">Publié</td>
									<td class="hidden-sm hidden-xs"><a href="#">Admin</a></td>
									<td class="hidden-sm hidden-xs"><a href="#">Concert</a></td>
									<td class="hidden-sm hidden-xs"><a href="#">Concert</a></td>
									<td class="hidden-sm hidden-xs">31/12/2017</td>
								</tr>
								<tr>
									<td><input type="checkbox" name="" id="test5"><label for="test5"></label></td>
									<td><a href="#post=id">Concert 2018</a>
										<ul class="grid-actions">
											<a href="#"><li>Afficher</li></a>
											<a href="#"><li>Modifier</li></a>
											<a href="#"><li>Supprimer</li></a>
										</ul>
									</td>
									<td class="hidden-sm hidden-xs">Publié</td>
									<td class="hidden-sm hidden-xs"><a href="#">Admin</a></td>
									<td class="hidden-sm hidden-xs"><a href="#">Concert</a></td>
									<td class="hidden-sm hidden-xs"><a href="#">Concert</a></td>
									<td class="hidden-sm hidden-xs">31/12/2017</td>
								</tr>
								<tr>
									<td><input type="checkbox" name="" id="test6"><label for="test6"></label></td>
									<td><a href="#post=id">Concert 2018</a>
										<ul class="grid-actions"  >
											<a href="#"><li>Afficher</li></a>
											<a href="#"><li>Modifier</li></a>
											<a href="#"><li>Supprimer</li></a>
										</ul>
									</td>
									<td class="hidden-sm hidden-xs">Publié</td>
									<td class="hidden-sm hidden-xs"><a href="#">Admin</a></td>
									<td class="hidden-sm hidden-xs"><a href="#">Concert</a></td>
									<td class="hidden-sm hidden-xs"><a href="#">Concert</a></td>
									<td class="hidden-sm hidden-xs">31/12/2017</td>
								</tr>
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