<?php foreach($users as $user): ?>
<tr">
<td class="hidden-xs"><label class="checkbox-container">
	<input type="checkbox">
	<span class="checkmark"></span>
</label></td>
<td class="entity-key"><a href="#post=id"><?php echo ucfirst($user['login']); ?></a>
	<ul class="grid-actions">
		<a href="/admin/afficher-utilisateur/<?php echo $user['id']; ?>"><li>Afficher</li></a>
		<a href="/admin/modifier-utilisateur/<?php echo $user['id']; ?>"><li>Modifier</li></a>
		<a href="#"><li>Supprimer</li></a>
	</ul>
</td>
<td data-label="Nom"><?php echo $user['lastname']." ".$user['firstname']; ?></td>
<td data-label="E-mail"><a href="#"><?php echo $user['email']; ?></a></td>
<td data-label="Rôle"><?php echo Format::getRole($user['role']); ?></td>
<td data-label="Posts">0</td>

</tr>
<?php endforeach; ?>
<?php if(empty($users)): ?>
<tr>
	<td> Aucune utilisateurs trouvés </td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<? endif; ?>
	