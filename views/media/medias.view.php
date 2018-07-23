<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc">
			<a href="<?php Route::echo('newMediaVideo') ?>" class="btn btn-sm btn-add">Ajouter un média</a> 
			<div class="col-md-12 toolbar-media">
				<ul class="inline">
					<li>
						<select id="filter-media" class="sm-input">
							<option <?php echo !isset($filter)?'selected':'' ?> value="0">Tous les médias</option>
							<option <?php echo $filter==1?'selected':'' ?> value="1">Images</option>
							<option <?php echo $filter==2?'selected':'' ?> value="2">Vidéos</option>
							<option <?php echo $filter==3?'selected':'' ?> value=3>Musiques</option>
						</select>
					</li>
					<li class="push-right">
						<form action="<?php Route::echo('Medias') ?>" method="get">
							<input name="s" type="text" class="search-input sm-input hidden-xs" >
							<input type="submit" class="btn btn-sm btn-alt hidden-xs btn-search-fix">
						</form>
					</li>
				</ul>
			</div>
			<div class="row grid-media-row">
				<?php foreach ($medias['data'] as $media): ?>
					<div class="col-xs-2 col-sm-3 col-md-2 col-lg-2 element-media">
						<?php if($media['type'] == 2): ?>
						<div data-type="video" data-src=<?php echo $media['url'] ?> class="media-preview-bloc media-video">
							<img class="miniature-media" src=<?php echo "https://img.youtube.com/vi/".$media['url']."/0.jpg?" ?> />
							<div class="info-media"><p><?php echo $media['name'] ?></p></div>
						</div>
						<?php elseif($media['type'] == 1): ?>
							<div data-type="image" class="media-preview-bloc media-image">
								<img class="miniature-media" src="<?php echo '/'.$media['path'] ?>">
							<div class="info-media"><p><?php echo $media['name'] ?></p></div>
							</div>
						<?php elseif($media['type'] == 3): ?>
							<div data-type="music" data-src="<?php echo '/'.$media['path'] ?>"  class="media-preview-bloc media-music">
								<img  class="miniature-media" src="/public/img/music-icon.png">
								<div class="info-media"><p><?php echo $media['name'] ?></p></div>
							</div>
						<?php endif ?>
						<div class="media-preview-edit">
							<a href=<?php Route::echo('EditMedia','/type/'.$media['type'].'/id/'.$media['id']); ?> >
							<span class="icon-pencil">
							</a>
							<a onclick="deleteModalMedia(<?php echo $media['id'] ?>)">
								<span class="icon-cross">
							</a>
						</div>
					</div>
					           
				<?php endforeach; ?>
				<?php if(empty($medias['data'])): ?>
				<p class="text-center"> Aucun média pour le moment </p>
				<?php endif ?>

			</div>
			<row>
	<?php $this->addModal("pagination",$medias['pagination']); ?>
</row>
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

<div class="modal modal-closed" id="modal">
	<div class="modal-header">
		<h3> DÃ©tails du mÃ©dia </h3>
		<ul class="inline toolbox-modal">
			<li><a onclick="viewMedia()" href="#"><span class="icon icon-cross"></span></a></li>
		</ul>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-sm-8 thumbnail-fullscreen text-center">
				<div class="row">
					<div class="col-md-12" >
						<img class="reponsive-img modal-img" src="">
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<ul>
					<li>Nom du fichier : test.jpg</li>
					<li>Type de fichier : image/jpg</li>
					<li>UploadÃ© le : 18/01/2018</li>
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
<!-- 
<div class="modal-overlay modal-closed" onclick="viewMedia(1)" id="modal-overlay">
<script type="text/javascript" src="/public/js/medias.js"></script> -->