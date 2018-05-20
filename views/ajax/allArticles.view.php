<?php foreach($articles as $article): ?>
	<tr>
		<td class="hidden-xs hidden-sm">
			<label class="checkbox-container">
				<input type="checkbox" id="<?php echo $article['id'] ?>">
				<span class="checkmark"></span>
			</label>
		</td>
		<td><a href="#"><?php echo $article['title']?></a>
			<ul class="grid-actions">
				<a href="<?php echo Setting::getParam('url')."/".$article['slug']; ?>"><li>Afficher</li></a>
				<a href="<?php Route::echo('EditArticle','/id/'.$article['id']); ?>"><li>Modifier</li></a>
				<a href="<?php Route::echo('DeleteArticle','/id/'.$article['id']); ?>"><li>Supprimer</li></a>
			</ul>
		</td>
		<td data-label="Status"><?php echo Format::getStatusArticle($article['status']);?></td>
		<td data-label="Auteur"><a href="#"><?php echo Format::getAuthorName($article['user_id']); ?></a></td>
		<td data-label="Catégorie"><a href="#">News</a></td>
		<td data-label="Tags"><a href="#">Article</a>, <a href="#">musique</a>, <a href="#">2018</a></td>
		<td data-label="Date"><?php echo Format::dateDisplay($article['datePublied'],4); ?></td>

	</tr>
	<?php endforeach;?>