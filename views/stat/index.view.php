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
						<a href="#" id="scale5" class="btn btn-sm btn-primary-inverted">Aujourd'hui</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<hidden id="json_stats" value="<?php echo $stat_json ?>">
<script>
	 
	document.getElementById('scale1').addEventListener('click', function() {
		myLine.data.labels = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
		myLine.data.datasets[0].data = [13,3,4,1,5,13,3,4,1,5,1,5];
		myLine.data.datasets[1].data = [13,3,4,1,5,13,3,4,1,5,1,5];
		myLine.options.title.text = 'Statistiques sur 1 an';

		myLine.update();
	});

	document.getElementById('scale2').addEventListener('click', function() {
		myLine.data.labels = ['Janvier', 'Février', 'Mars','Janvier', 'Février', 'Mars'];
		myLine.data.datasets[0].data = [13,3,4,1,5,13];
		myLine.data.datasets[1].data = [13,3,4,1,5,13];
		myLine.options.title.text = 'Statistiques sur 6 mois';


		myLine.update();
	});

	document.getElementById('scale3').addEventListener('click', function() {
		myLine.data.labels = ['Janvier', 'Février', 'Mars'];
		myLine.data.datasets[0].data = [13,3,4,1,5,13];
		myLine.data.datasets[1].data = [13,3,4,1,5,13];
		myLine.options.title.text = 'Statistiques sur 3 mois';

		myLine.update();
	});

	document.getElementById('scale4').addEventListener('click', function() {
		myLine.data.labels = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
		myLine.data.datasets[0].data = [13,3,4,1,5,13,12];
		myLine.data.datasets[1].data = [3,3,4,1,51,1,12];
		myLine.options.title.text = 'Statistiques sur 1 semaine';

		myLine.update();
	});

	document.getElementById('scale5').addEventListener('click', function() {
		myLine.data.labels = ['00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00','00:00'];
		myLine.data.datasets[0].data = [13,3,4,1,5,13,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
		myLine.data.datasets[1].data = [13,3,4,1,5,13,13,3,4,1,5,13,13,3,4,1,5,13,13,3,4,113,3,4,1];
		myLine.options.title.text = "Statistiques aujourd'hui";


		myLine.update();
	});

	var label = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

	var config = {
		type: 'line',
		data: {
			labels: label,
			datasets: [{
				label: 'Nombre de visiteurs non connectés',
				backgroundColor: '#F83E48',
				borderColor: '#F83E48',
				data: [
				0,2, 52, 235,23, 23, 23, 251, 23, 0, 52, 235
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
				text: 'Statistiques sur 1 an'
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

