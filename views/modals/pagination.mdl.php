<nav class="paginator">
	<ul class="pagination">
		<?php if (Singleton::request()->getPaginate()['currentPage'] != 1): ?>
		
		<li class="page-item">
			<a href="
			<?php echo
				Route::makeParams('p', Singleton::request()->getPaginate()['currentPage']-1);
				?>"
			tabindex="-1">Précédent</a>
		</li>
		
		<?php else: ?>
		
		<li class="page-item disabled">
			<a href="" tabindex="-1">Précédent</a>
		</li>
		
		<?php endif; ?>
		
		<?php for ($i = 0; $i < Singleton::request()->getPaginate()['totalPage']; $i++): ?>
		
		<li class="page-item <?php echo ($i+1 == Singleton::request()->getPaginate()['currentPage'])?"active":"";?>">
			<a href="<?php echo Route::makeParams('p', $i+1); ?>"><?php echo $i+1; ?></a>
		</li>
		
		<?php endfor; ?>
		
		<?php if (Singleton::request()->getPaginate()['currentPage'] == Singleton::request()->getPaginate()['totalPage']): ?>
		
		<li class="page-item disabled">
			<a href="" tabindex="+1">Suivant</a>
		</li>
		
		<?php else: ?>
		
		<li class="page-item"
			><a href="<?php
				echo Route::makeParams('p', Singleton::request()->getPaginate()['currentPage']+1);?>">
			Suivant</a>
		</li>
		
		<?php endif; ?>
	</ul>
</nav>