<nav class="paginator">
	<ul class="pagination">
		
		<?php for ($i = 0; $i < $config['p']['totalPage']; $i++): ?>
		
		<li id="page<?php echo $i+1 ?>" class="page-item <?php echo ($i+1 == $config['p']['currentPage'])?"active":"";?>">
			<a  onclick="<?php echo $config['js']?>(<?php echo $i+1 ?>)"><?php echo $i+1; ?></a>
		</li>
		
		<?php endfor; ?>
		
	</ul>
</nav>
<input type="hidden" id="<?php echo $config['js'] ?>" value='<?php echo json_encode($config['p']); ?>'>