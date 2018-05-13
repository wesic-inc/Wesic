<nav>
	<ul class="pagination">
		<?php if($config['currentPage'] != 1): ?>
		<li class="page-item"><a href="<?php echo ROOT_URL.$config['targetUri'].($config['currentPage']-1); ?>" tabindex="-1">Précédent</a></li>
		<?php else: ?>
		<li class="page-item disabled"><a href="" tabindex="-1">Précédent</a></li>
		<?php endif; ?>
		<?php for($i = 0; $i < $config['nbPage']; $i++): ?>
		<li class="page-item <?php echo ($i+1 == $config['currentPage'] )?"active":"";?>">
			<a href="<?php echo ROOT_URL.$config['targetUri'].($i+1); ?>"><?php echo $i+1; ?></a></li>
		<?php endfor; ?>
				<?php if($config['currentPage'] == $config['nbPage']): ?>
		<li class="page-item disabled"><a href="" tabindex="-1">Suivant</a></li>
		<?php else: ?>
		<li class="page-item"><a href="<?php echo ROOT_URL.$config['targetUri'].($config['currentPage']+1); ?>">Suivant</a>
		<?php endif; ?>
		</li>
	</ul>
</nav>