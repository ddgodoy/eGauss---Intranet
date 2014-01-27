<div class="content">
        <div class="rightside">
            <div class="paneles" style="text-align:center;">
                <img src="/images/company_logo.png" border="0" width="150" height="150" title="eGauss Business Holding I+T" alt="eGauss Business Holding I+T"/><br/>
            </div>
            <div class="paneles" id="conten-calendar" >
              <?php include_component('calendar', 'calendar') ?>
            </div>
        </div>
	<div class="leftside" style="margin-left:260px;">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('contracts/index') ?>"><strong><?php echo __('Contratos de Intermediación') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo $oValue->getCustomer(); ?>
		</div>
		<h1 class="titulos"><?php echo $oValue->getCustomer() ?></h1>
                <h6 class="titulos" style=" color: #1B6577">Fecha de entrega:&nbsp;&nbsp;<?php echo sprintf("%02d",$oValue->getDay()).'/'.sprintf("%02d",$oValue->getMonth()).'/'.$oValue->getYear() ?></h6>
                <fieldset>
                    <table width="100%" cellspacing="4" cellpadding="2" border="0">
                        <tr>
                            <td width="12%"><label><b>Socio:</b></label></td>
                            <td class="text_detail"><?php echo $oValue->getAppUser()->getName().' '.$oValue->getAppUser()->getLastName() ?></td>
                        </tr>
                        <tr>
                            <td width="12%"><label><b>Volumen negocio:</b></label></td>
                            <td class="text_detail"><?php echo $oValue->getBusinessAmount() ?></td>
                        </tr>
                        <tr>
                            <td width="12%"><label><b>% Intermediacion:</b></label></td>
                            <td class="text_detail"><?php echo $oValue->getIntermediation() ?></td>
                        </tr>
                        <tr>
                            <td width="12%"><label><b>Comisión final:</b></label></td>
                            <td class="text_detail"><?php echo $oValue->getFinalCommission() ?></td>
                        </tr>
                            
                    </table>
                </fieldset>
		<?php if($oValue->getObservations()): ?>
                <fieldset>
			<table width="100%" cellspacing="4" cellpadding="2" border="0">
                                <tr>
                                    <td class="text_detail"><?php echo html_entity_decode($oValue->getObservations()) ?></td>
				</tr>
			</table>
		</fieldset>
                <?php endif; ?>
                <?php if($oValue->getComments()): ?>
                <fieldset>
                    <legend>Comentario</legend>
                    <table width="100%" cellspacing="4" cellpadding="0" border="0">
                        <tr>
                            <td><?php echo html_entity_decode($oValue->getComments()) ?></td>
                        </tr>
                    </table>
                </fieldset>
                <?php endif; ?>
		<div style="padding-top:10px;" class="botonera">
                     <?php if($sf_user->hasCredential('super_admin')): ?> 
			<input type="button" onclick="document.location='<?php echo url_for('contracts/edit?id='.$oValue->getId()) ?>';" value="<?php echo __('Edit') ?>" class="boton" />
                     <?php endif; ?>   
			<input type="button" onclick="document.location='<?php echo url_for('contracts/index') ?>';" value="<?php echo __('Continue to list') ?>" class="boton" />
		</div>
	</div>
	<div class="clear"></div>
</div>