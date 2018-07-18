<?php if(setting('comments') != 3): ?>
<br>
<h4> Commentaires :  </h4>
<br>
	<?php foreach($config['comments'] as $comment): ?>
		<div class="row">
			<div class="col-md-12">
				<?php if($comment['type'] == 1): ?>
					<img src="<?php echo Format::gravatar($comment['uemail']) ?>">
					<h5><?php echo $comment['username']; ?></h5>
					<?php else: ?>
						<img src="<?php echo Format::gravatar($comment['email']) ?>">
						<h5><?php echo $comment['name']; ?></h5>
					<?php endif ?>
					<p class="small-text">Posté <?php echo Format::humanTime($comment['created_at']) ?></p>
					<p><?php echo $comment['body']; ?></p>
				</div>
			</div>
			<ul class="comment-action">
			<?php if(!is_null(Auth::user()) && (Auth::role()==3 || Auth::role()==4)): ?>
				<li><a href="<?php Route::echo('DisapproveComment','/id/'.$comment['id'].'/redirect/'.req()->getParam('slug')); ?>"> Désapprouver </a></li>
			<li><a href="<?php Route::echo('ApproveComment','/id/'.$comment['id'].'/redirect/'.req()->getParam('slug')); ?>"> Approuver </a></li>
			<li><a href="<?php Route::echo('DeleteComment','/id/'.$comment['id'].'/redirect/'.req()->getParam('slug')); ?>"> Supprimer </a></li>
			<?php endif ?>
			<?php if($comment['user_id'] == Auth::id()): ?>
			<li><a href="<?php Route::echo('DeleteComment','/id/'.$comment['id'].'/redirect/'.req()->getParam('slug')); ?>"> Supprimer </a></li>
			<?php endif ?>
			<li><a href="<?php Route::echo('ReportComment','/id/'.$comment['id'].'/redirect/'.req()->getParam('slug')); ?>"> Signaler </a></li>
			</ul>
		<?php endforeach ?>
					<?php if (setting('comments')==1): ?>
				<?php if (Auth::isConnected()):?>
					<?php $this->createForm($config['form'], $config['errors']); ?>
				<?php else: ?>
						<p> Vous devez connecter pour poster un commentaire </p> 
				<?php endif ?>
			<?php elseif (setting('comments')==2): ?>
					<?php $this->createForm($config['form'], $config['errors']); ?>
			<?php endif ?>
<?php endif ?>