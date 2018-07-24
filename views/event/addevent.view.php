<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc">
			<div class="inner-bloc">
				
				<a href="<?php Route::echo('Events'); ?>" class="btn-back tooltip"><span class="icon icon-arrow-left2"></span><span class="tooltiptext tooltip-bottom">Retourner en arrière</span></a>
				<?php $this->createForm($form, $errors); ?>
			</div>
		</div>
	</div>
</div>


<div id="featuredModal" class="modal">
<div class="modal-media-content">
	<div class="modal-header">
		<h3>Choisir l'image mise en avant</h3>
	</div>
	<div class="modal-media-body">
		<div class="row" id="images-modal-elements">

		<?php foreach ($images['data'] as $media): ?>
			<div class="col-sm-2" > 
				<img class="media-item-modal" id="<?php echo $media['id'] ?>" onclick="selectImage(<?php echo $media['id'] ?>,<?php echo $media['type'] ?>)" path="<?php echo $media['path'] ?>" type="<?php echo $media['type'] ?>" src="<?php echo '/'.$media['path']; ?>">
			</div>
		<?php endforeach ?>
		</div>
		<?php $this->addModal('pagination-ajax',['p'=>$images['pagination'],'js'=>'getPageModalImage']) ?>
	</div>
	<div class="modal-footer-media">
		<a class="btn btn-sm btn-alt" id="close-modal">Annuler</a>
	</div>
</div>
</div>