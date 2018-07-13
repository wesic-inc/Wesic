<div class="container-fluid" >
	<div class="row">
				<div class="col-md-12 bloc">
			<div class="inner-bloc">

		<a onclick="insertMedia()"> Insérer un média</a>
	</div>
	</div>
	</div>
</div>

<div id="myModal" class="modal">
<div class="modal-media-content">
	<div class="modal-header">
		<h3>Insérer une image</h3>
	</div>
	<div class="modal-body">
		<?php foreach ($medias as $media): ?>
			<?php echo $media('type'); ?>
		<?php endforeach ?>
	</div>
	<div class="modal-footer">
		<a class="btn btn-primary btn-sm" id="valid-action" onclick="">Insérer</a>
		<a class="btn btn-sm btn-alt" id="close-modal">Annuler</a>
	</div>
</div>
</div>