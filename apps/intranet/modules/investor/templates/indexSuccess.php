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
            <tr><td><?php echo __('Por Nombre') ?></td></tr>
            <tr><td><input type="text" name="sch_name" value="<?php echo $sch_name ?>" class="form_input" style="width:98%;"/></td></tr>
            <tr><td><?php echo __('Por Empresa') ?></td></tr>
            <tr><td><input type="text" name="sch_company" value="<?php echo $sch_company ?>" class="form_input" style="width:98%;"/></td></tr>
            <tr><td><?php echo __('Por Proyecto') ?></td></tr>
            <tr><td><input type="text" name="sch_project" value="<?php echo $sch_project ?>" class="form_input" style="width:98%;"/></td></tr>
            <tr><td><?php echo __('Por Tema') ?></td></tr>
            <tr><td><?php echo select_tag('sch_theme', options_for_select([''=>'--Seleccionar--']+Theme::getArrayForSelect(), $sch_theme), array('class'=>'form_input', 'style'=>'width:100%;')) ?></td></tr>
            <tr><td><?php echo __('Por Sub tema') ?></td></tr>
            <tr><td><input type="text" name="sch_sub_theme" value="<?php echo $sch_sub_theme ?>" class="form_input" style="width:98%;"/></td></tr>
            <tr><td><?php echo __('Acreditado por Enisa') ?></td></tr>
            <tr><td><input type="checkbox" id="accredited_enisa" name="sch_accredited_enisa" <?php if($sch_accredited_enisa): ?> checked="checked" <?php endif; ?> value="1"></td></tr>
            <tr><td style="padding-top:5px;"><input type="submit" name="btn_buscar" value="Buscar" class="boton"></td></tr>
        </table>
      </form>
    </div>
    <div class="paneles" id="conten-calendar">
      <?php include_component('calendar', 'calendar') ?>
    </div> 
  </div>
  <div class="leftside" style="margin-left:260px;">
  <div class="mapa">
		<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>&nbsp;&gt;&nbsp;<?php echo __('Inversores') ?>
	</div>
  <h1 class="titulos">
  	<?php echo __('Listado de Inversores') ?>
        <?php if($sf_user->hasCredential('super_admin')): ?>
                <input type="button" value="<?php echo __('Registrar inversor') ?>" style="float:right;" class="boton" onclick="document.location='<?php echo url_for('@investor-register') ?>';"/>
        <?php endif; ?>        
  	<?php if ($oCant > 0): ?>
  		<input type="button" value="<?php echo __('Exportal a Excel') ?>" style="float:right;margin-right:10px;" class="boton" onclick="document.location='<?php echo url_for('@investor-excel') ?>';"/>
  	<?php endif; ?>
  </h1>
  	<?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order, 'oCant'=>$oCant)) ?>

    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="listados">
      <tr>
      	<?php if (count($oList) > 0): ?>
	        <th width="25%"><a href="<?php echo $head_link.'&o=i.name&s='.$sort ?>"><?php echo __('Nombre') ?></a></th>
	        <th width="25%"><a href="<?php echo $head_link.'&o=company&s='.$sort ?>"><?php echo __('Empresa') ?></a></th>
	        <th width="15%"><a href="<?php echo $head_link.'&o=project&s='.$sort ?>"><?php echo __('Proyecto') ?></a></th>
	        <th width="18%"><a href="<?php echo $head_link.'&o=theme_id&s='.$sort ?>"><?php echo __('Tema') ?></a></th>
                <th width="18%"><a href="<?php echo $head_link.'&o=sub_theme&s='.$sort ?>"><?php echo __('Sub Tema') ?></a></th>
                <th width="18%"><a href="<?php echo $head_link.'&o=accredited_enisa&s='.$sort ?>"><?php echo __('Acreditado') ?></a></th>
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
        <td><?php echo $item->getName().' '.$item->getLastName() ?></td>
        <td><?php echo $item->getCompany() ?></td>
        <td><?php echo $item->getProject() ?></td>
        <td><?php echo $item->getTheme()->getName() ?></td>
        <td><?php echo $item->getSubTheme() ?></td>
        <td><?php echo $item->getAccreditedEnisa()==1?'Enisa':''; ?></td>
        <td align="center">
        	<a href="<?php echo url_for('@investor-show?id='.$item->getId()) ?>">
        		<img border="0" src="/images/investor.png" alt="<?php echo __('Ver detalle') ?>" title="<?php echo __('Ver detalle') ?>">
        	</a>
        </td>
        <?php if($sf_user->hasCredential('super_admin')): ?>
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
        <?php endif; ?>
      </tr>
      <?php endforeach; ?>
    </table>

    <?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order, 'oCant'=>$oCant)) ?>
  </div>
  <div class="clear"></div>
</div>