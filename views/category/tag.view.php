<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc article-bloc"></span>
			<div class="inner-bloc">
				<header>
					<input type="text" class="search-input sm-input hidden-xs" >
					<a href="#" class="btn btn-sm btn-alt hidden-xs">Rechercher</a> 
				</header>
				<article >
					<div class="row">
						<div class="col-md-4">

							<?php $this->createForm($form, $errors); ?>

						</div>
						<div class="col-md-8">
							<table class="table table-stripped">
								<thead>
									<tr>
										<th class="hidden-xs hidden-sm">
											<label class="checkbox-container"  >
												<input type="checkbox" id="checkAll">
												<span class="checkmark checkmark-header"></span>
											</label>
										</th>
										<th id="filter1" sort="" onclick="test2(this.id)" ><a href="#">Nom</a></th>
										<th id="filter2" sort="" onclick="test2(this.id)" ><a href="#">Slug</a></th>
										<th id="filter3" sort="" onclick="test2(this.id)" ><a href="#">Total</a></th>
									</tr>
								</thead>
								<tbody id="body-ajax">
									<?php foreach($tags as $tag): ?>
									<tr>
										<td class="hidden-xs hidden-sm">
											<label class="checkbox-container">
												<input type="checkbox" id="<?php echo $article['id'] ?>">
												<span class="checkmark"></span>
											</label>
										</td>
										<td><a href="#"><?php echo $tag['label']?></a>
											<ul class="grid-actions">
												<a href="<?php echo Setting::getParam('url')."/".$tag['slug']; ?>"><li>Afficher</li></a>
												<a href="<?php Route::echo('EditTag','/id/'.$tag['id']); ?>"><li>Modifier</li></a>
												<a href="<?php Route::echo('DeleteTag','/id/'.$tag['id']); ?>"><li>Supprimer</li></a>
											</ul>
										</td>
										<td data-label="Slug"><?php echo $tag['slug'];?></td>
										<td data-label="Total"><a href="#">0</a></td>

									</tr>
									<?php endforeach;?>
								</tbody>
							</table>
							<footer>

								<?php $this->addModal("pagination"); ?>

								<ul class="inline">
									<li>Actions groupées :  </li>
									<li><a href="#"> Place dans la corbeille</a></li>
									<li><a href="#">Dépublier</a></li>
								</ul>
								<span class="push-right"> <?php echo count($tags); ?> éléments </span>
							</footer>
						</div>
					</div>
					<input type="hidden" id="params" value='<?php echo $param_json; ?>'>

				</article>

			</div>

		</div>
	</div>
</div>