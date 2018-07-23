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
			<a href="<?php Route::echo('Medias'); ?>" class="btn-back tooltip">
				<span class="icon icon-arrow-left2"></span>
				<span class="tooltiptext tooltip-bottom">Retourner en arrière</span>
			</a>
			<br>
			<?php if($type === $mediaType['image']): ?>
            	<label> Lien du fichier </label>
            	<input type="text" value="<?php echo $path ?>" disabled>
            	<br>
            	<br>
				<img class="edit-image-preview" src="<?php echo '/'.$path ?>" > 
			<?php elseif($type === $mediaType['video']): ?>
				<img class="edit-image-preview" src=<?php echo "https://img.youtube.com/vi/".$url."/0.jpg?" ?> > 
			<?php endif ?>
            <?php  $this->createForm($form, $errors);  ?>
		</div>

	</div>
</div>

