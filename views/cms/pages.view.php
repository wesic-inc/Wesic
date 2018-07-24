<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc article-bloc"></span>
			<div class="inner-bloc">
				
				<a href="<?php Route::echo('NewPage'); ?>" class="btn btn-sm btn-add">Ajouter une page</a></h1> 
				<header>
					<form action="<?php Route::echo('Pages') ?>" method="get">
						<input name="s" type="text" class="search-input sm-input hidden-xs" >
						<button type="submit" class="btn btn-sm btn-alt hidden-xs">Rechercher</button>
					</form>
				</header>
				<article >
					<ul class="inline group-action">
						<li><a href="<?php Route::echo('Pages'); ?>" 
							class="<?php echo !isset($filter)?'active':''; ?>"> Tous <?php echo !isset($filter)?'('.$elementNumber.')':''; ?> </a></li>
							<li><a class="<?php echo $filter==1?'active':''; ?>" href="<?php Route::echo('Pages'); ?>/filter/1"> Publié <?php echo $filter==1?'('.$elementNumber.')':''; ?> </a></li>
							<li>
							</ul>
							<table class="table table-stripped">
								<thead>
									<tr>
										<th class="hidden-xs hidden-sm">
											<label class="checkbox-container">
												<input type="checkbox" id="checkAll"> 
												<span class="checkmark checkmark-header"></span>
											</label>
										</th>
										<th><a class="<?php echo $sort==1?'active-sort':''; ?>" href="<?php echo Route::makeParams('sort',$sort==1?-1:1,['p']) ?>" > Titre <span class="icon <?php echo $sort==-1?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span> </a></th>
										<th><a class="<?php echo $sort==2?'active-sort':''; ?>" href="<?php echo Route::makeParams('sort',$sort==2?-2:2,['p']) ?>" > Auteur <span class="icon <?php echo $sort==-2?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span> </a></th>
										<th><a class="<?php echo $sort==3?'active-sort':''; ?>" href="<?php echo Route::makeParams('sort',$sort==3?-3:3,['p']) ?>" > Date <span class="icon <?php echo $sort==-3?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span> </a></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($pages['data'] as $page): ?>

										<tr id="<?php echo $page['id'] ?>">
											<td class="hidden-xs hidden-sm">
												<label class="checkbox-container">
													<input type="checkbox">
													<span class="checkmark"></span>
												</label>
											</td>
											<td><a href="#"><?php echo $page['title']?></a>
												<ul class="grid-actions">
													<a href="<?php echo Setting::getParam('url')."/".$page['slug']; ?>"><li>Afficher</li></a>
													<a href="<?php echo Route::getAll('EditPage').'/id/'.$page['id']; ?>"><li>Modifier</li></a>
													<a onclick="deleteModalPage(<?php echo $page['id'] ?>)"><li>Supprimer</li></a>
												</ul>
											</td>
											<td data-label="Auteur"><?php echo ucfirst($page['author']); ?></td>
											<td data-label="Date"><?php echo Format::dateDisplay($page['published_at'],4); ?></td>

										</tr>
									<?php endforeach;?>
								<?php if(empty($pages['data'])): ?>
								<tr>
									<td> Aucune page trouvée </td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							<	?php endif; ?>
								</tbody>
							</table>
							<input type="hidden" id="params" value='<?php echo $param_json; ?>'>

						</article>
						<footer>
							<?php $this->addModal("pagination",$pages['pagination']); ?>
							<ul class="inline">
								<li>Actions groupées :  </li>
								<li><a href="#"> Place dans la corbeille</a></li>
								<li><a href="#">Dépublier</a></li>
							</ul>
							<span class="push-right"> <?php echo count($pages); ?>  élément(s) </span>
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