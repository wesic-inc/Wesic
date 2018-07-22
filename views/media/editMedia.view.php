<?php 
    $mediaType = array(
        'image' => '1',
        'video' => '2',
        'music' => '3'
    );
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc">
			<?php if($type === $mediaType['image']): ?>
				<img class="edit-image-preview" src="<?php echo Format::root($media['path']) ?>" > 
			<?php elseif($type === $mediaType['video']): ?>
				<img class="edit-image-preview" src=<?php echo "https://img.youtube.com/vi/".$url."/0.jpg?" ?> > 
			<?php endif ?>
            <?php  $this->createForm($form, $errors);  ?>
		</div>

	</div>
</div>

