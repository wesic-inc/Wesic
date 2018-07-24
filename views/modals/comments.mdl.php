<?php if(setting('comments') != 3): ?>
	<?php foreach(Singleton::bridge()['comments'] as $comment): ?>
		<div class="row">
			<div class="col-md-12">
				<?php if($comment['type'] == 1): ?>
					<img src="<?php echo Format::gravatar($comment['uemail']) ?>">
					<h5><?php echo $comment['username']; ?></h5>
				<?php else: ?>
						<img src="<?php echo Format::gravatar($comment['email']) ?>">
						<h5><?php echo $comment['name']; ?></h5>
				<?php endif ?>
					<p><?php echo $comment['body']; ?></p>
					<p class="small-text">Posté <?php echo Format::humanTime($comment['created_at']) ?></p>
				</div>
			<ul class="comment-action">
			<?php if(!is_null(Auth::user()) && (Auth::role()==3 || Auth::role()==4)): ?>
			<li>
				<a href="<?php Route::echo('DisapproveComment','/id/'.$comment['id'].'/redirect/'.req()->getParam('slug')); ?>"> Désapprouver </a>
			</li>
			<li>
				<a href="<?php Route::echo('ApproveComment','/id/'.$comment['id'].'/redirect/'.req()->getParam('slug')); ?>"> Approuver </a>
			</li>
			<li>
				<a href="<?php Route::echo('DeleteComment','/id/'.$comment['id'].'/redirect/'.req()->getParam('slug')); ?>"> Supprimer </a>
			</li>
			<?php endif ?>
			<?php if($comment['user_id'] === Auth::id()): ?>
			<li>
				<a href="<?php Route::echo('DeleteComment','/id/'.$comment['id'].'/redirect/'.req()->getParam('slug')); ?>"> Supprimer </a>
			</li>
			<?php endif ?>
			<li>
				<a href="<?php Route::echo('ReportComment','/id/'.$comment['id'].'/redirect/'.req()->getParam('slug')); ?>"> Signaler </a>
			</li>
			</ul>
			</div>
	<?php endforeach ?>
	<div class="comment-form">
				<?php if (setting('comments')==1): ?>
					<?php if (Auth::isConnected()):?>
        				<?php include "views/modals/comments-connected-form.mdl.php"; ?>
					<?php else: ?>
						<p> Vous devez connecter pour poster un commentaire </p> 
					<?php endif ?>
					<?php elseif (setting('comments')==2): ?>
        				<?php include "views/modals/comments-form.mdl.php"; ?>
					<?php endif ?>
	</div>
<?php endif ?>