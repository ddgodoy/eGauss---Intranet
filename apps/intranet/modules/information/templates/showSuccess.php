<div class="content">
        <div class="rightside">
            <div class="paneles" style="text-align:center;">
                <img src="/<?php echo $logo ? 'uploads/company/'.$logo : 'images/no_image.jpg' ?>" border="0" width="150" height="150" title="<?php echo $company->getName() ?>" alt="<?php echo $company->getName() ?>"/><br/>
            </div>
            <div class="paneles" id="conten-calendar" >
              <?php include_component('calendar', 'calendar') ?>
            </div>
        </div>
	<div class="leftside" style="margin-left:260px;">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('information/index') ?>"><strong><?php echo __('Información') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo $oValue->getTypeInformation()->getName(); ?>
		</div>
		<h1 class="titulos"><?php echo $oValue->getName() ?></h1>
                <h6 class="titulos" style=" color: #1B6577"><?php echo Common::getFormattedDate($oValue->getDate(),'d/m/Y') ?></h6>
		<?php if($oValue->getDescription()): ?>
                <fieldset>
			<table width="100%" cellspacing="4" cellpadding="2" border="0">
                                <tr>
                                    <td class="text_detail"><?php echo html_entity_decode($oValue->getDescription()) ?></td>
				</tr>
			</table>
		</fieldset>
                <?php endif; ?>
                <div id="videos">
                    <?php include_component('information', 'getVideosView') ?>
                </div>
                <div id="drive">
                    <?php include_component('information', 'getDocumentView') ?>
                </div>
		<div style="padding-top:10px;" class="botonera">
                     <?php if($sf_user->hasCredential('super_admin')): ?> 
			<input type="button" onclick="document.location='<?php echo url_for('information/edit?id='.$oValue->getId()) ?>';" value="<?php echo __('Edit') ?>" class="boton" />
                     <?php endif; ?>   
			<input type="button" onclick="document.location='<?php echo url_for('information/index') ?>';" value="<?php echo __('Continue to list') ?>" class="boton" />
		</div>
	</div>
	<div class="clear"></div>
</div>