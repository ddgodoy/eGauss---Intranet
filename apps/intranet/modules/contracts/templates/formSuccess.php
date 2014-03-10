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
                            <fieldset style="margin-top:20px;">
                                <legend style="padding:0px 10px 0px 10px;">Empresa</legend>
                                <table width="20%" cellspacing="4" cellpadding="0" border="0">
                                    <tr>
                                        <td><input type="radio" style="vertical-align:middle;margin-left:10px;" value="1" <?php if($company == 1): ?> checked="checked" <?php endif; ?> class="checked-company" name="company"></td>
                                        <td><label><?php echo __('Participadas') ?></label></td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" style="vertical-align:middle;margin-left:10px;" value="2" <?php if($company == 2): ?> checked="checked" <?php endif; ?> name="company" class="checked-company"></td>
                                        <td><label><?php echo __('Company') ?></label></td>
                                    </tr>
                                </table>
                            </fieldset>    
                            <fieldset style="margin-top:20px;" style="display: none">
                                    <legend style="padding:0px 10px 0px 10px;">Datos de la empresa</legend>
                                    <table width="100%" cellspacing="4" cellpadding="0" border="0" id="select_company" <?php if($company == 2): ?> style="display: none" <?php endif; ?>>
                                            <tr>
                                                    <td width="19%"><label><?php echo __('Nombre') ?> *</label></td>
                                                    <td id="select_company">
                                                            <select class="form_input" name="empresa">
                                                                <?php echo Common::fillSimpleSelect(RegisteredCompaniesTable::getInstance()->getParticipadasForSelect(), $empresa); ?>
                                                            </select>
                                                    </td>
                                            </tr>
                                    </table>
                                    <table width="100%" cellspacing="4" cellpadding="0" border="0" id="input_company" <?php if($company == 1): ?> style="display: none" <?php endif; ?>>
                                        <tr>
                                                <td width="19%"><label><?php echo __('Name') ?> *</label></td>
                                                <td><?php echo $form['company_name'] ?></td>
                                        </tr>
                                        <tr>
                                                <td width="19%"><label><?php echo __('Contact') ?></label></td>
                                                <td><?php echo $form['company_contact'] ?></td>
                                        </tr>
                                        <tr>
                                                <td width="19%"><label><?php echo __('Email') ?></label></td>
                                                <td><?php echo $form['company_email'] ?></td>
                                        </tr>
                                        <tr>
                                                <td width="19%"><label><?php echo __('Phone') ?></label></td>
                                                <td><?php echo $form['company_phone'] ?></td>
                                        </tr>
                                    </table>
                            </fieldset>
                            <fieldset>
                                <legend><?php echo __('Cliente') ?></legend>
                                <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                    <tr>
                                        <td width="19%"><label><?php echo __('Name') ?> *</label></td>
                                        <td><?php echo $form['customer_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td width="19%"><label><?php echo __('Company') ?> </label></td>
                                        <td><?php echo $form['customer_company'] ?></td>
                                    </tr>
                                    <tr>
                                        <td width="19%"><label><?php echo __('Puesto') ?> </label></td>
                                        <td><?php echo $form['customer_workstation'] ?></td>
                                    </tr>
                                    <tr>
                                        <td width="19%"><label><?php echo __('Email') ?> </label></td>
                                        <td><?php echo $form['customer_email'] ?></td>
                                    </tr>
                                    <tr>
                                        <td width="19%"><label><?php echo __('Phone') ?> </label></td>
                                        <td><?php echo $form['customer_phone'] ?></td>
                                    </tr>
                                </table>
                            </fieldset>
                            <fieldset>
                                <legend><?php echo __('Contrato de Intermediación') ?></legend>
                                    <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                        <tr>
                                                <td width="20%"><label><?php echo __('Mes previsto de ingresos') ?> *</label></td>
                                                <td><?php echo $form['month'] ?>&nbsp;/&nbsp;<?php echo $form['year'] ?></td>
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
                                </fieldset>
                                <fieldset>
                                    <legend><?php echo __('Reuniones') ?></legend>
                                    <div id="div-reunion">
                                        <?php include_component('contracts', 'getReunionByContract') ?>
                                    </div>
                                    <div>
                                        <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                            <tr>
                                                <td width="20%"><label><?php echo __('Date') ?> *</label></td>
                                                <td><?php echo $form['date'] ?></td>
                                            </tr>
                                            <tr><td style="height: 15px;"></td></tr>
                                            <tr>
                                                <td colspan="2"><?php echo $form['comments_reunion'] ?></td>
                                            </tr>
                                        </table>  
                                    </div>
                                </fieldset>    
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