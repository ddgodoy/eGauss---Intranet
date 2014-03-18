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
		<?php if ($form->hasErrors()): ?>
			<div class="mensajeSistema error">
				<ul>
					<?php foreach($form->getFormFieldSchema() as $name=>$formField) { if ($formField->getError()) { echo '<li>'.$formField->getError().'</li>'; } } ?>
				</ul>
			</div>
		<?php endif; ?>
		<form enctype="multipart/form-data" method="post" action="<?php echo url_for('@'.$str_module.'-'.$str_action.$request_id) ?>">
			<label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label><br />
			<fieldset>
				<legend style="padding:0px 10px 0px 10px;">Datos del inversor</legend>
				<table width="100%" cellspacing="4" cellpadding="0" border="0">
					<tr>
						<td width="15%"><label><?php echo __('Nombre') ?> *</label></td>
						<td><?php echo $form['name'] ?></td>
					</tr>
                                        <tr>
						<td width="15%"><label><?php echo __('Apellido') ?> *</label></td>
						<td><?php echo $form['last_name'] ?></td>
					</tr>
					<tr>
						<td><label><?php echo __('Teléfono') ?></label></td>
						<td><?php echo $form['phone'] ?></td>
					</tr>
					<tr>
						<td><label><?php echo __('Email') ?></label></td>
						<td><?php echo $form['email'] ?></td>
					</tr>
                                        <tr>
						<td><label><?php echo __('Web personal') ?></label></td>
						<td><?php echo $form['web_personal'] ?></td>
					</tr>
				</table>
			</fieldset>    
                        <fieldset style="margin-top:20px;" style="display: none">
				<legend style="padding:0px 10px 0px 10px;">Datos de la empresa</legend>
				<table width="100%" cellspacing="4" cellpadding="0" border="0">
					<tr>
						<td width="15%"><label><?php echo __('Nombre') ?> *</label></td>
						<td><?php echo $form['company'] ?></td>
					</tr>
					<tr>
						<td><label><?php echo __('Web') ?></label></td>
						<td><?php echo $form['web_company'] ?></td>
					</tr>
					<tr>
						<td><label><?php echo __('Ciudad') ?></label></td>
						<td><?php echo $form['city'] ?></td>
					</tr>
                                        <tr>
						<td><label><?php echo __('País, internacional') ?></label></td>
						<td><?php echo $form['country'] ?></td>
					</tr>
				</table>
			</fieldset>
			<fieldset style="margin-top:20px;">
				<legend style="padding:0px 10px 0px 10px;">Datos de la inversión</legend>
				<table width="100%" cellspacing="4" cellpadding="0" border="0">
					<tr>
						<td width="15%"><label><?php echo __('Date') ?> *</label></td>
						<td><?php echo $form['date'] ?></td>
					</tr>
                                        <tr>
						<td width="15%"><label><?php echo __('Proyecto') ?> *</label></td>
						<td><?php echo $form['project'] ?></td>
					</tr>
                                        <tr>
						<td width="15%"><label><?php echo __('TIC') ?></label></td>
						<td><?php echo $form['tic_id'] ?></td>
					</tr>
                                        <tr>
						<td width="15%"><label><?php echo __('Tema general') ?></label></td>
						<td><?php echo $form['general_theme_id'] ?></td>
					</tr>
                                        <tr>
						<td width="15%"><label><?php echo __('Tema') ?></label></td>
						<td><?php echo $form['theme_id'] ?></td>
					</tr>
                                        <tr>
						<td width="15%"><label><?php echo __('Sub tema') ?></label></td>
						<td><?php echo $form['sub_theme'] ?></td>
					</tr>
                                        <tr>
						<td width="15%"><label><?php echo __('Acreditado por Enisa') ?></label></td>
						<td><?php echo $form['accredited_enisa'] ?></td>
					</tr>
                                        <tr>
						<td width="15%"><label><?php echo __('Tipo de inversor') ?></label></td>
						<td><?php echo $form['type_of_investor_id'] ?></td>
					</tr>
                                        <tr>
						<td width="15%"><label><?php echo __('Inversión desde') ?></label></td>
						<td><?php echo $form['investor_from'] ?></td>
					</tr>
                                        <tr>
						<td width="15%"><label><?php echo __('Inversión desde') ?></label></td>
						<td><?php echo $form['investor_to'] ?></td>
					</tr>
                                        <tr>
						<td width="15%"><label><?php echo __('Socio') ?></label></td>
						<td><?php echo $form['app_user_id'] ?></td>
					</tr>
				</table>
			</fieldset>
                        <fieldset style="margin-top:20px;">
				<legend style="padding:0px 10px 0px 10px;">Observación</legend>
				<table width="100%" cellspacing="4" cellpadding="0" border="0">
                                    <tr>
                                        <td colspan="2"><?php echo $form['comment'] ?></td>
                                    </tr>
                                </table>
			</fieldset>    
			<div style="padding-top:10px;" class="botonera">
				<input type="button" onclick="document.location='<?php echo url_for('investors') ?>';" value="<?php echo __('Cancel') ?>" class="boton" />
                                <?php if($id): ?>
                                    <input type="button" onclick="document.location='<?php echo url_for('@'.$str_module.'-show?id='.$id) ?>';" value="<?php echo __('See') ?>" class="boton" />
                                <?php endif; ?>
				<input type="submit" name="btn_action" value="<?php echo __('Register') ?>" class="boton" />
			</div>
                        <?php echo $form->renderHiddenFields() ?>
		</form>
	</div>
	<div class="clear"></div>
</div>