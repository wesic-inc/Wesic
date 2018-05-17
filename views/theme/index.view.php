<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc">
			<a href="<?php Route::echo('EditTheme') ?>" class="btn btn-sm btn-alt btn-add">
				Modifier mon thèle
			</a>
			<a href="<?php Route::echo('ThemeCreator') ?>" class="btn btn-sm btn-add">
				Theme Creator
			</a>
				<a href="#" class="btn btn-sm btn-alt hidden-xs push-right">Rechercher</a> 
				<input type="text" class="search-input sm-input hidden-xs push-right" placeholder="Rechercher dans les médias">
			<div class="row">
				<div class="col-md-12">
					<div class="row">

						<?php for($i= 0; $i<10;$i++):?>
							<div class="col-md-4 theme-one">
								<div class="theme-item reponsive-img" style="background-image: url('<?php echo Format::img('template.jpg'); ?>'); background-size: cover;">
								</div>
							</div>
						<?php endfor;?>
					</div>
				</div>
			</div> 			
		</div>
	</div>
</div>
