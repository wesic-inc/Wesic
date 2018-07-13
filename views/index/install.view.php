<div class="container-fluid install-bg">
	<div class="row row-no-margin">
		<div class="col-md-offset-4 col-md-4">
		<div class="install-modal">
		<h2 class="login-header"> Bienvenue sur Wesic </h2>
		<div class="login-footer">Installation</div>
		<?php if(!$finished): ?>
		<?php if(!$ext['gd'] || !$ext['pdo'] || !$ext['pdo_mysql'] || !$ext['yaml']): ?>
			<p> Veuillez vérifier que ces extensions soiet activées pour installer Wesic :</p>
			<ul> 
				<li> Extension yaml : <?php echo $ext['gd']?'Activé':'Non activé' ?></li>
				<li> Extension pdo  : <?php echo $ext['pdo']?'Activé':'Non activé' ?></li>
				<li> Extension pdo_mysql : <?php echo $ext['pdo_mysql']?'Activé':'Non activé' ?> </li>
				<li> Extension gd : <?php echo $ext['yaml']?'Activé':'Non activé' ?> </li>
			</ul>
		<?php else: ?>
			<?php $this->createForm($config, $errors); ?>
		<?php endif ?>
		<?php else: ?>
			<p>Félicitation !</p>
			<p> Vous pouvez désormais accéder à votre site !</p>
			<p><a href="">Votre site</a></p>
		<?php endif ?>
		</div>
		</div>
	</div>
</div>
