<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc article-bloc"></span>
			<div class="inner-bloc">
				
				<a href="<?php Route::echo('NewPage'); ?>" class="btn btn-sm btn-add">Ajouter une page</a></h1> 
				<header>
					<input type="text" class="search-input sm-input hidden-xs" >
					<a href="#" class="btn btn-sm btn-alt hidden-xs">Rechercher</a> 
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
										<th id="filter1" sort="" onclick="test3(this.id)">Titre</th>
										<th id="filter2" sort="" onclick="test3(this.id)">Auteur</th>
										<th id="filter3" sort="" onclick="test3(this.id)">Date</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($pages as $page): ?>

										<tr>
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
													<a href="<?php echo Route::getAll('DeletePage').'/id/'.$page['id']; ?>"><li>Supprimer</li></a>
												</ul>
											</td>
											<td data-label="Auteur"><a href="#"><?php echo Format::getAuthorName($page['user_id']); ?></a></td>
											<td data-label="Date"><?php echo Format::dateDisplay($page['datePublied'],4); ?></td>

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
								<span class="push-right"> <?php echo count($pages); ?>  élément(s) </span>
							</footer>
						</div>

					</div>
				</div>
			</div>