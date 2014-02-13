<?php use_helper('Text') ?>
<div class="content">
  <div class="leftside">
  <div class="mapa">
		<a href="<?php echo url_for('@homepage') ?>"><strong><?php echo __('Home') ?></strong></a>
		&nbsp;&gt;&nbsp;
		<a href="<?php echo url_for('@project-list') ?>"><strong><?php echo __('Basecamp') ?></strong></a>
		&nbsp;&gt;&nbsp;
		<?php echo html_entity_decode($name); ?>
	</div>
	<table width="100%">
		<tr>
			<td width="33%"><h1 class="titulos" style="border:none;">
				<?php echo __('Vista general y actividad del proyecto') ?></h1>
			</td>
			<td><strong>[&nbsp;<?php echo strtoupper(html_entity_decode($name)) ?>&nbsp;]</strong></td>
			<td style="text-align:right;">
				<input type="button" value="<?php echo __('Volver al listado de proyectos') ?>" class="boton" onclick="document.location='<?php echo url_for('@project-list') ?>';"/>
			</td>
		</tr>
	</table>
  <table width="100%" border="0" cellpadding="3" cellspacing="1" class="bscmp_table">
  	<?php if (count($datos) > 0): ?>
			<?php foreach ($datos as $fecha => $item): ?>
	    <tr>
	    	<td colspan="4" style="padding:5px;color:#666666;font-size:13px;">
	    		<strong>
	    		<?php
	    			$aFecha = explode('-', $fecha);
	    			echo Common::diaSemana($aFecha[2]).' '.$aFecha[2].', '.Common::nombresMes($aFecha[1]).' '.$aFecha[0];
	    		?>
	    		</strong>
	    	</td>
	    </tr>
		    <?php foreach ($item as $indice => $evento): ?>
		    	<tr>
		    		<td width="9%" style="border-bottom:1px solid #CCCCCC;">
		    			<div style="text-align:right;padding:5px;color:#FFFFFF;background-color:<?php echo $evento['color'] ?>;">
		    				<?php echo $evento['event'] ?>
		    			</div>
		    		</td>
		    		<td style="border-bottom:1px solid #CCCCCC;font-size:13px;">
		    			<?php echo truncate_text($evento['texto'], 100); ?>
		    			&nbsp;|&nbsp;
	    				<a href="<?php echo $aConn['baseUri'].'projects/'.$idPr.'-'.$name.$evento['link'] ?>" target="_blank" class="bscmp_link">
	    					<?php echo $evento['lista'] ?>
	    				</a>
		    		</td>
		    		<td style="border-bottom:1px solid #CCCCCC;color:#959a99;text-align:right;">
		    			<?php echo $evento['label'] ?>
		    		</td>
		    		<td style="border-bottom:1px solid #CCCCCC;">
		    			<?php echo $evento['autor'] ?>
		    		</td>
		    	</tr>
		    <?php endforeach; ?>
		    <tr><td height="10"></td></tr>
	    <?php endforeach; ?>
  	<?php else: ?>
  		<tr><td height="20"></td></tr>
  		<tr><td style="font-size:16px;"><em>&nbsp;-- Sin resultados --</em></td></tr>
  		<tr><td height="20"></td></tr>
  	<?php endif; ?>
  </table>
  </div>
  <div class="clear"></div>
</div>