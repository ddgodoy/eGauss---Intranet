<div class="content">
        <?php if(!$is_iframe): ?>
        <div class="rightside">
            <div class="paneles" style="text-align: center">
                <img src="/images/company_logo.png" border="0" width="150" />
            </div>
            <div class="paneles" id="conten-calendar" >
              
              <?php include_component('calendar', 'calendar') ?>
              
            </div>
        </div>
        <?php endif; ?>
	<div class="leftside" <?php if(!$is_iframe): ?> style="margin-left:260px;"<?php endif; ?>>
                <?php if(!$is_iframe): ?>
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('calendar/index?sch_year='.$sch_year.'&sch_month='.$sch_month.'&sch_day='.$sch_day) ?>"><strong><?php echo __('Calendar') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __('Evento') ?>
		</div>
                <?php endif; ?>
		<h1 class="titulos"><?php echo $oValue->getSubject() ?></h1>
                <h6 class="titulos" style=" color: #1B6577"><?php echo sprintf("%02d",$oValue->getDay()).'/'.sprintf("%02d",$oValue->getMonth()).'/'.$oValue->getYear() ?>&nbsp;&nbsp;<?php echo $oValue->getHourFrom() ?> a <?php echo $oValue->getHourTo() ?></h6>
		<?php if($oValue->getBody()): ?>
                <fieldset>
			<table width="100%" cellspacing="4" cellpadding="2" border="0">
                                <tr>
                                    <td class="text_detail"><?php echo html_entity_decode($oValue->getBody()) ?></td>
				</tr>
			</table>
		</fieldset>
                <?php endif; ?>
                <?php if(!$is_iframe): ?>
		<div style="padding-top:10px;" class="botonera">
                     <?php if($sf_user->hasCredential('super_admin')): ?> 
			<input type="button" onclick="document.location='<?php echo url_for('calendar/edit?id='.$oValue->getId().'&sch_year='.$sch_year.'&sch_month='.$sch_month.'&sch_day='.$sch_day) ?>';" value="<?php echo __('Edit') ?>" class="boton" />
                     <?php endif; ?>   
			<input type="button" onclick="document.location='<?php echo url_for('@calendar_lista') ?>';" value="<?php echo __('Continue to list') ?>" class="boton" />
		</div>
                <?php endif; ?>
	</div>
	<div class="clear"></div>
</div>