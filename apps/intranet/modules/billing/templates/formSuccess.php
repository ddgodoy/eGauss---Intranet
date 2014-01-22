<?php if($id): ?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Conceptos Facturados', 'Estimado', 'Facturado'],
      ['Venta de Participadas',  <?php echo $form['total_affiliated']->getValue() ?>,<?php echo $form['sale_of_affiliated']->getValue() ?>],
      ['Consultoría',  <?php echo $form['total_consultancy']->getValue() ?>,<?php echo $form['consultancy']->getValue() ?>],
      ['Intermediación',  <?php echo $form['total_intermediation']->getValue() ?>,<?php echo $form['intermediation']->getValue() ?>],
      ['Formación',  <?php echo $form['total_formation']->getValue() ?>,<?php echo $form['formation']->getValue() ?>],
      ['Patentes',  <?php echo $form['total_patents']->getValue() ?>,<?php echo $form['patents']->getValue() ?>]
    ]);

    var options = {
      title: 'Facturación',
      hAxis: {title: 'Conceptos Facturados', titleTextStyle: {color: 'red'}}
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}
</script>
<?php endif; ?>
<script type="text/javascript">
$(document).ready(function(){
   $('.no_letters').keydown(function(event) {
        if(event.shiftKey)
        {
             event.preventDefault();
        }

        if (event.keyCode == 46 || event.keyCode == 8)    {
        }
        else {
             if (event.keyCode < 95) {
               if (event.keyCode < 48 || event.keyCode > 57) {
                     event.preventDefault();
               }
             }
             else {
                   if (event.keyCode < 96 || event.keyCode > 105) {
                       event.preventDefault();
                   }
             }
           }
   });
});
</script>
<?php
	$str_module   = $sf_params->get('module');
	$str_action   = $sf_params->get('action');
	$request_id   = $id ?  "?id=$id" : '';
?>
<div class="content">
        <div class="rightside">
            <div class="paneles" id="conten-calendar">
                <?php include_component('calendar', 'calendar') ?>
            </div> 
        </div>
	<div class="leftside" style="margin-left:260px;">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('billing/index') ?>"><strong><?php echo __('Facturación') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __(ucfirst($str_action)) ?>
		</div>
		<?php if ($form->hasErrors() || count($error) > 0): ?>
			<div class="mensajeSistema error">
				<ul>
                                    <?php foreach ($error as $e): ?><li><?php echo $e ?></li><?php endforeach; ?>
                                    <?php foreach($form->getFormFieldSchema() as $name=>$formField) { if ($formField->getError()) { echo '<li>'.$formField->getError().'</li>'; } } ?>
				</ul>
			</div>
		<?php endif; ?>
		<h1 class="titulos">
			<?php echo __(ucfirst($str_action)).' '.__('Facturación') ?>
		</h1>
		<form enctype="multipart/form-data" method="post" action="<?php echo url_for('@'.$str_module.'-'.$str_action.$request_id) ?>">
                    <label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label><br />
			<fieldset>
                            <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                <tr>
                                    <td>
                                       <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                            <tr>
                                                    <td width="20%"><label><?php echo __('Mes / Año') ?> *</label></td>
                                                    <td><?php echo $form['month'] ?>&nbsp;/&nbsp;<?php echo $form['year'] ?></td>
                                            </tr>
                                            <tr><td style="height: 15px;"></td></tr>
                                            <tr>
                                                <td width="20%"><label><b><?php echo __('Venta de Participadas') ?></b></label></td>
                                            </tr>
                                            <tr>
                                                <td width="10%"><label><?php echo __('Estimado') ?></label></td>
                                                <td><?php echo $form['total_affiliated'] ?></td>
                                            </tr> 
                                            <tr>
                                                <td width="10%"><label><?php echo __('Facturado') ?></label></td>
                                                <td><?php echo $form['sale_of_affiliated'] ?></td>
                                            </tr> 
                                            <tr><td style="height: 15px;"></td></tr>
                                            <tr>
                                                <td width="20%"><label><b><?php echo __('Consultoría') ?></b></label></td>
                                            </tr>
                                            <tr>
                                                <td width="10%"><label><?php echo __('Estimado') ?></label></td>
                                                <td><?php echo $form['total_consultancy'] ?></td>
                                            </tr> 
                                            <tr>
                                                <td width="10%"><label><?php echo __('Facturado') ?></label></td>
                                                <td><?php echo $form['consultancy'] ?></td>
                                            </tr> 
                                            <tr><td style="height: 15px;"></td></tr>
                                            <tr>
                                                <td width="20%"><label><b><?php echo __('Intermediación') ?></b></label></td>
                                            </tr>
                                            <tr>
                                                <td width="10%"><label><?php echo __('Estimado') ?></label></td>
                                                <td><?php echo $form['total_intermediation'] ?></td>
                                            </tr> 
                                            <tr>
                                                <td width="10%"><label><?php echo __('Facturado') ?></label></td>
                                                <td><?php echo $form['intermediation'] ?></td>
                                            </tr> 
                                            <tr><td style="height: 15px;"></td></tr>
                                            <tr>
                                                <td width="20%"><label><b><?php echo __('Formación') ?></b></label></td>
                                            </tr>
                                            <tr>
                                                <td width="10%"><label><?php echo __('Estimado') ?></label></td>
                                                <td><?php echo $form['total_formation'] ?></td>
                                            </tr> 
                                            <tr>
                                                <td width="10%"><label><?php echo __('Facturado') ?></label></td>
                                                <td><?php echo $form['formation'] ?></td>
                                            </tr> 
                                            <tr><td style="height: 15px;"></td></tr>
                                            <tr>
                                                <td width="20%"><label><b><?php echo __('Patentes') ?></b></label></td>
                                            </tr>
                                            <tr>
                                                <td width="10%"><label><?php echo __('Estimado') ?></label></td>
                                                <td><?php echo $form['total_patents'] ?></td>
                                            </tr> 
                                            <tr>
                                                <td width="10%"><label><?php echo __('Facturado') ?></label></td>
                                                <td><?php echo $form['patents'] ?></td>
                                            </tr> 
                                       </table>       
                                    </td>
                                    <td>
                                       <?php if($id): ?> 
                                            <div id="chart_div" style="width: 550px; height: 250px;"></div> 
                                       <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                        <div style="padding-top:10px;" class="botonera">
				<input type="button" onclick="document.location='<?php echo url_for($str_module.'/index') ?>';" value="<?php echo __('Cancel') ?>" class="boton" />
				<input type="submit" name="btn_action" value="<?php echo __('Register') ?>" class="boton" id="btn_action"/>
                                <?php echo $form->renderHiddenFields() ?>
			</div>
                </form>
	</div>
	<div class="clear"></div>
</div>    