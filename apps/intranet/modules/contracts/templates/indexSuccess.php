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
            <tr><td>Por Cliente</td></tr>
            <tr><td><input type="text" name="sch_customer" value="<?php echo $sch_customer ?>" class="form_input" style="width:98%;"/></td></tr>
            <tr><td style="padding-top:5px;"><input type="submit" name="btn_buscar" value="Buscar" class="boton"></td></tr>
        </table>
      </form>
    </div>
    <div class="paneles" id="conten-calendar" >
        <?php include_component('calendar', 'calendar') ?>
    </div>   
  </div>
  <div class="leftside" style="margin-left:260px;">
  <div class="mapa">
		<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>&nbsp;&gt;&nbsp;<?php echo __('Contratos de Intermediación') ?>
	</div>
  <h1 class="titulos">
  	<?php echo __('Lista de Contratos de Intermediación') ?>
        <?php if($sf_user->hasCredential('super_admin')): ?> 
  	<input type="button" value="<?php echo __('Registrar Contratos de Intermediación') ?>" style="float:right;" class="boton" onclick="document.location='<?php echo url_for($str_module.'-register') ?>';"/>
        <?php endif; ?>
  </h1>
  	<?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order, 'oCant'=>$oCant)) ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="listados">
      <tr>
      	<?php if (count($oList) > 0): ?>
                <th width="23%"><a href="<?php echo $head_link.'&o=date&s='.$sort ?>"><?php echo __('Mes previsto de ingresos') ?></a></th>
	        <th width="23%"><a href="<?php echo $head_link.'&o=customer_name&s='.$sort ?>"><?php echo __('Cliente') ?></a></th>
                <th width="23%"><a href="<?php echo $head_link.'&o=app_user_id&s='.$sort ?>"><?php echo __('Socio') ?></a></th>
                <th width="23%"><a href="<?php echo $head_link.'&o=business_amount&s='.$sort ?>"><?php echo __('Volumen negocio') ?></a></th>
                <th width="23%"><a href="<?php echo $head_link.'&o=final_commission&s='.$sort ?>"><?php echo __('Comisión') ?></a></th>
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
        <td><?php echo $month[$item->getMonth()].' -- '.$item->getYear() ?></td>
        <td><?php echo $item->getCustomerName() ?></td>
        <td><?php echo $item->getAppUser()->getName().' '.$item->getAppUser()->getLastName() ?></td>
        <td><?php echo $item->getBusinessAmount() ?></td>
        <td><?php echo $item->getFinalCommission() ?></td>
        <td align="center">
        	<a href="<?php echo url_for('@'.$str_module.'-show?id='.$item->getId()) ?>">
        		<img border="0" src="/images/listado.png" alt="<?php echo __('See') ?>" title="<?php echo __('See') ?>">
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