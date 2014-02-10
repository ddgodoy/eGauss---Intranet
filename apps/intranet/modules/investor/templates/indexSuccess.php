<?php
	$str_module = $sf_params->get('module');
	$index_url  = url_for('@investors');
	$head_link  = $index_url.'?page='.$iPage.$f_params;
?>
<div class="content">
  <div class="rightside">
    <div class="paneles">
      <form action="<?php echo $index_url ?>" enctype="multipart/form-data" method="post">
        <table cellspacing="4" cellpadding="0" border="0" width="100%">
        	<tr><td><?php echo __('Por nombre') ?></td></tr>
					<tr><td><input type="text" name="sch_name" value="<?php echo $sch_name ?>" class="form_input" style="width:98%;"/></td></tr>
          <tr><td style="padding-top:5px;"><input type="submit" name="btn_buscar" value="Buscar" class="boton"></td></tr>
        </table>
      </form>
    </div>
  </div>
  <div class="leftside" style="margin-left:260px;">
  <div class="mapa">
		<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>&nbsp;&gt;&nbsp;<?php echo __('Inversores') ?>
	</div>
  <h1 class="titulos">
  	<?php echo __('Listado de Inversores') ?>
  	<input type="button" value="<?php echo __('Registrar un inversor') ?>" style="float:right;" class="boton" onclick="document.location='<?php echo url_for('@investor-register') ?>';"/>
  </h1>
  	<?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order, 'oCant'=>$oCant)) ?>

    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="listados">
      <tr>
      	<?php if (count($oList) > 0): ?>
	        <th width="30%"><a href="<?php echo $head_link.'&o=i.name&s='.$sort ?>"><?php echo __('Nombre') ?></a></th>
	        <th width="58%"><a href="<?php echo $head_link.'&o=e.name&s='.$sort ?>"><?php echo __('Empresa') ?></a></th>
	        <th width="4%"></th>
	        <th width="4%"></th>
	        <th width="4%"></th>
        <?php else: ?>
        	<th style="text-align:center;"><?php echo __('No results') ?></th>
        <?php endif; ?>
      </tr>
      <?php foreach ($oList as $item): ?>
      <tr class="<?php if (!empty($odd)) { echo 'gris'; $odd=0; } else { echo 'blanco'; $odd=1; } ?>">
        <td><?php echo $item->getName() ?></td>
        <td><?php echo $item->RegisteredCompanies->getName() ?></td>
        <td align="center">
        	<a href="<?php echo url_for('@investor-show?id='.$item->getId()) ?>">
        		<img border="0" src="/images/ver.png" alt="<?php echo __('Ver resultados') ?>" title="<?php echo __('Ver resultados') ?>" width="28">
        	</a>
        </td>
        <td align="center">
        	<a href="<?php echo url_for('@investor-edit?id='.$item->getId()) ?>">
        		<img border="0" src="/images/editar.png" alt="<?php echo __('Edit') ?>" title="<?php echo __('Edit') ?>">
        	</a>
        </td>
        <td align="center">
        	<a href="<?php echo url_for('@investor-delete?id='.$item->getId()) ?>" onclick="return confirm('<?php echo __('Are you sure?') ?>');">
        		<img border="0" src="/images/borrar.png" alt="<?php echo __('Delete') ?>" title="<?php echo __('Delete') ?>">
        	</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>

    <?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order, 'oCant'=>$oCant)) ?>
  </div>
  <div class="clear"></div>
</div>