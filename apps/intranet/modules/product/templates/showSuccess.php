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
			<a href="<?php echo url_for('product/index') ?>"><strong><?php echo __('Productos') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo $oValue->getName() ?>
		</div>
		<h1 class="titulos"><?php echo $oValue->getName() ?></h1>
                <h6 class="titulos" style=" color: #1B6577"><?php echo Common::getFormattedDate($oValue->getCreatedAt(),'d/m/Y') ?></h6>
                <?php if($company): ?>
                <fieldset>
                    <legend>Empresas</legend>
                    <table width="100%" cellspacing="4" cellpadding="2" border="0">
                            <?php foreach ($company as $value): ?> 
                            <tr>
                                <td class="text_detail"><?php echo $value->getRegisteredCompanies()->getName(); ?> <?php if($value->getRegisteredCompanies()->getTypeCompaniesId()==1): ?> (Participada)<?php endif; ?></td>
                            </tr>
                            <?php endforeach; ?>
                    </table>
		</fieldset>
                <?php endif; ?>
		<?php if($oValue->getDescription()): ?>
                <fieldset>
			<table width="100%" cellspacing="4" cellpadding="2" border="0">
                                <tr>
                                    <td class="text_detail"><?php echo html_entity_decode($oValue->getDescription()) ?></td>
				</tr>
			</table>
		</fieldset>
                <?php endif; ?>
		<div style="padding-top:10px;" class="botonera">
                     <?php if($sf_user->hasCredential('super_admin')): ?> 
			<input type="button" onclick="document.location='<?php echo url_for('product/edit?id='.$oValue->getId()) ?>';" value="<?php echo __('Edit') ?>" class="boton" />
                     <?php endif; ?>   
			<input type="button" onclick="document.location='<?php echo url_for('product/index') ?>';" value="<?php echo __('Continue to list') ?>" class="boton" />
		</div>
	</div>
	<div class="clear"></div>
</div>