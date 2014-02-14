<div class="content">
  <div class="leftside">
	  <div class="mapa">
			<a href="<?php echo url_for('@homepage') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('@project-list') ?>"><strong><?php echo __('Basecamp') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo $name ?>
			<input type="button" value="<?php echo __('Volver al listado de proyectos') ?>" class="boton" onclick="document.location='<?php echo url_for('@project-list') ?>';" style="float:right;"/>
		</div>

		<?php include_component('basecamp', 'drawResumen', array('project_id' => $idPr)); ?>

  </div>
  <div class="clear"></div>
</div>