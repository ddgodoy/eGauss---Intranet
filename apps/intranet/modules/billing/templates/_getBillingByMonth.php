<?php if($billing): ?>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Conceptos Facturados', 'Estimado', 'Facturado'],
    ['Venta de Participadas',  <?php echo $billing->getTotalAffiliated()?$billing->getTotalAffiliated():0 ?>,<?php echo $billing->getSaleOfAffiliated()?$billing->getSaleOfAffiliated():0 ?>],
    ['Consultoría',            <?php echo $billing->getTotalConsultancy()?$billing->getTotalConsultancy():0 ?>,<?php echo $billing->getConsultancy()?$billing->getConsultancy():0 ?>],
    ['Intermediación',         <?php echo $billing->getTotalIntermediation()?$billing->getTotalIntermediation():0 ?>,<?php echo $billing->getIntermediation()?$billing->getIntermediation():0 ?>],
    ['Formación',              <?php echo $billing->getTotalFormation()?$billing->getTotalFormation():0 ?>,<?php echo $billing->getFormation()?$billing->getFormation():0 ?>],
    ['Patentes',               <?php echo $billing->getTotalPatents()?$billing->getTotalPatents():0 ?>,<?php echo $billing->getPatents()?$billing->getPatents():0 ?>]
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
            success: function(data) {
                drawChart2(JSON.parse(data))
            }
        });
    })
})  
</script>
<?php endif; ?>
<div class="paneles">
    <h1><?php echo __('Facturación') ?><span style="float: right"><?php echo select_tag('month_graph', options_for_select($month, (int)date('m')),array('id'=>'month_graph')) ?> / <?php echo select_tag('year_graph', options_for_select($array_year, date('Y')),array('id'=>'year_graph')) ?>  <input type="button" id="btn_action_graph" class="boton" style="padding: 0; padding-bottom: 2px;" value="ver" name="btn_action"></span></h1>
    <div id="chart_div" style="width: 350px; height: 204px;">
        <div style="width: 350px; height: 204px; text-align: center; padding-top: 40px;"><img src="/images/loading.gif"/></div>
    </div> 
</div>
