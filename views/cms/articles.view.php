<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc article-bloc"></span>	
			<a href="<?php Route::echo('NewArticle');?>" class="btn btn-sm btn-add">Ajouter un article</a></h1> 
			<header>
				<input type="text" class="search-input sm-input hidden-xs" >
				<a href="#" class="btn btn-sm btn-alt hidden-xs">Rechercher</a> 
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
							<tr>
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
										<a href="<?php Route::echo('DeleteArticle','/id/'.$article['id']); ?>"><li>Supprimer</li></a>
									</ul>
								</td>
								<td data-label="Status"><?php echo Format::getStatusArticle($article['status']);?></td>
								<td data-label="Auteur"><a href="#"><?php echo Format::getAuthorName($article['user_id']); ?></a></td>
								<td data-label="Catégorie"><a href="#">News</a></td>
								<td data-label="Tags"><a href="#">Article</a>, <a href="#">musique</a>, <a href="#">2018</a></td>
								<td data-label="Date"><?php echo Format::dateDisplay($article['datePublied'],4); ?></td>

							</tr>
						<?php endforeach;?>
						</tbody>
					</table>
				<input type="hidden" id="params" value='<?php echo $param_json; ?>'>
					
				</article>
				<footer>
					
					<?php $this->addModal("pagination", 
					['nbElements'=>$elementNumber,
					'nbPage'=>$nbPage,
					'elementPerPage'=>$elementPerPage,
					'currentPage'=>$currentPage,
					'params'=>$params]); ?>

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