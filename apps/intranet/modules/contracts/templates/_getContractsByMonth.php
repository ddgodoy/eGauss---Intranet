<script type="text/javascript">
    $(document).ready(function(){
        $('#contracts_th').click(function(){
            $(this).css('background-color', '#999999');
            $('#ranking').css('background-color', '#333333');
            $('#contracts_panel').show();
            $('#ranking_panel').hide();
            drawChartContracts();
        });
        
        $('#ranking').click(function(){
            $(this).css('background-color', '#999999');
            $('#contracts_th').css('background-color', '#333333');
            $('#contracts_panel').hide();
            $('#ranking_panel').show();
            drawChartSocios();
        });
    });
</script>
<?php if ($contracts): ?>
<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChartContracts);

	function drawChartContracts()
	{
	  var data = google.visualization.arrayToDataTable
	  ([
	    ['Cliente',
	     'Volumen negocio', {type: 'string', role: 'tooltip', 'p': {'html': true}},
	     'Comisión final', {type: 'string', role: 'tooltip', 'p': {'html': true}}],
	    <?php foreach ($contracts AS $v_contract): ?>
                ['<?php echo $v_contract->getCustomerName() ?>', <?php echo $v_contract->getBusinessAmount()?$v_contract->getBusinessAmount():0 ?>,'<div style="padding:10px;">&nbsp;<b>Fecha de entrega:</b>&nbsp;<?php echo sprintf("%02d",$v_contract->getDay()).'/'.sprintf("%02d",$v_contract->getMonth()).'/'.$v_contract->getYear() ?>&nbsp;<br/>&nbsp;<b>Cliente:</b>&nbsp;<?php echo $v_contract->getCustomerName() ?>&nbsp;<br/>&nbsp;<b>Volumen negocio:</b>&nbsp;<?php echo $v_contract->getBusinessAmount()?$v_contract->getBusinessAmount():0 ?></div>',<?php echo $v_contract->getFinalCommission()?$v_contract->getFinalCommission():0 ?>, '<div style="padding: 10px;">&nbsp;<b>Fecha de entrega:</b>&nbsp;<?php echo sprintf("%02d",$v_contract->getDay()).'/'.sprintf("%02d",$v_contract->getMonth()).'/'.$v_contract->getYear() ?>&nbsp;<br/>&nbsp;<b>Socio:</b>&nbsp;<?php echo $v_contract->getAppUser()->getName().' '.$v_contract->getAppUser()->getLastName() ?>&nbsp;<br/>&nbsp;<b>Comisión final:</b>&nbsp;<?php echo $v_contract->getFinalCommission()?$v_contract->getFinalCommission():0 ?></div>'],
	    <?php endforeach; ?>
	  ]);
	  var options = 
	  {
	    hAxis: {title: 'Contratos de Intermediación', titleTextStyle: {color: 'red'}},
	    tooltip: { isHtml: true }
	  };
	  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_contracts'));

	  chart.draw(data, options);
	}
</script>
<?php endif; ?>
<?php if ($rSocios): ?>
<script type="text/javascript">
    function drawChartSocios()
    {
      var data = google.visualization.arrayToDataTable
      ([
      ['Socios', 'Volumen', 'Comisión'],
      <?php foreach ($rSocios as $vsocio): ?>
        ['<?php echo $vsocio['socio']; ?>', <?php echo !empty($vsocio['volumen'])?$vsocio['volumen']:0; ?>, <?php echo !empty($vsocio['comision'])?$vsocio['comision']:0 ?>],
      <?php endforeach; ?>
      ]);
      var chart = new google.visualization.BarChart(document.getElementById('chart_div_socios'));

      chart.draw(data);
    }
</script>
<?php endif; ?>
<table width="98%" style="margin-bottom: 0px; text-align: center" cellspacing="0" border="1" class="listados">
        <tr>
          <th width="50%" id="contracts_th" style="text-align: center; cursor: pointer; background-color: #999999;">Contratos de Intermediación</th>
          <th width="50%" id="ranking" style="text-align: center; cursor: pointer">Ranking de Socios</th>
        </tr>
</table>  
<div class="paneles" id="contracts_panel">
	<h1>
		<?php echo __('Contratos de Intermediación') ?>
		<span style="float:right"><?php echo 'Año:&nbsp;'.date('Y') ?></span>
	</h1>
	<div id="chart_div_contracts" style="width:350px;height:204px;">
		<div style="width:350px;height:204px;text-align:center;padding-top:40px;">
			<img src="/images/loading.gif" border="0" />
		</div>
	</div>
</div>
<div class="paneles" style="display: none" id="ranking_panel">
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