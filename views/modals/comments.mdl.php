<?php foreach($config as $comment): ?>
<div class="row">
	<div class="col-md-12">
<h5><?php echo $comment['username']; ?></h5>
<p><?php echo $comment['body']; ?></p>
	</div>
</div>
<?php endforeach ?>