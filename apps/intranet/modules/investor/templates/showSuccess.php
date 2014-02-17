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
			<?php echo __('Datos de la inversión') ?>
		</div>
		<h1 class="titulos"><?php echo __('Detalles de la inversión') ?></h1><br />
		<fieldset>
			<legend style="padding:0px 10px 0px 10px;">Datos del inversor</legend>
			<table width="100%" cellspacing="4" cellpadding="0" border="0">
				<tr>
					<td width="6%"><label><strong><?php echo __('Nombre') ?></strong></label></td>
					<td class="text_detail"><?php echo $oValue->getName(); ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('Teléfono') ?></strong></label></td>
					<td class="text_detail"><?php echo $oValue->getPhone(); ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('Dirección') ?></strong></label></td>
					<td class="text_detail"><?php echo $oValue->getAddress(); ?></td>
				</tr>
			</table>
		</fieldset>
		<fieldset style="margin-top:20px;">
			<legend style="padding:0px 10px 0px 10px;">Datos de la empresa</legend>
			<table width="100%" cellspacing="4" cellpadding="0" border="0">
				<tr>
					<td width="6%"><label><strong><?php echo __('Nombre') ?></strong></label></td>
					<td class="text_detail"><?php echo $oValue->getRegisteredCompanies()->getName(); ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('Sector') ?></strong></label></td>
					<td class="text_detail"><?php echo $oValue->getBusiness(); ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('Website') ?></strong></label></td>
					<td class="text_detail"><?php echo $oValue->getWebsite(); ?></td>
				</tr>
			</table>
		</fieldset>
		<fieldset style="margin-top:20px;">
			<legend style="padding:0px 10px 0px 10px;">Datos de la inversión</legend>
			<table width="100%" cellspacing="4" cellpadding="0" border="0">
				<tr>
					<td width="3%"><label><strong><?php echo __('Año') ?></strong></label></td>
					<td width="10%" class="text_detail"><?php echo $oValue->getYear(); ?></td>
					<td width="4%"><label><strong><?php echo __('Monto') ?></strong></label></td>
					<td width="10%" class="text_detail"><?php echo $oValue->getAmount(); ?></td>
					<td width="4%"><label><strong><?php echo __('Estado') ?></strong></label></td>
					<td class="text_detail"><?php echo $oValue->getEstado(); ?></td>
				</tr>
			</table>
		</fieldset>
		<div style="padding-top:10px;" class="botonera">
                        <?php if($sf_user->hasCredential('super_admin')): ?> 
                            <input type="button" onclick="document.location='<?php echo url_for('@investor-edit?id='.$id) ?>';" value="<?php echo __('Edit') ?>" class="boton" />
                        <?php endif; ?>
			<input type="button" onclick="document.location='<?php echo url_for('@investors') ?>';" value="<?php echo __('Continue to list') ?>" class="boton" />
		</div>
	</div>
	<div class="clear"></div>
</div>