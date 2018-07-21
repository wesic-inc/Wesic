<ul>
<?php foreach($errors as $error):?>

	<?php echo '<li class="error-msg">'.$errors_msg[$error].'</li>';?>

<?php endforeach;?>
</ul>

<?php
	if(isset($_POST))
		$data = $_POST;
	elseif(isset($_GET)){
		$data = $_GET;
	}
?>

<?php if(isset($form["options"]["groups"]) && $form["options"]["groups"] == true): ?>

<?php Form::render($form, $data, 'group'); ?>

<?php else: ?>	

<?php Form::render($form, $data); ?>

<?php endif; ?>
