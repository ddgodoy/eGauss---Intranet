<?php if($contracts): ?>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChartContracts);
function drawChartContracts() {
  var data = google.visualization.arrayToDataTable([
    ['Cliente', 'Volumen negocio',{type: 'string', role: 'tooltip', 'p': {'html': true}},'Comisión final', {type: 'string', role: 'tooltip', 'p': {'html': true}}],
    <?php foreach ($contracts AS $v_contract): ?>
        ['<?php echo $v_contract->getCustomer() ?>',  <?php echo $v_contract->getBusinessAmount()?$v_contract->getBusinessAmount():0 ?>,'<div style="padding: 10px;">&nbsp;<b>Fecha de entrega:</b>&nbsp;<?php echo sprintf("%02d",$v_contract->getDay()).'/'.sprintf("%02d",$v_contract->getMonth()).'/'.$v_contract->getYear() ?>&nbsp;<br/>&nbsp;<b>Cliente:</b>&nbsp;<?php echo $v_contract->getCustomer() ?>&nbsp;<br/>&nbsp;<b>Volumen negocio:</b>&nbsp;<?php echo $v_contract->getBusinessAmount()?$v_contract->getBusinessAmount():0 ?></div>',<?php echo $v_contract->getFinalCommission()?$v_contract->getFinalCommission():0 ?>, '<div style="padding: 10px;">&nbsp;<b>Fecha de entrega:</b>&nbsp;<?php echo sprintf("%02d",$v_contract->getDay()).'/'.sprintf("%02d",$v_contract->getMonth()).'/'.$v_contract->getYear() ?>&nbsp;<br/>&nbsp;<b>Socio:</b>&nbsp;<?php echo $v_contract->getAppUser()->getName().' '.$v_contract->getAppUser()->getLastName() ?>&nbsp;<br/>&nbsp;<b>Comisión final:</b>&nbsp;<?php echo $v_contract->getFinalCommission()?$v_contract->getFinalCommission():0 ?></div>'],
    <?php endforeach; ?>
  ]);

  var options = {
    hAxis: {title: 'Contratos de Intermediación', titleTextStyle: {color: 'red'}},
    // Use an HTML tooltip.
    tooltip: { isHtml: true }
  };

  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_contracts'));
  chart.draw(data, options);
}

/*function drawChartContracts2(data) {
    var data = google.visualization.arrayToDataTable(
        [
            ['Cliente', 'Volumen negocio',{type: 'string', role: 'tooltip', 'p': {'html': true}},'Comisión final', {type: 'string', role: 'tooltip', 'p': {'html': true}}],
            data
        ]);

    var options = {
    hAxis: {title: 'Contratos de Intermediación', titleTextStyle: {color: 'red'}},
    // Use an HTML tooltip.
    tooltip: { isHtml: true }
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_contracts'));
    chart.draw(data, options);
}

$(document).ready(function(){
    $('#btn_action_contracts').click(function(){
        var month_contracts = $('#month_contracts').val();
        var year_contracts  = $('#year_contracts').val();
        
        jQuery.ajax({
            type: 'POST',
            url: '<?php // echo url_for('@contracts-by-month-year') ?>',
            data: 'month_contracts='+month_contracts+'&year_contracts='+year_contracts,
            success: function(data) {
                drawChartContracts2(JSON.parse(data))
            }
        });
    })
})*/  
</script>
<?php endif; ?>
<div class="paneles">
    <h1><?php echo __('Contratos de Intermediación') ?><span style="float: right"><?php echo 'Año:&nbsp;'.date('Y') ?></span></h1>
    <div id="chart_div_contracts" style="width: 350px; height: 204px;">
        <div style="width: 350px; height: 204px; text-align: center; padding-top: 40px;"><img src="/images/loading.gif"/></div>
    </div> 
</div>
