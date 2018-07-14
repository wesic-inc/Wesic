<nav class="paginator">
	<ul class="pagination">
		
		<?php for ($i = 0; $i < Singleton::request()->getPaginate()['totalPage']; $i++): ?>
		
		<li id="page<?php echo $i+1 ?>" class="page-item <?php echo ($i+1 == Singleton::request()->getPaginate()['currentPage'])?"active":"";?>">
			<a  onclick="getPageModalMedia(<?php echo $i+1 ?>)"><?php echo $i+1; ?></a>
		</li>
		
		<?php endfor; ?>
		
	</ul>
</nav>
<input type="hidden" id="pagination-infos" value='<?php echo json_encode(Singleton::request()->getPaginate()); ?>'>