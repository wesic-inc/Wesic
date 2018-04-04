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
<form action="<?php echo $config["options"]["action"]?>" method="<?php echo $config["options"]["method"]?>">
	<?php foreach ($config["struct"] as $name => $option) :?>

		<?php if($option["type"] == "text"|| $option["type"]=="password"):?>
			<label for="<?php echo $name ?>"><?php echo $option["label"] ;?></label>
			<input name="<?php echo $name ?>" 
					type="<?php echo $option["type"] ;?>"
					id="<?php echo $option["id"] ;?>"
					placeholder="<?php echo $option["placeholder"] ;?>"
					<?php echo ($option["required"])?"required='required'":""?>
					value= "<?php echo (isset($data[$name]) && $option["type"]!="password")?$data[$name]:""?>"
					> 
		<?php elseif($option["type"]=="textarea"):?>
			<label for="<?php echo $name ?>"><?php echo $option["label"] ;?></label>
			<textarea name="<?php echo $name ?>"
						id="<?php echo $option["id"] ;?>"
						placeholder="<?php echo $option["placeholder"] ;?>" 
						<?php echo ($option["required"])?"required='required'":""?>><?php echo (isset($data[$name]))?$data[$name]:""?></textarea>
		<?php elseif($option["type"]=="select" ):?>
			<label for="<?php echo $name ?>"><?php echo $option["label"] ;?></label>
			<select name="<?php echo $name ?>" id="<?php echo $option["id"] ;?>" placeholder="<?php echo $option["placeholder"] ;?>" <?php echo ($option["required"])?"required='required'":""?>>
				<?php foreach ($option["choices"] as $value=>$title) :?>
				
				<option <?php echo ($data[$name]==$value)?'selected="selected"':""?> value="<?php echo $value ?>"> <?php echo ucfirst($title) ?></option>
				<?php endforeach;?>
			
			</select>
		<?php elseif($option["type"] == "datetime"):?>
			<label for="<?php echo $name ?>"><?php echo $option["label"] ;?></label>
			<input name="<?php echo $name ?>" 
					type="datetime-local"
					id="<?php echo $option["id"] ;?>"
					placeholder="<?php echo $option["placeholder"] ;?>"
					<?php echo ($option["required"])?"required='required'":""?>
					value= "<?php echo (isset($data[$name]) && $option["type"]!="password")?$data[$name]:""?>"
					> 
		<?php elseif($option["type"] == "date"):?>
			<label for="<?php echo $name ?>"><?php echo $option["label"] ;?></label>
			<input name="<?php echo $name ?>" 
					type="<?php echo $option["type"] ;?>
					id="<?php echo $option["id"] ;?>"
					placeholder="<?php echo $option["placeholder"] ;?>"
					<?php echo ($option["required"])?"required='required'":""?>
					value= "<?php echo (isset($data[$name]) && $option["type"]!="password")?$data[$name]:""?>"
					> 
		<?php endif;?>

		<br>

	<?php endforeach;?>


	<input type="submit" value="<?php echo $config["options"]["submit"]?>">

</form>