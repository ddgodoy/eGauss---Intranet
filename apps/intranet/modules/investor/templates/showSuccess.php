<script type="text/javascript">
$(document).ready(function(){
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
            <div class="paneles" id="conten-calendar">
                <?php include_component('calendar', 'calendar') ?>
            </div>
            <div class="paneles">
                <h1>Socio</h1> 
                <table width="100%" border="0" cellpadding="0" cellspacing="3">
                  <?php $_img_user = $oValue->getAppUser()->getPhoto()? 'uploads/user/'.ServiceFileHandler::getThumbImage($oValue->getAppUser()->getPhoto()) : 'images/no_user.jpg'; ?>
                  <tr>
                    <td class="fancybox-manual-b" id="<?php echo $oValue->getAppUser()->getId() ?>" style="cursor: pointer">
                      <img src="/<?php echo $_img_user ?>" width="20" height="20" alt="User" border="0" style="vertical-align: middle"/>
                      &nbsp;&nbsp;&nbsp;
                      <?php echo $oValue->getAppUser()->getName().' '.$oValue->getAppUser()->getLastName() ?>
                    </td>
                  </tr>
                </table>
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
					<td width="20%"><label><strong><?php echo __('Nombre') ?>:</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getName().' '.$oValue->getLastName(); ?></td>
				</tr>
                                <tr><td style="height: 5px;"></td></tr>
				<tr>
					<td width="20%"><label><strong><?php echo __('Teléfono') ?>:</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getPhone(); ?></td>
				</tr>
                                <tr><td style="height: 5px;"></td></tr>
				<tr>
					<td width="20%"><label><strong><?php echo __('Email') ?>:</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getEmail(); ?></td>
				</tr>
                                <tr><td style="height: 5px;"></td></tr>
                                <tr>
					<td width="20%"><label><strong><?php echo __('Web personal') ?>:</strong></label></td>
					<td class="text_detail"><a href="<?php echo $oValue->getWebPersonal(); ?>" target="_black"><?php echo $oValue->getWebPersonal(); ?></a></td>
				</tr>
			</table>
		</fieldset>
		<fieldset style="margin-top:20px;">
			<legend style="padding:0px 10px 0px 10px;">Datos de la empresa</legend>
			<table width="100%" cellspacing="4" cellpadding="0" border="0">
				<tr>
					<td width="20%"><label><strong><?php echo __('Nombre') ?>:</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getCompany(); ?></td>
				</tr>
                                <tr><td style="height: 5px;"></td></tr>
				<tr>
					<td width="20%"><label><strong><?php echo __('Web') ?>:</strong></label></td>
                                        <td class="text_detail"><a href="<?php echo $oValue->getWebCompany(); ?>" target="_black"><?php echo $oValue->getWebCompany(); ?></a></td>
				</tr>
                                <tr><td style="height: 5px;"></td></tr>
				<tr>
					<td width="20%"><label><strong><?php echo __('Ciudad') ?>:</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getCity(); ?></td>
				</tr>
                                <tr><td style="height: 5px;"></td></tr>
                                <tr>
					<td width="20%"><label><strong><?php echo __('País, internacional') ?>:</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getCountry(); ?></td>
				</tr>
			</table>
		</fieldset>
		<fieldset style="margin-top:20px;">
			<legend style="padding:0px 10px 0px 10px;">Datos del Proyecto</legend>
			<table width="100%" cellspacing="4" cellpadding="0" border="0">
				<tr>
                                    <td width="20%"><label><strong><?php echo __('Proyecto') ?>:</strong></label></td>
                                    <td class="text_detail"><?php echo $oValue->getProject(); ?></td>
                                </tr>
                                <tr><td style="height: 5px;"></td></tr>
                                <tr>
                                    <td width="20%"><label><strong><?php echo __('TIC') ?>:</strong></label></td>
                                    <td class="text_detail"><?php echo $oValue->getTic()->getName(); ?></td>
                                </tr>
                                <tr><td style="height: 5px;"></td></tr>
                                <tr>
                                    <td width="20%"><label><strong><?php echo __('Tema general') ?>:</strong></label></td>
                                    <td class="text_detail"><?php echo $oValue->getGeneralTheme()->getName(); ?></td>
				</tr>
                                <tr><td style="height: 5px;"></td></tr>
                                <tr>
                                    <td width="20%"><label><strong><?php echo __('Tema') ?>:</strong></label></td>
                                    <td class="text_detail"><?php echo $oValue->getTheme()->getName(); ?></td>
				</tr>
                                <tr><td style="height: 5px;"></td></tr>
                                <tr>
                                    <td width="20%"><label><strong><?php echo __('Sub tema') ?>:</strong></label></td>
                                    <td class="text_detail"><?php echo $oValue->getSubTheme(); ?></td>
				</tr>
                                <tr><td style="height: 5px;"></td></tr>
                                <tr>
                                    <td width="20%"><label><strong><?php echo __('Acreditado') ?>:</strong></label></td>
                                    <td class="text_detail"><?php echo $oValue->getAccreditedEnisa()==1?'Enisa':''; ?></td>
				</tr>
                                <tr><td style="height: 5px;"></td></tr>
                                <tr>
                                    <td width="20%"><label><strong><?php echo __('Tipo de inversor') ?>:</strong></label></td>
                                    <td class="text_detail"><?php echo $oValue->getTypeOfInvestor()->getName(); ?></td>
				</tr>
                                <tr><td style="height: 5px;"></td></tr>
                                <tr>
                                    <td width="20%"><label><strong><?php echo __('Inversión desde') ?>:</strong></label></td>
                                    <td class="text_detail"><?php echo $oValue->getInvestorFrom(); ?></td>
				</tr>
                                <tr><td style="height: 5px;"></td></tr>
                                <tr>
                                    <td width="20%"><label><strong><?php echo __('Inversión hasta') ?>:</strong></label></td>
                                    <td class="text_detail"><?php echo $oValue->getInvestorTo(); ?></td>
				</tr>
			</table>
		</fieldset>
                <?php if($oValue->getComment()): ?> 
                <fieldset style="margin-top:20px;">
			<legend style="padding:0px 10px 0px 10px;">Observación</legend>
                        <table width="100%" cellspacing="4" cellpadding="2" border="0">
                                <tr>
                                    <td class="text_detail"><?php echo html_entity_decode($oValue->getComment()) ?></td>
				</tr>
			</table>
                </fieldset>   
                <?php endif; ?>
		<div style="padding-top:10px;" class="botonera">
                        <?php /* if($sf_user->hasCredential('super_admin')): ?> 
                            <input type="button" onclick="document.location='<?php echo url_for('@investor-edit?id='.$id) ?>';" value="<?php echo __('Edit') ?>" class="boton" />
                        <?php endif; */ ?>
			<input type="button" onclick="document.location='<?php echo url_for('@investors') ?>';" value="<?php echo __('Continue to list') ?>" class="boton" />
		</div>
	</div>
	<div class="clear"></div>
</div>