<?php foreach($errors as $error):?>

	<?php echo "<li>".$errors_msg[$error];?>

<?php endforeach;?>

<?php
	if(isset($_POST))
		$data = $_POST;
	elseif(isset($_GET)){
		$data = $_GET;
	}
?>


<?php if($form["options"]["groups"] == true): ?>

<?php Form::render($form, $data, 'group'); ?>

<?php else: ?>	

<?php Form::render($form, $data); ?>

<?php endif; ?>
