<div class="content">
        <div class="rightside">           
            <div class="paneles" id="conten-calendar" >
              <?php include_component('calendar', 'calendar') ?>
            </div>
        </div>
	<div class="leftside" style="margin-left:260px;">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('entrepreneur/index') ?>"><strong><?php echo __('Emprendedores') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo $oValue->getName().' '.$oValue->getLastName(); ?>
		</div>
		<h1 class="titulos"><?php echo $oValue->getName().' '.$oValue->getLastName(); ?></h1>
                <h6 class="titulos" style=" color: #1B6577">Año: <?php echo $oValue->getYearOne() ?><?php $oValue->getYearTwo()?' - '.$oValue->getYearTwo():'' ?></h6>
                <fieldset>
			<table width="100%" cellspacing="4" cellpadding="2" border="0">
                                <tr>
                                    <td width="20%"><label><b><?php echo __('Sexo') ?>:</b></label></td>
                                    <td class="text_detail"><?php echo $oValue->getSex()=='m'?'Masculino':'Femenino' ?></td>
				</tr>
                                <tr>
                                    <td width="20%"><label><b><?php echo __('País, internacional') ?>:</b></label></td>
                                    <td class="text_detail"><?php echo $oValue->getCountry()?$oValue->getCountry():'---' ?></td>
				</tr>
                                <tr>
                                    <td width="12%"><label><b><?php echo __('Phone') ?>:</b></label></td>
                                    <td class="text_detail"><?php echo $oValue->getPhone()?$oValue->getPhone():'---' ?></td>
				</tr>
                                <tr>
                                    <td width="12%"><label><b><?php echo __('Email') ?>:</b></label></td>
                                    <td class="text_detail"><?php echo $oValue->getEmail()?$oValue->getEmail():'---' ?></td>
				</tr>
                                <tr>
                                    <td width="12%"><label><b><?php echo __('Linkedin') ?>:</b></label></td>
                                    <td class="text_detail"><?php if($oValue->getLinkedin()): ?><a href="<?php echo $oValue->getLinkedin() ?>" target="_blanck"><?php echo $oValue->getLinkedin() ?></a><?php else: ?> --- <?php endif; ?></td>
				</tr>
                                <tr>
                                    <td width="12%"><label><b><?php echo __('Website') ?>:</b></label></td>
                                    <td class="text_detail"><?php if($oValue->getWebPersonal()): ?><a href="<?php echo $oValue->getWebPersonal() ?>" target="_blanck"><?php echo $oValue->getWebPersonal() ?></a><?php else: ?> --- <?php endif; ?></td>
				</tr>
                                <tr>
                                    <td width="12%"><label><b><?php echo __('Puesto en la empresa') ?>:</b></label></td>
                                    <td class="text_detail"><?php if($oValue->getWorkstation()): ?><a href="<?php echo $oValue->getWorkstation() ?>" target="_blanck"><?php echo $oValue->getWorkstation() ?></a><?php else: ?> --- <?php endif; ?></td>
				</tr>
                                <tr>
                                    <td width="12%"><label><b><?php echo __('Sector') ?>:</b></label></td>
                                    <td class="text_detail"><?php echo $oValue->getSector()?$oValue->getSector():'---' ?></td>
				</tr>
                                <tr>
                                    <td width="12%"><label><b><?php echo __('Twitter') ?>:</b></label></td>
                                    <td class="text_detail"><?php if($oValue->getTwitter()): ?><a href="<?php echo $oValue->getTwitter() ?>" target="_blanck"><?php echo $oValue->getTwitter() ?></a><?php else: ?> --- <?php endif; ?></td>
				</tr>
                                <tr>
                                    <td width="12%"><label><b><?php echo __('Facebook') ?>:</b></label></td>
                                    <td class="text_detail"><?php if($oValue->getFacebook()): ?><a href="<?php echo $oValue->getFacebook() ?>" target="_blanck"><?php echo $oValue->getFacebook() ?></a><?php else: ?> --- <?php endif; ?></td>
				</tr>
                                <tr>
                                    <td width="12%"><label><b><?php echo __('Fuente') ?>:</b></label></td>
                                    <td class="text_detail"><?php if($oValue->getSource()): ?><a href="<?php echo $oValue->getSource() ?>" target="_blanck"><?php echo $oValue->getSource() ?></a><?php else: ?> --- <?php endif; ?></td>
				</tr>
                                <tr>
                                    <td width="12%"><label><b><?php echo __('Otros sitios de interés') ?>:</b></label></td>
                                    <td class="text_detail"><?php if($oValue->getOtherSitesInterest()): ?><a href="<?php echo $oValue->getOtherSitesInterest() ?>" target="_blanck"><?php echo $oValue->getOtherSitesInterest() ?></a><?php else: ?> --- <?php endif; ?></td>
				</tr>
                                <tr>
                                    <td width="12%"><label><b><?php echo __('Nombre Proyecto') ?>:</b></label></td>
                                    <td class="text_detail"><?php echo $oValue->getProjectName()?$oValue->getProjectName():'---' ?></td>
				</tr>
			</table>
		</fieldset>
                <?php if($oValue->getProject()): ?>
                <fieldset>
                    <legend>&nbsp;<?php echo __('Proyectos') ?>&nbsp;</legend>
                    <table width="100%" cellspacing="4" cellpadding="0" border="0">
                        <tr>
                          <td class="text_detail"><?php echo html_entity_decode($oValue->getProject()) ?></td>
                        </tr>
                    </table>
                </fieldset>
                <?php endif; ?>
                <?php if($oValue->getCapital()): ?>
                <fieldset>
                    <legend>&nbsp;<?php echo __('Ampliación de capital') ?>&nbsp;</legend>
                    <table width="100%" cellspacing="4" cellpadding="0" border="0">
                        <tr>
                          <td class="text_detail"><?php echo html_entity_decode($oValue->getCommentsCapital()) ?></td>
                        </tr>
                    </table>
                </fieldset>
                <?php endif; ?>
                <?php if($oValue->getCourses()): ?>
                <fieldset>
                    <legend>&nbsp;<?php echo __('Cursos eGauss') ?>&nbsp;</legend>
                    <table width="100%" cellspacing="4" cellpadding="0" border="0">
                        <tr>
                          <td class="text_detail"><?php echo html_entity_decode($oValue->getCommentsCourses()) ?></td>
                        </tr>
                    </table>
                </fieldset>
                <?php endif; ?>
                <div id="videos">
                    <?php include_component('entrepreneur', 'getVideosView') ?>
                </div>
                <div id="drive">
                    <?php include_component('entrepreneur', 'getDocumentView') ?>
                </div>
                <?php if($oValue->getComments()): ?>
                <fieldset>
			<table width="100%" cellspacing="4" cellpadding="2" border="0">
                                <tr>
                                    <td class="text_detail"><?php echo html_entity_decode($oValue->getComments()) ?></td>
				</tr>
			</table>
		</fieldset>
                <?php endif; ?>
		<div style="padding-top:10px;" class="botonera">
                     <?php if($sf_user->hasCredential('super_admin')): ?> 
			<input type="button" onclick="document.location='<?php echo url_for('entrepreneur/edit?id='.$oValue->getId()) ?>';" value="<?php echo __('Edit') ?>" class="boton" />
                     <?php endif; ?>   
			<input type="button" onclick="document.location='<?php echo url_for('entrepreneur/index') ?>';" value="<?php echo __('Continue to list') ?>" class="boton" />
		</div>
	</div>
	<div class="clear"></div>
</div>