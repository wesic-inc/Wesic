<div class="container-fluid" >
	<div class="row">
			<div class="col-md-12 bloc">
			<div class="inner-bloc">

		<a onclick="insertMedia()"> Insérer un média</a>

	<div id="wesic-wysiwyg"> </div>
	</div>
	</div>
	</div>
</div>

<div id="myModal" class="modal">
<div class="modal-media-content">
	<div class="modal-header">
		<h3>Insérer une image</h3><span id="media-count">0</span><span> média selectionné</span>
	</div>
	<div class="modal-body">
		<div class="row">
		<?php foreach ($medias as $media): ?>
			<div class="col-sm-1" > 
			<?php if($media['type'] == 1): ?>
				<img class="media-item-modal" id="<?php echo $media['id'] ?>" onclick="selectMedia(<?php echo $media['id'] ?>,<?php echo $media['type'] ?>)" path="<?php echo $media['path'] ?>" type="<?php echo $media['type'] ?>" src="<?php echo '/'.$media['path']; ?>">
			<?php elseif($media['type'] == 2): ?>
				<img class="media-item-modal" id="<?php echo $media['id'] ?>" onclick="selectMedia(<?php echo $media['id'] ?>,<?php echo $media['type'] ?>)" path="<?php echo $media['url'] ?>" type="<?php echo $media['type'] ?>" src="<?php echo Format::videoImg($media['url']); ?>"> 
			<?php elseif($media['type'] == 3): ?>
				<img class="media-item-modal" id="<?php echo $media['id'] ?>" onclick="selectMedia(<?php echo $media['id'] ?>,<?php echo $media['type'] ?>)" path="<?php echo $media['path'] ?>" type="<?php echo $media['type'] ?>" src="<?php echo Format::img('music-icon.png'); ?>"> 
			<?php endif ?>
			</div>
		<?php endforeach ?>
		</div>
	</div>
	<div class="modal-footer-media">
		<a class="btn btn-primary btn-sm" id="valid-action" onclick="insertSelection()">Insérer</a>
		<a class="btn btn-sm btn-alt" id="close-modal">Annuler</a>
	</div>
</div>
</div>
<input type="hidden" id="toInsert">
