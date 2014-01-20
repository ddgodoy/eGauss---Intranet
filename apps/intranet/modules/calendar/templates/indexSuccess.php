<?php
	$str_module = $sf_params->get('module');
	$index_url  = url_for($str_module.'/index');
	$head_link  = $index_url.'?page='.$iPage.$f_params;
?>
<div class="content">
  <div class="rightside">
    <div class="paneles" id="conten-calendar">
      <?php include_component('calendar', 'calendar') ?>
    </div>
  </div>
  <div class="leftside" style="margin-left:260px;">
  <div class="mapa">
		<a href="<?php echo url_for('@homepage') ?>"><strong><?php echo __('Home') ?></strong></a>&nbsp;&gt;&nbsp;<?php echo __('Evento') ?>
	</div>
  <h1 class="titulos">
  	<?php echo __('Lista de Eventos') ?>
        <?php if($sf_user->hasCredential('super_admin')): ?> 
            <input type="button" value="<?php echo __('Registrar Evento') ?>" style="float:right;" class="boton" onclick="document.location='<?php echo url_for('@'.$str_module.'-register?sch_year='.$sch_year.'&sch_month='.$sch_month.'&sch_day='.$sch_day) ?>';"/>
        <?php endif; ?>    
  </h1>
  	<?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order, 'oCant'=>$oCant)) ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="listados">
      <tr>
      	<?php if (count($oList) > 0): ?>
	        <th width="10%"><a><?php echo __('Date') ?></a></th>
                <th width="10%"><a href="<?php echo $head_link.'&o=hour_from&s='.$sort ?>"><?php echo __('Hora de inicio') ?></a></th>
                <th width="30%"><a href="<?php echo $head_link.'&o=subject&s='.$sort ?>"><?php echo __('Subject') ?></a></th>
                <th width="10%"><a href="<?php echo $head_link.'&o=subject&s='.$sort ?>"><?php echo __('Categoría') ?></a></th>
                <th width="5%"></th>
                <?php if($sf_user->hasCredential('super_admin')): ?>
	        <th width="5%"></th>
	        <th width="5%"></th>
                <?php endif; ?>
        <?php else: ?>
        	<th style="text-align:center;"><?php echo __('No results') ?></th>
        <?php endif; ?>
      </tr>
      <?php foreach ($oList as $item): ?>
      <tr class="<?php if (!empty($odd)) { echo 'gris'; $odd=0; } else { echo 'blanco'; $odd=1; } ?>">
        <td><?php echo $item->getDay().'/'.$item->getMonth().'/'.$item->getYear() ?></td>
        <td><?php echo $item->getHourFrom() ?></td>
        <td><?php echo $item->getSubject() ?></td>
        <td><?php echo $item->getTypeCalendar()->getName() ?></td>
        <td align="center">
                <?php $show_module = $item->getTypeCalendarId()==2?'shareholders': $str_module ?>
        	<a href="<?php echo url_for('@'.$show_module.'-show?id='.$item->getId().'&sch_year='.$sch_year.'&sch_month='.$sch_month.'&sch_day='.$sch_day) ?>">
        		<?php $src_img = $item->getTypeCalendarId()==2?'convocar.png':'calendario.gif'; ?>
                        <img src="/images/<?php echo $src_img ?>" border="0" alt="<?php echo __('See') ?>" title="<?php echo __('See') ?>"/>
        	</a>
        </td>
        <?php if($sf_user->hasCredential('super_admin')): ?>
        <td align="center">
        	<a href="<?php echo url_for('@'.$str_module.'-edit?id='.$item->getId().'&sch_year='.$sch_year.'&sch_month='.$sch_month.'&sch_day='.$sch_day) ?>">
        		<img border="0" src="/images/editar.png" alt="<?php echo __('Edit') ?>" title="<?php echo __('Edit') ?>">
        	</a>
        </td>
        <td align="center">
        	<a href="<?php echo url_for('@'.$str_module.'-delete?id='.$item->getId().'&sch_year='.$sch_year.'&sch_month='.$sch_month.'&sch_day='.$sch_day) ?>" onclick="return confirm('<?php echo __('Are you sure?') ?>');">
        		<img border="0" src="/images/borrar.png" alt="<?php echo __('Delete') ?>" title="<?php echo __('Delete') ?>">
        	</a>
        </td>
        <?php endif; ?>
      </tr>
      <?php endforeach; ?>
    </table>
    <?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order, 'oCant'=>$oCant)) ?>
  </div>
  <div class="clear"></div>
</div>