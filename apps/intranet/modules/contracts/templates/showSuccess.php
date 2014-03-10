<script type="text/javascript">
$(document).ready(function()
{
//
  $(".fancybox-manual-b").click(function()
  {
    var id = $(this).attr('id');
    $.fancybox.open({
      href : '<?php echo url_for('@user-view?id=') ?>'+id,
      type : 'iframe',
      padding : 5
    });
  });
});
</script>
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
			<?php echo $oValue->getCustomerName(); ?>
		</div>
		<h1 class="titulos"><?php echo $oValue->getCustomerName() ?></h1>
                <h6 class="titulos" style=" color: #1B6577">Mes previsto de ingresos:&nbsp;&nbsp;<?php echo $month[$oValue->getMonth()].' -- '.$oValue->getYear() ?></h6>
                <fieldset>
                    <legend><?php echo __('Cliente') ?></legend>
                    <table width="100%" cellspacing="4" cellpadding="2" border="0">
                        <tr>
                            <td width="12%"><label><b><?php echo __('Company') ?>:</b></label></td>
                            <td class="text_detail"><?php echo $oValue->getCustomerCompany() ?></td>
                        </tr>
                        <tr>
                            <td width="12%"><label><b><?php echo __('Puesto') ?>:</b></label></td>
                            <td class="text_detail"><?php echo $oValue->getCustomerWorkstation() ?></td>
                        </tr>
                        <tr>
                            <td width="12%"><label><b><?php echo __('Email') ?>:</b></label></td>
                            <td class="text_detail"><?php echo $oValue->getCustomerEmail() ?></td>
                        </tr>
                        <tr>
                            <td width="12%"><label><b><?php echo __('Phone') ?>:</b></label></td>
                            <td class="text_detail"><?php echo $oValue->getCustomerPhone() ?></td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset>
                    <legend><?php echo __('Datos de la empresa') ?></legend>
                    <table width="100%" cellspacing="4" cellpadding="2" border="0">
                        <?php if($oValue->getRegisteredCompaniesId()): ?>
                        <?php $partners_company = AppUserRegisteredCompaniesTable::getInstance()->findByRegisteredCompaniesId($oValue->getRegisteredCompaniesId()); ?>
                        <tr>
                            <td width="20%"><label><b><?php echo __('Name') ?>:</b></label></td>
                            <td class="text_detail"><?php echo $oValue->getRegisteredCompanies()->getName() ?> - (Participadas)</td>
                        </tr>
                        <tr>
                            <td width="20%"><label><b><?php echo __('Socios Responsables') ?>:</b></label></td>
                            <td class="text_detail">
                                <table width="100%" border="0" cellpadding="0" cellspacing="3">
                                    <?php foreach ($partners_company AS $p_value): ?>
                                    <?php $_img_user = $p_value->getAppUser()->getPhoto()? 'uploads/user/'.ServiceFileHandler::getThumbImage($p_value->getAppUser()->getPhoto()) : 'images/no_user.jpg'; ?>
                                    <tr>
                                      <td class="fancybox-manual-b" id="<?php echo $p_value->getAppUser()->getId() ?>" style="cursor: pointer">
                                        <img src="/<?php echo $_img_user ?>" width="20" height="20" alt="User" border="0" style="vertical-align: middle"/>
                                        &nbsp;&nbsp;&nbsp;
                                        <?php echo $p_value->getAppUser()->getName().' '.$p_value->getAppUser()->getLastName() ?>
                                      </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </table>
                            </td>
                        <tr>
                            <td width="20%"><label><b><?php echo __('Email') ?>:</b></label></td>
                            <td class="text_detail"><?php echo $oValue->getRegisteredCompanies()->getEmail() ?></td>
                        </tr>
                        <tr>
                            <td width="20%"><label><b><?php echo __('Phone') ?>:</b></label></td>
                            <td class="text_detail"><?php echo $oValue->getRegisteredCompanies()->getPhone() ?></td>
                        </tr>
                        </tr>
                        <?php else: ?>
                        <tr>
                            <td width="20%"><label><b><?php echo __('Name') ?>:</b></label></td>
                            <td class="text_detail"><?php echo $oValue->getCompanyName() ?></td>
                        </tr>
                        <tr>
                            <td width="20%"><label><b><?php echo __('Contact') ?>:</b></label></td>
                            <td class="text_detail"><?php echo $oValue->getCompanyContact() ?></td>
                        </tr>
                        <tr>
                            <td width="20%"><label><b><?php echo __('Email') ?>:</b></label></td>
                            <td class="text_detail"><?php echo $oValue->getCompanyEmail() ?></td>
                        </tr>
                        <tr>
                            <td width="20%"><label><b><?php echo __('Phone') ?>:</b></label></td>
                            <td class="text_detail"><?php echo $oValue->getCompanyPhone() ?></td>
                        </tr>
                        <?php endif; ?> 
                    </table>
                </fieldset>        
                <fieldset>
                    <legend><?php echo __('Contrato de Intermediación') ?></legend>
                    <table width="100%" cellspacing="4" cellpadding="2" border="0">
                        <tr>
                            <td width="12%"><label><b>Socio:</b></label></td>
                            <?php $_img_user_contract = $oValue->getAppUser()->getPhoto()? 'uploads/user/'.ServiceFileHandler::getThumbImage($oValue->getAppUser()->getPhoto()) : 'images/no_user.jpg'; ?>
                            <td class="fancybox-manual-b text_detail" id="<?php echo $oValue->getAppUser()->getId() ?>" style="cursor: pointer">
                            <img src="/<?php echo $_img_user_contract ?>" width="20" height="20" alt="User" border="0" style="vertical-align: middle"/>
                            &nbsp;&nbsp;&nbsp;
                            <?php echo $oValue->getAppUser()->getName().' '.$oValue->getAppUser()->getLastName() ?>
                            </td>
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
                <?php if(count($reunion_action)>0): ?>
                <fieldset>
                    <legend><?php echo __('Reuniones') ?></legend>
                    <div id="div-reunion">
                        <?php include_component('contracts', 'getReunionByContract') ?>
                    </div>
                 </fieldset>    
                <?php endif; ?>
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
                            <td class="text_detail"><?php echo html_entity_decode($oValue->getComments()) ?></td>
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