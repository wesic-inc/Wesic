<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bloc">
			<div class="inner-bloc">
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
<hidden id='json_stats' value='<?php echo $stat_json; ?>' >

<script type="text/javascript">
	var dataStatsA = <?php echo $statA_json ?>;
	var dataStatsK = <?php echo $statK_json ?>;
	var dataScales = <?php echo $scale_json ?>;

</script>