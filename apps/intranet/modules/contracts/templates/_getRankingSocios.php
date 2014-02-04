<?php if ($rSocios): ?>
<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChartSocios);

	function drawChartSocios()
	{
	  var data = google.visualization.arrayToDataTable
	  ([
      ['Socios', 'Volumen', 'Comisión'],
      <?php foreach ($rSocios as $vsocio): ?>
      	['<?php echo $vsocio['socio']; ?>', <?php echo $vsocio['volumen']; ?>, <?php echo $vsocio['comision']; ?>],
      <?php endforeach; ?>
    ]);
    var chart = new google.visualization.BarChart(document.getElementById('chart_div_socios'));

    chart.draw(data);
	}
</script>
<?php endif; ?>
<div class="paneles">
	<h1>
		<?php echo __('Ranking de Socios') ?>
		<span style="float:right"><?php echo 'Año:&nbsp;'.date('Y') ?></span>
	</h1>
	<div id="chart_div_socios" style="width:350px;height:204px;">
		<div style="width:350px;height:204px;text-align:center;padding-top:40px;">
			<img src="/images/loading.gif" border="0" />
		</div>
	</div>
</div>