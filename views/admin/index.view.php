<div class="container-fluid" >
	<div class="row">
		<div class="col-md-6" id="left">
			<?php foreach ($left as $block): ?>
				<?php if ($block != 'NULL'): ?>
					<?php $this->addModal("block-".$block, $blockData[$block]); ?>
				<?php endif ?>
			<?php endforeach ?>			
		</div>
		<div class="col-md-6" id="right">
			<?php foreach ($right as $block): ?>
				<?php if ($block != 'NULL'): ?>
					<?php $this->addModal("block-".$block, $blockData[$block]); ?>
				<?php endif ?>
			<?php endforeach ?>
		</div>
	</div>
	
<?php if (Setting::getParam('tuto-modal') == '1'): ?>
	<div class="col-md-10">
		<?php $this->addModal("welcome"); ?>
	</div>
<?php endif ?>

	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin"],
				datasets: [{
					label: '# of Votes',
					data: [12, 19, 3, 5, 2, 3],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>