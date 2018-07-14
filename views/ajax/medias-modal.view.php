<?php foreach ($medias['data'] as $media): ?>
<div class="col-sm-2" > 
<?php $class = in_array($media['id'],$selected)?'selected-media-item':''; ?>
<?php if($media['type'] == 1): ?>
	<img class="media-item-modal <?php echo $class; ?>" id="<?php echo $media['id'] ?>" onclick="selectMedia(<?php echo $media['id'] ?>,<?php echo $media['type'] ?>)" path="<?php echo $media['path'] ?>" type="<?php echo $media['type'] ?>" src="<?php echo '/'.$media['path']; ?>">
<?php elseif($media['type'] == 2): ?>
	<img class="media-item-modal <?php echo $class; ?>" id="<?php echo $media['id'] ?>" onclick="selectMedia(<?php echo $media['id'] ?>,<?php echo $media['type'] ?>)" path="<?php echo $media['url'] ?>" type="<?php echo $media['type'] ?>" src="<?php echo Format::videoImg($media['url']); ?>"> 
<?php elseif($media['type'] == 3): ?>
	<img class="media-item-modal <?php echo $class; ?>" id="<?php echo $media['id'] ?>" onclick="selectMedia(<?php echo $media['id'] ?>,<?php echo $media['type'] ?>)" path="<?php echo $media['path'] ?>" type="<?php echo $media['type'] ?>" src="<?php echo Format::img('music-icon.png'); ?>"> 
<?php endif ?>
</div>
<?php endforeach ?>