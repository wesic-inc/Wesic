
document.getElementById('scale1').addEventListener('click', function() {
		myLine.data.labels = dataScales['year'];
		myLine.data.datasets[0].data = dataStatsA['year'];
		myLine.data.datasets[1].data = dataStatsK['year'];
		myLine.options.title.text = 'Statistiques sur 1 an';

		myLine.update();
	});

	document.getElementById('scale2').addEventListener('click', function() {
		myLine.data.labels = dataScales['semester'];
		myLine.data.datasets[0].data = dataStatsA['semester'];
		myLine.data.datasets[1].data = dataStatsK['semester'];
		myLine.options.title.text = 'Statistiques sur 6 mois';


		myLine.update();
	});

	document.getElementById('scale3').addEventListener('click', function() {
		myLine.data.labels = dataScales['trimester'];
		myLine.data.datasets[0].data = dataStatsA['trimester'];
		myLine.data.datasets[1].data = dataStatsK['trimester'];
		myLine.options.title.text = 'Statistiques sur 3 mois';

		myLine.update();
	});

	document.getElementById('scale4').addEventListener('click', function() {
		myLine.data.labels = dataScales['week'];
		myLine.data.datasets[0].data = dataStatsA['week'];
		myLine.data.datasets[1].data = dataStatsK['week'];
		myLine.options.title.text = 'Statistiques sur 1 semaine';

		myLine.update();
	});

	document.getElementById('scale5').addEventListener('click', function() {
		myLine.data.labels = dataScales['today'];
		myLine.data.datasets[0].data = dataStatsA['today'];
		myLine.data.datasets[1].data = dataStatsK['today'];
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
				data: dataStatsA['year'],
				fill: false,
			}, {
				label: 'Nombre de visiteurs connectés',
				fill: false,
				backgroundColor: "#913D88",
				borderColor: "#913D88",
				data: dataStatsA['year'],
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