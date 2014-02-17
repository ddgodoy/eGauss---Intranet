<script type="text/javascript">
$(document).ready(function(){
    $(".checked-company").click(function(){
        var value   = $(this).val();
        if(value == 1){
            $("#select_company").show();
            $("#input_company").hide();
        }else{
            $("#select_company").hide();
            $("#input_company").show();
        }
    });
});
</script>
<?php
	$str_module = $sf_params->get('module');
	$str_action = $sf_params->get('action');
	$request_id = $id ?  "?id=$id" : '';
?>
<div class="content">
        <div class="rightside">
            <div class="paneles" id="conten-calendar">
                <?php include_component('calendar', 'calendar') ?>
            </div> 
        </div>
	<div class="leftside" style="margin-left:260px;">
		<div class="mapa">
			<a href="<?php echo url_for('@homepage') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('@investors') ?>"><strong><?php echo __('Inversores') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __(ucfirst($str_action)) ?>
		</div>
		<h1 class="titulos">
			<?php echo __(ucfirst($str_action)).' '.__('Inversor') ?>
		</h1>
		<?php if (count($error) > 0): ?>
			<div class="mensajeSistema error">
				<ul><?php foreach ($error as $e): ?><li><?php echo __($e, NULL, 'errors') ?></li><?php endforeach; ?></ul>
			</div>
		<?php endif; ?>
		<form enctype="multipart/form-data" method="post" action="<?php echo url_for('@'.$str_module.'-'.$str_action.$request_id) ?>">
			<label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label><br />
			<fieldset>
				<legend style="padding:0px 10px 0px 10px;">Datos del inversor</legend>
				<table width="100%" cellspacing="4" cellpadding="0" border="0">
					<tr>
						<td width="6%"><label><?php echo __('Nombre') ?> *</label></td>
						<td><input type="text" class="form_input" name="name" value="<?php echo $name ?>" style="width:600px;" /></td>
					</tr>
					<tr>
						<td><label><?php echo __('Teléfono') ?> *</label></td>
						<td><input type="text" class="form_input" name="phone" value="<?php echo $phone ?>" style="width:600px;" /></td>
					</tr>
					<tr>
						<td><label><?php echo __('Dirección') ?></label></td>
						<td><input type="text" class="form_input" name="address" value="<?php echo $address ?>" style="width:600px;" /></td>
					</tr>
				</table>
			</fieldset>
                        <fieldset style="margin-top:20px;">
                            <legend style="padding:0px 10px 0px 10px;">Empresa</legend>
                            <table width="20%" cellspacing="4" cellpadding="0" border="0">
                                <tr>
                                    <td><input type="radio" style="vertical-align:middle;margin-left:10px;" value="1" <?php if($investor == 1): ?> checked="checked" <?php endif; ?> class="checked-company" name="investor"></td>
                                    <td><label><?php echo __('Participadas') ?></label></td>
                                </tr>
                                <tr>
                                    <td><input type="radio" style="vertical-align:middle;margin-left:10px;" value="2" <?php if($investor == 2): ?> checked="checked" <?php endif; ?> name="investor" class="checked-company"></td>
                                    <td><label><?php echo __('Inversión') ?></label></td>
                                </tr>
                            </table>
                        </fieldset>    
                        <fieldset style="margin-top:20px;" style="display: none">
				<legend style="padding:0px 10px 0px 10px;">Datos de la empresa</legend>
				<table width="100%" cellspacing="4" cellpadding="0" border="0">
					<tr>
						<td width="6%"><label><?php echo __('Nombre') ?> *</label></td>
						<td id="select_company" <?php if($investor == 2): ?> style="display: none" <?php endif; ?>>
							<select class="form_input" name="empresa">
                                                            <?php echo Common::fillSimpleSelect(RegisteredCompaniesTable::getInstance()->getParticipadasForSelect(), $empresa); ?>
							</select>
						</td>
                                                <td id="input_company" <?php if($investor == 1): ?> style="display: none" <?php endif; ?> >
                                                    <input type="text" class="form_input" name="name_company" value="<?php echo $name_company ?>" style="width:600px;" />
                                                    <?php if($investor == 2): ?> <input type="hidden" name="empresa_new" value="<?php echo  $empresa ?>" /><?php endif; ?>
						</td>
					</tr>
					<tr>
						<td><label><?php echo __('Sector') ?></label></td>
						<td><input type="text" class="form_input" name="sector" value="<?php echo $sector ?>" style="width:600px;" /></td>
					</tr>
					<tr>
						<td><label><?php echo __('Website') ?></label></td>
						<td><input type="text" class="form_input" name="website" value="<?php echo $website ?>" style="width:600px;" /></td>
					</tr>
				</table>
			</fieldset>
			<fieldset style="margin-top:20px;">
				<legend style="padding:0px 10px 0px 10px;">Datos de la inversión</legend>
				<table width="100%" cellspacing="4" cellpadding="0" border="0">
					<tr>
						<td width="4%">&nbsp;</td>
						<td width="3%"><label><?php echo __('Año') ?></label></td>
						<td width="15%"><input type="text" class="form_input" name="year" value="<?php echo $year ?>" style="width:50px;" /></td>
						<td width="4%"><label><?php echo __('Monto') ?></label></td>
						<td width="15%"><input type="text" class="form_input" name="amount" value="<?php echo $amount ?>" style="width:80px;text-align:right;" /></td>
						<td width="4%"><label><?php echo __('Estado') ?></label></td>
						<td>
							<select class="form_input" name="estado">
								<option value="pendiente"<?php if ($estado=='pendiente') { echo 'selected'; } ?>>Pendiente</option>
								<option value="inversor"<?php if ($estado=='inversor') { echo 'selected'; } ?>>Inversor</option>
								<option value="descartado"<?php if ($estado=='descartado') { echo 'selected'; } ?>>Descartado</option>
							</select>
						</td>
					</tr>
				</table>
			</fieldset>
			<div style="padding-top:10px;" class="botonera">
				<input type="button" onclick="document.location='<?php echo url_for('investors') ?>';" value="<?php echo __('Cancel') ?>" class="boton" />
				<input type="submit" name="btn_action" value="<?php echo __('Register') ?>" class="boton" />
			</div>
		</form>
	</div>
	<div class="clear"></div>
</div>