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
					<tr><td><?php echo __('By name') ?></td></tr>
					<tr><td><input type="text" name="sch_name" value="<?php echo $sch_name ?>" class="form_input" style="width:98%;"/></td></tr>
					<tr><td><?php echo __('By email') ?></td></tr>
					<tr><td><input type="text" name="sch_email" value="<?php echo $sch_email ?>" class="form_input" style="width:98%;"/></td></tr>
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
		<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>&nbsp;&gt;&nbsp;<?php echo __('Users') ?>
	</div>
  <h1 class="titulos">
  	<?php echo __('List of Users') ?>
        <?php if($sf_user->hasCredential('super_admin')): ?> 
  	<input type="button" value="<?php echo __('Register users') ?>" style="float:right;" class="boton" onclick="document.location='<?php echo url_for($str_module.'-register') ?>';"/>
        <?php endif; ?>
  </h1>
  	<?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order, 'oCant'=>$oCant)) ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="listados">
      <tr>
      	<?php if (count($oList) > 0): ?>
	        <th width="23%"><a href="<?php echo $head_link.'&o=name&s='.$sort ?>"><?php echo __('Name') ?></a></th>
	        <th width="46%"><a href="<?php echo $head_link.'&o=email&s='.$sort ?>"><?php echo __('Email') ?></a></th>
                <th width="23%"><a href="<?php echo $head_link.'&o=user_role_id&s='.$sort ?>"><?php echo __('Rol') ?></a></th>
	        <th width="4%"></th>
	        <th width="4%"></th>
        <?php else: ?>
        	<th style="text-align:center;"><?php echo __('No results') ?></th>
        <?php endif; ?>
      </tr>
      <?php foreach ($oList as $item): ?>
      <tr class="<?php if (!empty($odd)) { echo 'gris'; $odd=0; } else { echo 'blanco'; $odd=1; } ?>">
        <td><?php echo $item->getName().' '.$item->getLastName() ?></td>
        <td><?php echo $item->getEmail() ?></td>
        <td><?php echo __($item->getUserRole()->getName())?></td>
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
      </tr>
      <?php endforeach; ?>
    </table>
    <?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order, 'oCant'=>$oCant)) ?>
  </div>
  <div class="clear"></div>
</div>