<div class="content">
	<div class="rightside">
		<div class="paneles" style="text-align:center;">
			<img src="/<?php echo $oValue->getPhoto() ? 'uploads/user/'.$oValue->getPhoto() : 'images/no_user_b.jpg' ?>" border="0"/>
		</div>
	</div>
	<div class="leftside" style="margin-left:260px;">
		<div class="mapa">
			<a href="<?php echo url_for('@homepage') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('@user') ?>"><strong><?php echo __('User') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __('Detail') ?>
		</div>
		<h1 class="titulos">
                    <?php echo $oValue->getTitle() ?> <?php echo $oValue->getName() ?> <?php echo $oValue->getLastName() ?>  
                </h1><br />
		<fieldset>
			<table width="100%" cellspacing="4" cellpadding="2" border="0">
				<tr>
					<td width="14%"><label><strong><?php echo __('User role') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo __($oValue->UserRole->getName()) ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('Email') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getEmail() ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('Phone') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getPhone() ?></td>
				</tr>
                                <tr>
					<td><label><strong><?php echo __('Skype') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getSkype() ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('Enabled') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getEnabled() ? __('Yes') : __('No') ?></td>
				</tr>
			</table>
		</fieldset>
                <?php if($oValue->getUserRoleId()== 4): ?> 
                <fieldset>
                    <legend>&nbsp;<?php echo __('Socios Empresa') ?>&nbsp;</legend>
                    <table width="100%" cellspacing="4" cellpadding="0" border="0">
                        <tr>
                            <td width="14%"><label><strong><?php echo __('Job Title') ?>&nbsp;:&nbsp;</strong></label></td>
                            <td class="text_detail"><?php echo $oValue->getJobTitle() ?></td>
                        </tr>
                        <tr>
                            <td><label><strong><?php echo __('Fuente') ?>&nbsp;:&nbsp;</strong></label></td>
                            <td class="text_detail"><?php echo $oValue->getSource() ?></td>
                        </tr>
                        <tr>
                            <?php $_img_user = $oValue->getAppUser()->getPhoto()? 'uploads/user/'.ServiceFileHandler::getThumbImage($oValue->getAppUser()->getPhoto()) : 'images/no_user.jpg'; ?>
                            <td><label><strong><?php echo __('Contact From') ?>&nbsp;:&nbsp;</strong></label></td>
                            <td class="text_detail">
                                <img src="/<?php echo $_img_user ?>" width="20" height="20" alt="User" border="0" style="vertical-align: middle"/>
                                &nbsp;&nbsp;&nbsp;
                                <?php echo $oValue->getAppUser()->getTitle().' '.$oValue->getAppUser()->getName().' '.$oValue->getAppUser()->getLastName() ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label><strong><?php echo __('Contact Company') ?>&nbsp;:&nbsp;</strong></label></td>
                            <td class="text_detail"><?php echo $oValue->getRegisteredCompanies()->getName() ?></td>
                        </tr>
                    </table>
                </fieldset>
                <?php endif; ?>  
                <fieldset>
                    <legend>&nbsp;<?php echo __('Schedule') ?>&nbsp;</legend>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="padding-right: 30px;"><label><strong><?php echo __('Contact Time From') ?>&nbsp;:&nbsp;</strong></label></td>
                            <td class="text_detail"><?php echo $oValue->getContactTimeFrom()?></td>
                        </tr>
                        <tr><td colspan="3" style="height: 15px;"></td></tr>
                        <tr>
                            <td><label><strong><?php echo __('Contact Time To') ?>&nbsp;:&nbsp;</strong></label></td>
                            <td class="text_detail"><?php echo $oValue->getContactTimeTo() ?></td>
                        </tr>
                    </table>
                </fieldset>
		<div style="padding-top:10px;" class="botonera">
			<input type="button" onclick="document.location='<?php echo url_for('@user-edit?id='.$id) ?>';" value="<?php echo __('Edit') ?>" class="boton" />
			<input type="button" onclick="document.location='<?php echo url_for('@user') ?>';" value="<?php echo __('Continue to list') ?>" class="boton" />
		</div>
	</div>
	<div class="clear"></div>
</div>