<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc">
			<a href="<?php Route::echo('Medias'); ?>" class="btn-back tooltip">
				<span class="icon icon-arrow-left2"></span>
				<span class="tooltiptext tooltip-bottom">Retourner en arrière</span>
			</a>
			<br>
			<a id="addVideo" href="<?php Route::echo('newMediaVideo'); ?>" class="btn btn-sm">Ajouter une vidéo</a> 
			<a id="addImage" href="<?php Route::echo('newMediaImage'); ?>" class="btn btn-sm btn-alt">Ajouter une image</a> 
			<a id="addMusic" href="<?php Route::echo('newMediaMusic'); ?>" class="btn btn-sm btn-alt">Ajouter une musique</a> 
            <?php  $this->createForm($form, $errors);  ?>
		</div>

	</div>
</div>

