<?php
	$str_module = $sf_params->get('module');
	$index_url  = url_for($str_module.'/index');
	$head_link  = $index_url.'?page='.$iPage.$f_params;
?>
<div class="content">
  <div class="rightside">
    <div class="paneles">
      <form action="<?php echo $index_url ?>" enctype="multipart/form-data" method="post">
        <table cellspacing="4" cellpadding="0" border="0" width="100%">
            <tr><td>Por Mes</td></tr>
            <tr><td><?php echo select_tag('sch_month', options_for_select($month, $sch_month), array('style'=>'width:100%')) ?></td></tr>
            <tr><td>Por Tema</td></tr>
            <tr><td><input type="text" name="sch_name" value="<?php echo $sch_name ?>" class="form_input" style="width:98%;"/></td></tr>
            <tr><td style="padding-top:5px;"><input type="submit" name="btn_buscar" value="Buscar" class="boton"></td></tr>
        </table>
      </form>
      <div id="conten-calendar">
            <?php include_component('calendar', 'calendar') ?>
      </div>   
    </div>
  </div>
  <div class="leftside" style="margin-left:260px;">
  <div class="mapa">
		<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>&nbsp;&gt;&nbsp;<?php echo __('Juntas de Accionistas') ?>
	</div>
  <h1 class="titulos">
  	<?php echo __('Lista de Junta de Accionistas') ?>
        <?php if($sf_user->hasCredential('super_admin')): ?> 
  	<input type="button" value="<?php echo __('Registrar Juntas de Accionistas') ?>" style="float:right;" class="boton" onclick="document.location='<?php echo url_for($str_module.'-register') ?>';"/>
        <?php endif; ?>
  </h1>
  	<?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order, 'oCant'=>$oCant)) ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="listados">
      <tr>
      	<?php if (count($oList) > 0): ?>
                <th width="23%"><a href="<?php echo $head_link.'&o=date&s='.$sort ?>"><?php echo __('Date') ?></a></th>
	        <th width="23%"><a href="<?php echo $head_link.'&o=subject&s='.$sort ?>"><?php echo __('Subject') ?></a></th>
                <th width="23%"><a href="<?php echo $head_link.'&o=hour_from&s='.$sort ?>"><?php echo __('Hora') ?></a></th>
                <th width="4%"></th>
                <?php if($sf_user->hasCredential('super_admin')): ?>
	        <th width="4%"></th>
	        <th width="4%"></th>
                <?php endif; ?>
        <?php else: ?>
        	<th style="text-align:center;"><?php echo __('No results') ?></th>
        <?php endif; ?>
      </tr>
      <?php foreach ($oList as $item): ?>
      <tr class="<?php if (!empty($odd)) { echo 'gris'; $odd=0; } else { echo 'blanco'; $odd=1; } ?>">
        <td><?php echo sprintf("%02d",$item->getDay()).'/'.sprintf("%02d",$item->getMonth()).'/'.$item->getYear() ?></td>
        <td><?php echo $item->getSubject() ?></td>
        <td><?php echo $item->getHourFrom().' -- '.$item->getHourTo() ?></td>
        <td>
            <a href="<?php echo url_for('@'.$str_module.'-show?id='.$item->getId()) ?>">
                <img src="/images/convocar.png" border="0"/>
            </a>    
        </td>
        <?php if($sf_user->hasCredential('super_admin')): ?>
        <td align="center">
        	<a href="<?php echo url_for('@'.$str_module.'-edit?id='.$item->getId()) ?>">
        		<img border="0" src="/images/editar.png" alt="<?php echo __('Edit') ?>" title="<?php echo __('Edit') ?>">
        	</a>
        </td>
        <td align="center">
        	<a href="<?php echo url_for('@'.$str_module.'-delete?id='.$item->getId()) ?>" onclick="return confirm('<?php echo __('Are you sure?') ?>');">
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