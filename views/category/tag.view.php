<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc article-bloc"></span>
			<div class="inner-bloc">
				<header>
					<form action="<?php Route::echo('Tags') ?>" method="get">
						<input name="s" type="text" class="search-input sm-input hidden-xs" >
						<button type="submit" class="btn btn-sm btn-alt hidden-xs">Rechercher</button>
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
										<th>Nom</th>
									</tr>
								</thead>
								<tbody id="body-ajax">
									<?php foreach($tags['data'] as $tag): ?>
										<tr>
											<td class="hidden-xs hidden-sm">
												<label class="checkbox-container">
													<input type="checkbox" id="<?php echo $article['id'] ?>">
													<span class="checkmark"></span>
												</label>
											</td>
											<td><a href="#"><?php echo $tag['label']?></a>
												<ul class="grid-actions">
													<a href="<?php Route::echo('EditTag','/id/'.$tag['id']); ?>"><li>Modifier</li></a>
													<a href="<?php Route::echo('DeleteTag','/id/'.$tag['id']); ?>"><li>Supprimer</li></a>
												</ul>
											</td>

										</tr>
									<?php endforeach;?>
									<?php if(isset($tags['data']) && empty($tags['data'])): ?>
									<tr>
										<td> Aucun tag trouvé </td>
										<td></td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
						<footer>

							<?php $this->addModal("pagination",$tags['pagination']); ?>
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