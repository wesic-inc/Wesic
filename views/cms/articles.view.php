<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc article-bloc"></span>
			<div class="inner-bloc">
				<a href="<?php Route::echo('NewArticle');?>" class="btn btn-sm btn-add">Ajouter un article</a></h1>
				<header>
					<form action="<?php Route::echo('AllArticles') ?>" method="get">
						<input name="s" type="text" class="search-input sm-input hidden-xs" >
						<button type="submit" class="btn btn-sm btn-alt hidden-xs">Rechercher</button>
					</form>
				</header>
				<article >
					<ul class="inline group-action">
						<li><a href="<?php Route::echo('AllArticles'); ?>" class="<?php echo !isset($filter)?'active':''; ?>"> Tous <?php echo !isset($filter)?'('.$elementNumber.')':''; ?> </a></li>
						<li><a class="<?php echo $filter==1?'active':''; ?>" href="<?php Route::echo('AllArticles'); ?>/filter/1"> Publiés <?php echo $filter==1?'('.$elementNumber.')':''; ?> </a></li>
						<li><a class="<?php echo $filter==2?'active':''; ?>" href="<?php Route::echo('AllArticles'); ?>/filter/2"> Brouillons <?php echo $filter==2?'('.$elementNumber.')':''; ?> </a></li>
						<li><a class="<?php echo $filter==3?'active':''; ?>" href="<?php Route::echo('AllArticles'); ?>/filter/3"> Corbeille <?php echo $filter==3?'('.$elementNumber.')':''; ?> </a></li>
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
								<th><a class="<?php echo $sort==1?'active-sort':''; ?>" id="filter1" href="<?php echo Route::makeParams('sort',$sort==1?-1:1,['p']) ?>" > Titre <span class="icon <?php echo $sort==-1?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span></a></th>
								<th><a class="<?php echo $sort==2?'active-sort':''; ?>" id="filter2" href="<?php echo Route::makeParams('sort',$sort==2?-2:2,['p']) ?>" > Statut <span class="icon <?php echo $sort==-2?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span> </a></th>
								<th><a class="<?php echo $sort==3?'active-sort':''; ?>" id="filter3" href="<?php echo Route::makeParams('sort',$sort==3?-3:3,['p']) ?>" > Auteur <span class="icon <?php echo $sort==-3?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span> </a></th>
								<th>Catégorie</th>
								<th>Tags</th>
								<th><a class="<?php echo $sort==4?'active-sort':''; ?>" id="filter4" href="<?php echo Route::makeParams('sort',$sort==4?-4:4,['p']) ?>" > Date <span class="icon <?php echo $sort==-4?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span> </a></th>
							</tr>
						</thead>
						<tbody id="body-ajax">
							<?php foreach($articles['data'] as $article): ?>
								<tr id="<?php echo $article['id'] ?>" >
									<td class="hidden-xs hidden-sm">
										<label class="checkbox-container">
											<input type="checkbox" id="<?php echo $article['id'] ?>">
											<span class="checkmark"></span>
										</label>
									</td>
									<td><a href="<?php echo Setting::getParam('url')."/".$article['slug']; ?>"><?php echo $article['title']?></a>
										<ul class="grid-actions">
											<a href="<?php echo Setting::getParam('url')."/".$article['slug']; ?>"><li>Afficher</li></a>
											<?php if(User::isAllow($article['user_id'])): ?>
												<a href="<?php Route::echo('EditArticle','/id/'.$article['id']); ?>"><li>Modifier</li></a>
												<a onclick="deleteModalArticle(<?php echo $article['id'] ?>)"><li>Supprimer</li></a>
											<?php endif ?>
										</ul>
									</td>
									<td data-label="Status"><?php echo Format::getStatusArticle($article['status']);?></td>
									<td data-label="Auteur"><a href="#"><?php echo ucfirst($article['author']); ?></a></td>
									<?php $cat = Category::getCategory($article['id']); ?>
									<td data-label="Catégorie"><a href="/<?php echo $cat['slug'] ?>"><?php echo $cat['label']; ?></a></td>
									<td data-label="Tags">
										<?php foreach( Category::getTags($article['id']) as $keyTag => $tag): ?>
											<?php if($keyTag != 0): ?>
											,
											<?php endif ?>
											<span><?php echo $tag ?></span>
										<?php endforeach ?>
									</td>
									<td data-label="Date"><?php echo Format::dateDisplay($article['published_at'],4); ?></td>
								</tr>
							<?php endforeach;?>
							<?php if( isset($articles['data']) && empty($articles['data']) ): ?>
								<tr>
									<td> Aucun article trouvé </td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
					<input type="hidden" id="params" value='<?php echo $param_json; ?>'>

				</article>
				<footer>

					<?php $this->addModal("pagination",$articles['pagination']); ?>

					<ul class="inline">
						<li>Actions groupées :  </li>
						<li><a href="#" onclick="deletePostAction()"> Place dans la corbeille</a></li>
						<li><a href="#" onclick="unPublishPostAction()">Dépublier</a></li>
					</ul>
					<span class="push-right"> <?php echo $articles['pagination']['total']; ?> éléments </span>
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