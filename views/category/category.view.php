<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc article-bloc"></span>
			<div class="inner-bloc">
				<header>
					<form action="<?php Route::echo('Categories') ?>" method="get">
						<input name="s" type="text" class="search-input sm-input hidden-xs" >
						<a href="#" class="btn btn-sm btn-alt hidden-xs">Rechercher</a> 
					</form>
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
									<?php foreach($categories as $category): ?>
									<tr id="<?php echo $category['id'] ?>">
										<td class="hidden-xs hidden-sm">
											<label class="checkbox-container">
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</td>
										<td><a href="#"><?php echo $category['label']?></a>
											<ul class="grid-actions">
												<a href="<?php echo Setting::getParam('url')."/".$category['slug']; ?>"><li>Afficher</li></a>
												<a href="<?php Route::echo('EditCategory','/id/'.$category['id']); ?>"><li>Modifier</li></a>
												<?php if($category['type'] != 3): ?>
												<a onclick="deleteModalCategory(<?php echo $category['id'] ?>)"><li>Supprimer</li></a>
												<?php endif;?>
											</ul>
										</td>
										<td data-label="Slug"><?php echo $category['slug'];?></td>
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
								<span class="push-right"> <?php echo count($articles); ?> éléments </span>
							</footer>
						</div>
					</div>
					<input type="hidden" id="params" value='<?php echo $param_json; ?>'>

				</article>

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