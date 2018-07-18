<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc article-bloc">
			<div class="inner-bloc">
				
				<a href="<?php Route::echo('AllArticles'); ?>" class="btn-back tooltip"><span class="icon icon-arrow-left2"></span><span class="tooltiptext tooltip-bottom">Retourner en arrière</span></a>
				
				<?php $this->createForm($form, $errors); ?>
			</div>
		</div>
	</div>
</div>

<div id="allMediasModal" class="modal">
<div class="modal-media-content">
	<div class="modal-header">
		<h3>Insérer une image</h3><span id="media-count">0</span><span> média selectionné</span>
	</div>
	<div class="modal-media-body">
		<div class="row" id="media-modal-elements">
		<?php if(empty($medias['data'])): ?>
			<div class="col-sm-12 text-center"><h4> Aucun média pour le moment </h4></div>
		<?php endif ?>
		<?php foreach ($medias['data'] as $media): ?>
			<div class="col-sm-2" > 
			<?php if($media['type'] == 1): ?>
				<img class="media-item-modal" id="<?php echo $media['id'] ?>" onclick="selectMedia(<?php echo $media['id'] ?>)" path="<?php echo $media['path'] ?>" type="<?php echo $media['type'] ?>" src="<?php echo '/'.$media['path']; ?>">
			<?php elseif($media['type'] == 2): ?>
				<img class="media-item-modal" id="<?php echo $media['id'] ?>" onclick="selectMedia(<?php echo $media['id'] ?>)" path="<?php echo $media['url'] ?>" type="<?php echo $media['type'] ?>" src="<?php echo Format::videoImg($media['url']); ?>"> 
			<?php elseif($media['type'] == 3): ?>
				<img class="media-item-modal" id="<?php echo $media['id'] ?>" onclick="selectMedia(<?php echo $media['id'] ?>)" path="<?php echo $media['path'] ?>" type="<?php echo $media['type'] ?>" src="<?php echo Format::img('music-icon.png'); ?>"> 
			<?php endif ?>
			</div>
		<?php endforeach ?>
		</div>
		<?php $this->addModal('pagination-ajax',['p'=>$medias['pagination'],'js'=>'getPageModalMedia']) ?>
	</div>
	<div class="modal-footer-media">
		<a class="btn btn-primary btn-sm" id="valid-action" onclick="insertSelection()">Insérer</a>
		<a class="btn btn-sm btn-alt" id="close-modal">Annuler</a>
	</div>
</div>
</div>
<input type="hidden" id="toInsert">

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