<div class="content">
	<div class="rightside">
		<div class="paneles" style="text-align:center;">
			<img src="/<?php echo $oValue->getPhoto() ? 'uploads/user/'.$oValue->getPhoto() : 'images/no_user_b.jpg' ?>" border="0"/>
		</div>
	</div>
	<div class="leftside" style="margin-left:260px;">
                <h1 class="titulos"><?php echo $oValue->getTitle() ?> <?php echo $oValue->getName() ?> <?php echo $oValue->getLastName() ?></h1>
		<fieldset>
			<table width="100%" cellspacing="4" cellpadding="2" border="0">
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
			</table>
		</fieldset>
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
	</div>
	<div class="clear"></div>
</div>