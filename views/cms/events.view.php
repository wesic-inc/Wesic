<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc article-bloc"></span>
			<div class="inner-bloc">
				
				<a href="<?php Route::echo('AddEvent'); ?>" class="btn btn-sm btn-add">Ajouter un évenement</a></h1> 
				<header>
					<input type="text" class="search-input sm-input hidden-xs" >
					<a href="#" class="btn btn-sm btn-alt hidden-xs">Rechercher</a> 
				</header>
				<article >
					<ul class="inline group-action">
						<li><a href="<?php Route::echo('Pages'); ?>" 
							class="<?php echo !isset($filter)?'active':''; ?>"> Tous <?php echo !isset($filter)?'('.$elementNumber.')':''; ?> </a></li>
							<li><a class="<?php echo $filter==1?'active':''; ?>" href="<?php Route::echo('Pages'); ?>/filter/1"> Passé <?php echo $filter==1?'('.$elementNumber.')':''; ?> </a></li>
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
										<th id="filter1" sort="" onclick="test3(this.id)">Nom</th>
										<th id="filter2" sort="" onclick="test3(this.id)">Lieu</th>
										<th id="filter3" sort="" onclick="test3(this.id)">Date</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($events as $event): ?>

										<tr id="<?php echo $page['id'] ?>">
											<td class="hidden-xs hidden-sm">
												<label class="checkbox-container">
													<input type="checkbox">
													<span class="checkmark"></span>
												</label>
											</td>
											<td><a href="#"><?php echo $event['name']?></a>
												<ul class="grid-actions">
													<a href="<?php echo Setting::getParam('url')."/".$event['slug']; ?>"><li>Afficher</li></a>
													<a href="<?php echo Route::getAll('EditPage').'/id/'.$event['id']; ?>"><li>Modifier</li></a>
													<a onclick="deleteModalPage(<?php echo $event['id'] ?>)"><li>Supprimer</li></a>
												</ul>
											</td>
											<td data-label="Lieu"><a href="#"><?php echo $event['place']; ?></a></td>

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
									<li><a href="#"> Supprimer </a></li>
								</ul>
								<span class="push-right"> <?php echo count($events); ?>  élément(s) </span>
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