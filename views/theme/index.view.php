<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc">
			<a href="<?php Route::echo('EditTheme') ?>" class="btn btn-sm btn-alt btn-add">
				Personnaliser mon thème
			</a>
			<a href="<?php Route::echo('ThemeCreator') ?>" class="btn btn-sm btn-add">
				Theme Creator
			</a>
				<a href="#" class="btn btn-sm btn-alt hidden-xs push-right">Rechercher</a> 
				<input type="text" class="search-input sm-input hidden-xs push-right" placeholder="Rechercher dans les médias">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
							<div class="col-md-4 theme-one ">
								<div class="theme-item reponsive-img active" 
								style="background-image: url('<?php echo Format::img('template.jpg'); ?>'); background-size: cover;">
								<div class="title-theme">
									<p><span class="label-theme-active">Activé :</span> Mon Thème !</p>
								</div>
								<div class="action-theme">
									<a href="<?php Route::echo('EditTheme'); ?>" class="btn btn-sm"> Personnaliser </a>
								</div>
								</div>
							</div>
						<?php for($i= 0; $i<10;$i++):?>
							<div class="col-md-4 theme-one">
								<div class="theme-item reponsive-img" 
								style="background-image: url('<?php echo Format::img('template.jpg'); ?>'); background-size: cover;">
								<div class="title-theme">
									<p> Mon Thème !</p>
								</div>
								<div class="action-theme">
									<a href="<?php Route::echo('SetTheme') ?>/id/1" class="btn btn-sm"> Appliquer </a>
									<a href="#" class="btn btn-sm btn-primary"> Détails </a>
								</div>
								</div>
							</div>
						<?php endfor;?>
					</div>
				</div>
			</div> 			
		</div>
	</div>
</div>
