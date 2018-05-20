<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc">
			<a href="<?php Route::echo('ExportStats') ?>" class="btn btn-sm btn-alt btn-add">Exporter mes statistiques</a> 
			<div class="row">
				<div class="col-md-10">
					<canvas id="myChart" ></canvas>
				</div>
				<div class="col-md-2">
					<a href="#" id="1" class="btn btn-sm btn-primary-inverted">1 an</a>
					<br><br>
					<a href="#" id="2" class="btn btn-sm btn-primary-inverted">6 mois</a>
					<br><br>
					<a href="#" id="3" class="btn btn-sm btn-primary-inverted">3 mois</a>
					<br><br>
					<a href="#" id="4" class="btn btn-sm btn-primary-inverted">1 semaine</a>
					<br><br>
					<a href="#" id="5" class="btn btn-sm btn-primary-inverted">1 jour</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	// var ctx = document.getElementById("myChart").getContext('2d');
	

		document.getElementById('1').addEventListener('click', function() {
				window.myLine.scale.xLabels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];

			window.myLine.update();
		});



	var randomScalingFactor = function() {
			return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
	};


	var label = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
	var MONTHS = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
	var config = {
		type: 'line',
		data: {
			labels: label,
			datasets: [{
				label: 'Nombre de visiteurs non connectés',
				backgroundColor: '#D2527F',
				borderColor: '#F83E48',
				data: [
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor()
				],
				fill: false,
			}, {
				label: 'Nombre de visiteurs connectés',
				fill: false,
				backgroundColor: "#913D88",
				borderColor: "#91B496",
				data: [
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor()
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

