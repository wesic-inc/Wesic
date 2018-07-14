<?php foreach ($images['data'] as $media): ?>
	<div class="col-sm-2" > 
		<img class="media-item-modal" id="<?php echo $media['id'] ?>" onclick="selectImage(<?php echo $media['id'] ?>,<?php echo $media['type'] ?>)" path="<?php echo $media['path'] ?>" type="<?php echo $media['type'] ?>" src="<?php echo '/'.$media['path']; ?>">
	</div>
<?php endforeach ?>