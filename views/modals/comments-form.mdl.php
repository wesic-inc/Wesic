<?php foreach(Singleton::bridge()['errors'] as $error):?>

	<?php echo "<li>".$errors_msg[$error];?>

<?php endforeach;?>

<form action="" method="POST">
<p>Votre e-mail</p>
<input type="email" name="email" placeholder="Email">
<p>Votre nom</p>
<input type="text" name="name" placeholder="Nom">
<p>Contenu</p>
<textarea name="body" id="body" placeholder="Commentaire" required="required"></textarea>
<button type="submit">Poster</button>
</form>