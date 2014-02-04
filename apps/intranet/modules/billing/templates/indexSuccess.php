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
            <tr>
            	<td>
            		<?php echo select_tag('sch_month', options_for_select($month, $sch_month), array('style'=>'width:100%')) ?>
            	</td>
            </tr>
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
		<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>&nbsp;&gt;&nbsp;<?php echo __('Facturación') ?>
	</div>
  <h1 class="titulos">
  	<?php echo __('Lista de Facturación') ?>
        <?php if($sf_user->hasCredential('super_admin')): ?> 
  	<input type="button" value="<?php echo __('Registrar Facturación') ?>" style="float:right;" class="boton" onclick="document.location='<?php echo url_for($str_module.'-register') ?>';"/>
        <?php endif; ?>
  </h1>
  	<?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order, 'oCant'=>$oCant)) ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="listados">
      <?php if (count($oList) > 0): ?>  
        <tr>
              <th colspan="2" width="10%" style=" text-align: center" ><a><?php echo __('Date') ?></a></th>
              <th colspan="2" width="10%" style=" text-align: center"><a><?php echo __('Venta de Participadas') ?></a></th>
              <th colspan="2" width="10%" style=" text-align: center"><a><?php echo __('Consultoría') ?></a></th>
              <th colspan="2" width="10%" style=" text-align: center"><a><?php echo __('Intermediación') ?></a></th>
              <th colspan="2" width="10%" style=" text-align: center"><a><?php echo __('Formación') ?></a></th>
              <th colspan="2" width="10%" style=" text-align: center"><a><?php echo __('Patentes') ?></a></th>
              <th colspan="2" width="10%" style=" text-align: center"></th>
        </tr>
        <tr>
              <th><a href="<?php echo $head_link.'&o=month&s='.$sort ?>"><?php echo __('Mes') ?></a></th>
              <th><a href="<?php echo $head_link.'&o=year&s='.$sort ?>"><?php echo __('Año') ?></a></th>
              <th><a><?php echo __('Estimado') ?></a></th>
              <th><a><?php echo __('Facturado') ?></a></th>
              <th><a><?php echo __('Estimado') ?></a></th>
              <th><a><?php echo __('Facturado') ?></a></th>
              <th><a><?php echo __('Estimado') ?></a></th>
              <th><a><?php echo __('Facturado') ?></a></th>
              <th><a><?php echo __('Estimado') ?></a></th>
              <th><a><?php echo __('Facturado') ?></a></th>
              <th><a><?php echo __('Estimado') ?></a></th>
              <th><a><?php echo __('Facturado') ?></a></th>
              <?php if($sf_user->hasCredential('super_admin')): ?>
              <th width="4%"></th>
              <th width="4%"></th>
              <?php endif; ?> 
        </tr>
        <?php foreach ($oList as $item): ?>
          <tr class="<?php if (!empty($odd)) { echo 'gris'; $odd=0; } else { echo 'blanco'; $odd=1; } ?>">
            <td>
            	<?php
            		$item_mes = $item->getMonth();
            		echo !empty($item_mes) ? $month[$item_mes] : '---';
            	?>
            </td>
            <td><?php echo $item->getYear() ?></td>
            <td><?php echo $item->getTotalAffiliated() ?></td>
            <td><?php echo $item->getSaleOfAffiliated() ?></td>
            <td><?php echo $item->getTotalConsultancy() ?></td>
            <td><?php echo $item->getConsultancy() ?></td>
            <td><?php echo $item->getTotalIntermediation() ?></td>
            <td><?php echo $item->getIntermediation() ?></td>
            <td><?php echo $item->getTotalFormation() ?></td>
            <td><?php echo $item->getFormation() ?></td>
            <td><?php echo $item->getTotalPatents() ?></td>
            <td><?php echo $item->getPatents() ?></td>
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
      <?php else: ?>
      <tr>
          <th style="text-align:center;"><?php echo __('No results') ?></th>
      </tr>
      <?php endif; ?>
    </table>
    <?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order, 'oCant'=>$oCant)) ?>
  </div>
  <div class="clear"></div>
</div>