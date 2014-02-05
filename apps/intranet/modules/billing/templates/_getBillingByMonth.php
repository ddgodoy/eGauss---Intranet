<?php if ($billing): ?>
<?php
	$t_affiliated  = $billing->getTotalAffiliated() ? $billing->getTotalAffiliated() : 0;
	$t_consultancy = $billing->getTotalConsultancy() ? $billing->getTotalConsultancy() : 0;
	$t_intermediat = $billing->getTotalIntermediation() ? $billing->getTotalIntermediation() : 0;
	$t_formation   = $billing->getTotalFormation() ? $billing->getTotalFormation() : 0;
	$t_patents     = $billing->getTotalPatents() ? $billing->getTotalPatents() : 0;
	
	$p_affiliated  = $billing->getSaleOfAffiliated() ? $billing->getSaleOfAffiliated() : 0;
	$p_consultancy = $billing->getConsultancy() ? $billing->getConsultancy() : 0;
	$p_intermediat = $billing->getIntermediation() ? $billing->getIntermediation() : 0;
	$p_formation   = $billing->getFormation() ? $billing->getFormation() : 0;
	$p_patents     = $billing->getPatents() ? $billing->getPatents() : 0;
?>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Conceptos Facturados', 'Estimado', 'Facturado'],
    ['Venta de Participadas', <?php echo $t_affiliated ?>,<?php echo $p_affiliated ?>],
    ['Consultoría',           <?php echo $t_consultancy ?>,<?php echo $p_consultancy ?>],
    ['Intermediación',        <?php echo $t_intermediat ?>,<?php echo $p_intermediat ?>],
    ['Formación',             <?php echo $t_formation ?>,<?php echo $p_formation ?>],
    ['Patentes',              <?php echo $t_patents ?>,<?php echo $p_patents ?>]
  ]);

  var options = {
    hAxis: {title: 'Conceptos Facturados', titleTextStyle: {color: 'red'}}
  };

  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
  chart.draw(data, options);
}

function drawChart2(data) {
    var data = google.visualization.arrayToDataTable(data);

    var options = {
      hAxis: {title: 'Conceptos Facturados', titleTextStyle: {color: 'red'}}
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}

$(document).ready(function(){
    $('#btn_action_graph').click(function(){
        var month_graph = $('#month_graph').val();
        var year_graph  = $('#year_graph').val();
        $('#chart_div').html('<div style="width: 350px; height: 204px; text-align: center; padding-top: 40px;"><img src="/images/loading.gif"/></div>');
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo url_for('@billing-by-month-year') ?>',
            data: 'month_graph='+month_graph+'&year_graph='+year_graph,
            success: function(data)
            {
            	var parseada = JSON.parse(data);

            	$('#lbl_tot_estimado').html(parseada.estimado);
            	$('#lbl_tot_facturado').html(parseada.facturado);
            	
            	drawChart2(parseada.datos);
            }
        });
    })
})  
</script>
<?php endif; ?>
<div class="paneles">
    <h1><?php echo __('Facturación') ?><span style="float: right"><?php echo select_tag('month_graph', options_for_select($month, (int)date('m')),array('id'=>'month_graph')) ?> / <?php echo select_tag('year_graph', options_for_select($array_year, date('Y')),array('id'=>'year_graph')) ?>  <input type="button" id="btn_action_graph" class="boton" style="padding: 0; padding-bottom: 2px;" value="ver" name="btn_action"></span></h1>
    <div id="chart_div" style="width: 350px; height: 204px;">
      <div style="width:350px;height:204px;text-align:center;padding-top:40px;"><img src="/images/loading.gif"/></div>
    </div>
    <?php
 			$tot_estimado = $t_affiliated + $t_consultancy + $t_intermediat + $t_formation + $t_patents;
 			$tot_facturad = $p_affiliated + $p_consultancy + $p_intermediat + $p_formation + $p_patents;
		?>
    <table cellpadding="0" cellspacing="0" align="center" style="color:#666666;">
    	<tr><td height="10"></td></tr>
  		<tr>
  			<td>Total estimado:</td><td width="10"></td>
  			<td><strong><label id="lbl_tot_estimado"><?php echo $tot_estimado; ?></label></strong></td>
  		</tr>
  		<tr>
  			<td>Total facturado:</td><td width="10"></td>
  			<td><strong><label id="lbl_tot_facturado"><?php echo $tot_facturad; ?></label></strong></td>
  		</tr>
  	</table>
</div>