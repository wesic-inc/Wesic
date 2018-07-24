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
										<th><a class="<?php echo $sort==1?'active-sort':''; ?>" href="<?php echo Route::makeParams('sort',$sort==1?-1:1,['p']) ?>" > Nom <span class="icon <?php echo $sort==-1?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span></a></th>
										<th><a class="<?php echo $sort==2?'active-sort':''; ?>" href="<?php echo Route::makeParams('sort',$sort==2?-2:2,['p']) ?>" > Slug <span class="icon <?php echo $sort==-2?'icon-sort-alpha-desc':'icon-sort-alpha-asc' ?>"></span> </a></th>
									</tr>
								</thead>
								<tbody id="body-ajax">
									<?php foreach($categories['data'] as $category): ?>
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

									</tr>
									<?php endforeach;?>
								</tbody>
							</table>
							<footer>

								<?php $this->addModal("pagination",$categories['pagination']); ?>

								<span class="push-right"> <?php echo $categories['pagination']['total']; ?> éléments </span>
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