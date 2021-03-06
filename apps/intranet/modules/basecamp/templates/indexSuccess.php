<div class="content">
  <div class="rightside">
    <div class="paneles" id="conten-calendar">
      <?php include_component('calendar', 'calendar') ?>
    </div>
  </div>  
  <div class="leftside" style="margin-left:260px;">
    <div class="mapa">
                  <a href="<?php echo url_for('@homepage') ?>"><strong><?php echo __('Home') ?></strong></a>&nbsp;&gt;&nbsp;<?php echo __('Basecamp') ?>
          </div>
    <h1 class="titulos" style="border:none;">
          <?php echo __('Listado de Proyectos') ?>
    </h1>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="listados">
          <tr>
                  <?php if (count($arrDatos) > 0): ?>
                          <th width="10%"><?php echo __('Id') ?></th>
                          <th width="80%"><?php echo __('Nombre') ?></th>
                      <th width="10%" style="text-align:center;">Ver resumen</th>
                  <?php else: ?>
                          <th style="text-align:center;"><?php echo __('No results') ?></th>
                  <?php endif; ?>
          </tr>
      <?php foreach ($arrDatos as $k_item => $v_item): ?>
      <tr class="<?php if (!empty($odd)) { echo 'gris'; $odd=0; } else { echo 'blanco'; $odd=1; } ?>">
          <td><?php echo $k_item ?></td>
        <td><?php echo $v_item ?></td>
        <td align="center">
          <?php
                  $fixed = str_replace('.', '-', $v_item);
          ?>
          <a href="<?php echo url_for('@task-list?id='.$k_item.'&project='.$fixed) ?>">
                  <img border="0" src="/images/basecamp.png" alt="<?php echo __('Resumen') ?>" title="<?php echo __('Resumen') ?>">
          </a>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <div class="clear"></div>
</div>