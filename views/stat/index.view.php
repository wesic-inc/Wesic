<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc">
			<div class="inner-bloc">
				
				<a href="<?php Route::echo('ExportStats') ?>" class="btn btn-sm btn-alt btn-add">Exporter mes statistiques</a> 
				<div class="row">
					<div class="col-md-10">
						<canvas id="myChart" ></canvas>
					</div>
					<div class="col-md-2">
						<a href="#" id="scale1" class="btn btn-sm btn-primary-inverted active">1 an</a>
						<br><br>
						<a href="#" id="scale2" class="btn btn-sm btn-primary-inverted">6 mois</a>
						<br><br>
						<a href="#" id="scale3" class="btn btn-sm btn-primary-inverted">3 mois</a>
						<br><br>
						<a href="#" id="scale4" class="btn btn-sm btn-primary-inverted">1 semaine</a>
						<br><br>
						<a href="#" id="scale5" class="btn btn-sm btn-primary-inverted">1 jour</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	

	document.getElementById('scale1').addEventListener('click', function() {
		window.myLine.scale.xLabels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];

		window.myLine.update();
	});

	document.getElementById('scale2').addEventListener('click', function() {
		window.myLine.scale.xLabels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];

		window.myLine.update();
	});

	var label = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
	var MONTHS = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
	var config = {
		type: 'line',
		data: {
			labels: label,
			datasets: [{
				label: 'Nombre de visiteurs non connectés',
				backgroundColor: '#F83E48',
				borderColor: '#F83E48',
				data: [
				0,23, 52, 235,23, 23, 23, 251, 23, 0, 52, 235
				],
				fill: false,
			}, {
				label: 'Nombre de visiteurs connectés',
				fill: false,
				backgroundColor: "#913D88",
				borderColor: "#913D88",
				data: [
				0, 10, 15, 22, 30, 60, 23, 244, 235, 21, 22, 10
				],
			}]
		},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'Chart.js Line Chart'
			},
			tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Mois'
					}
				}],
				yAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Visistes'
					}
				}]
			}
		}
	};

	window.onload = function() {
		var ctx = document.getElementById('myChart').getContext('2d');
		window.myLine = new Chart(ctx, config);
	};


</script>

