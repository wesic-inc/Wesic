<nav class="toolbox-admin"> 
	<ul>
		<li>
			<a class="open tooltip" href="<?php Route::echo('Admin'); ?>"><span class="icon icon-stats-bars"></span>
				<span class="tooltiptext">Accéder au Dashboard</span>
			</a>
		</li>
		<li>
			<a class="open tooltip" href="<?php Route::echo('NewArticle'); ?>"><span class="icon icon-pencil"></span>
				<span class="tooltiptext">Ajouter un article</span>
			</a>
		</li>
		<li>
			<a class="open tooltip" href="<?php Route::echo('NewPage'); ?>"><span class="icon icon-file-empty"></span>
				<span class="tooltiptext">Ajouter une page</span>
			</a>
		</li>
		<?php if(Auth::role() == 3 || Auth::role() == 4): ?>
		<li>
			<a class="open tooltip" href="<?php Route::echo('Comments'); ?>"><span class="icon icon-bullhorn"></span>
				<span class="tooltiptext">Modération</span>
			</a>
		</li>
		<?php endif ?>
		<?php if(Auth::role() == 4): ?>
		<li>
			<a class="open tooltip" href="<?php Route::echo('EditTheme'); ?>"><span class="icon icon-paint-format"></span>
				<span class="tooltiptext">Modifier mon thème</span>
			</a>
		</li>
		<li>
			<a class="open tooltip" href="<?php Route::echo('generalSettings'); ?>"><span class="icon icon-wrench"></span>
				<span class="tooltiptext">Paramètre du site</span>
			</a>
		</li>
		<?php endif ?>
	</ul>
</nav>

