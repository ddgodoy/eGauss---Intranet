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
			<a href="<?php echo url_for('contracts/index') ?>"><strong><?php echo __('Contratos de Intermediación') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __(ucfirst($str_action)) ?>
		</div>
		<?php if ($form->hasErrors()): ?>
			<div class="mensajeSistema error">
				<ul>
					<?php foreach($form->getFormFieldSchema() as $name=>$formField) { if ($formField->getError()) { echo '<li>'.$formField->getError().'</li>'; } } ?>
				</ul>
			</div>
		<?php endif; ?>
		<h1 class="titulos">
			<?php echo __(ucfirst($str_action)).' '.__('Contratos de Intermediación') ?>
		</h1>
		<form enctype="multipart/form-data" method="post" action="<?php echo url_for('@'.$str_module.'-'.$str_action.$request_id) ?>">
                    <label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label><br />
			<fieldset>
                            <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                    <tr>
                                            <td width="20%"><label><?php echo __('Fecha de entrega') ?> *</label></td>
                                            <td><?php echo $form['date'] ?></td>
                                    </tr>
                                    <tr>
                                            <td width="20%"><label><?php echo __('Cliente') ?> *</label></td>
                                            <td><?php echo $form['customer'] ?></td>
                                    </tr>
                                    <tr>
                                            <td width="20%"><label><?php echo __('Socio') ?> *</label></td>
                                            <td><?php echo $form['app_user_id'] ?></td>
                                    </tr>
                                    <tr>
                                            <td width="20%"><label><?php echo __('Volumen negocio') ?> *</label></td>
                                            <td><?php echo $form['business_amount'] ?></td>
                                    </tr>
                                    <tr>
                                            <td width="20%"><label><?php echo __('% Intermediacion') ?> *</label></td>
                                            <td><?php echo $form['intermediation'] ?></td>
                                    </tr>
                                    <tr>
                                            <td width="10%"><label><?php echo __('Comisión final') ?> *</label></td>
                                            <td><?php echo $form['final_commission'] ?></td>
                                    </tr>
                                </table>
                                <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                <tr><td style="height: 15px;"></td></tr>
                                <tr>
                                    <td colspan="2">
                                        <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                            <tr>
                                                <td><?php echo $form['observations'] ?></td>
                                            </tr>    
                                        </table>
                                    </td>
                                </tr>   
                                </table>
                                <?php if($sf_user->getAttribute('user_id') == 1): ?>
                                <fieldset>
                                    <legend>Comentario</legend>
                                    <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                        <tr>
                                            <td><?php echo $form['comments'] ?></td>
                                        </tr>
                                    </table>
                                </fieldset>
                                <?php endif; ?>
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