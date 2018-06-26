<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc article-bloc"></span>
			<div class="inner-bloc">
				<a href="<?php Route::echo('NewArticle');?>" class="btn btn-sm btn-add">Ajouter un article</a></h1>
				<header>
					<form action="<?php Route::echo('AllArticles') ?>" method="get">
						<input name="s" type="text" class="search-input sm-input hidden-xs" >
						<a href="#" class="btn btn-sm btn-alt hidden-xs">Rechercher</a>
					</form>
				</header>
				<article >
					<ul class="inline group-action">
						<li><a
							href="<?php Route::echo('AllArticles'); ?>"
							class="<?php echo !isset($filter)?'active':''; ?>"> Tous <?php echo !isset($filter)?'('.$elementNumber.')':''; ?> </a></li>
							<li><a class="<?php echo $filter==1?'active':''; ?>"
								href="<?php Route::echo('AllArticles'); ?>/filter/1"> Publiés <?php echo $filter==1?'('.$elementNumber.')':''; ?> </a></li>
								<li><a class="<?php echo $filter==2?'active':''; ?>"
									href="<?php Route::echo('AllArticles'); ?>/filter/2"> Brouillons <?php echo $filter==2?'('.$elementNumber.')':''; ?> </a></li>
									<li>
									</ul>
									<table class="table table-stripped">
										<thead>
											<tr>
												<th class="hidden-xs hidden-sm">
													<label class="checkbox-container"  >
														<input type="checkbox" id="checkAll">
														<span class="checkmark checkmark-header"></span>
													</label>
												</th>
												<th id="filter1" sort="" onclick="test2(this.id)" ><a href="#">Titre</a></th>
												<th id="filter2" sort="" onclick="test2(this.id)" ><a href="#">Statut</a></th>
												<th id="filter3" sort="" onclick="test2(this.id)" ><a href="#">Auteur</a></th>
												<th " >Catégorie</th>
												<th>Tags</th>
												<th id="filter4" sort="" onclick="test2(this.id)" ><a href="#">Date</a></th>
											</tr>
										</thead>
										<tbody id="body-ajax">
											<?php foreach($articles as $article): ?>
												<tr id="<?php echo $article['id'] ?>" >
													<td class="hidden-xs hidden-sm">
														<label class="checkbox-container">
															<input type="checkbox" id="<?php echo $article['id'] ?>">
															<span class="checkmark"></span>
														</label>
													</td>
													<td><a href="#"><?php echo $article['title']?></a>
														<ul class="grid-actions">
															<a href="<?php echo Setting::getParam('url')."/".$article['slug']; ?>"><li>Afficher</li></a>
															<a href="<?php Route::echo('EditArticle','/id/'.$article['id']); ?>"><li>Modifier</li></a>
															<a onclick="deleteModalArticle(<?php echo $article['id'] ?>)"><li>Supprimer</li></a>
														</ul>
													</td>
													<td data-label="Status"><?php echo Format::getStatusArticle($article['status']);?></td>
													<td data-label="Auteur"><a href="#"><?php echo Format::getAuthorName($article['user_id']); ?></a></td>
													<td data-label="Catégorie"><a href="#"><?php echo Format::translateCategory(Category::getCategory($article['id'])); ?></a></td>
													<td data-label="Tags"><a href="#">Article</a>, <a href="#">musique</a>, <a href="#">2018</a></td>
													<td data-label="Date"><?php echo Format::dateDisplay($article['published_at'],4); ?></td>
												</tr>
											<?php endforeach;?>
										</tbody>
									</table>
									<input type="hidden" id="params" value='<?php echo $param_json; ?>'>

								</article>
								<footer>

									<?php $this->addModal("pagination"); ?>

									<ul class="inline">
										<li>Actions groupées :  </li>
										<li><a href="#"> Place dans la corbeille</a></li>
										<li><a href="#">Dépublier</a></li>
									</ul>
									<span class="push-right"> <?php echo count($articles); ?> éléments </span>
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