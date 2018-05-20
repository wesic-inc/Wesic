<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc article-bloc">
			<a href="<?php Route::echo('AllArticles'); ?>" class="btn-back tooltip"><span class="icon icon-arrow-left2"></span><span class="tooltiptext tooltip-bottom">Retourner en arrière</span></a>
			
			<?php $this->createForm($form, $errors); ?>
		</div>
	</div>
</div>