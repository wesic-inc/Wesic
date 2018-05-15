<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc">
			<a href="#" class="btn btn-sm btn-add">Ajouter un média</a> 
			<div class="col-md-12 toolbar-media">
				<ul class="inline">
					<li>
						<select class="sm-input">
							<option>Tous les médias</option>
							<option>Images</option>
							<option>Vidéos</option>
							<option>Musiques</option>
						</select>
					</li>
					<li> 
						<select class="sm-input">
							<option>Toutes les dates</option>
							<option>Mars 2018</option>
							<option>Avril 2018</option>
							<option>Mai 2018</option>
						</select>
					</li>
					<li>
						<a href="#" class="btn btn-sm btn-inverted"> Filtrer </a>
					</li>
					<li class="push-right">
						<input type="text" class="search-input sm-input  hidden-xs" placeholder="Rechercher dans les médias">
						<a href="#" class="btn btn-sm btn-alt hidden-xs">Rechercher</a> 
					</li>
				</ul>
			</div>
			<div class="row grid-media-row">
				<?php foreach(range(0,50) as $img): ?>
					<div class="col-xs-2 col-sm-3 col-md-2 col-lg-2 grid-media">
						<img onclick="viewMedia(<?php echo 1; ?>)" class="reponsive-img" src="../../public/img/user.jpg">
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
</div>

<div class="modal modal-closed" id="modal">
	<div class="modal-header">
		<h3> Détails du média </h3>
		<ul class="inline toolbox-modal">
			<li><a onclick="viewMedia()" href="#"><span class="icon icon-cross"></span></a></li>
		</ul>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-sm-8 thumbnail-fullscreen text-center">
				<div class="row">
					<div class="col-md-12" >
						<img class="reponsive-img modal-img" src="../../public/img/user.jpg">
					</div>
				</div>

			</div>
			<div class="col-sm-4">
				<ul>
					<li>Nom du fichier : test.jpg</li>
					<li>Type de fichier : image/jpg</li>
					<li>Uploadé le : 18/01/2018</li>
					<li>Taille du fichier : 1mo</li>
					<li>Dimension : 1000pixels * 1000 pixels</li>
				</ul>
				<div class="form-group">
					<ul>
						<li>
							<div class="input-group">
								<label class="label-input" for="firstname">Lien vers le fichier :</label>
								<input class="sm-input" name="firstname" type="text" placeholder="Lien">
							</div>
						</li>
						<li>
							<div class="input-group">
								<label class="label-input" for="firstname">Titre :</label>
								<input class="sm-input" name="firstname" type="text" placeholder="Titre">
							</div>
						</li>
						<li>						
							<div class="input-group">
								<label class="label-input" for="firstname">Texte alternatif :</label>
								<input class="sm-input" name="firstname" type="text" placeholder="Texte">
							</div>
						</li>
						<li>							
							<div class="input-group">
								<label class="label-input" for="firstname">Description :</label>
								<input class="sm-input" name="firstname" type="text" placeholder="Description">
							</div>
						</li>

					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal-overlay modal-closed" onClick="viewMedia(<?php echo 1; ?>)" id="modal-overlay">
