<script type="text/javascript" src="/sfFormExtraPlugin/js/double_list.js"></script>
<?php
	$str_module   = $sf_params->get('module');
	$str_action   = $sf_params->get('action');
	$request_id   = $id ?  "?id=$id" : '';
?>
<div class="content">
        <div class="rightside">
            <div class="paneles" id="conten-calendar">
                <?php include_component('calendar', 'calendar') ?>
            </div> 
        </div>
        <div class="leftside" style="margin-left:260px;">
            <div class="mapa">
                    <a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
                    &nbsp;&gt;&nbsp;
                    <a href="<?php echo url_for('product/index') ?>"><strong><?php echo __('Productos') ?></strong></a>
                    &nbsp;&gt;&nbsp;
                    <?php echo __(ucfirst($str_action)) ?>
            </div>
            <?php if ($form->hasErrors()): ?>
                    <div class="mensajeSistema error">
                            <ul>
                                <?php foreach ($error as $e): ?><li><?php echo $e ?></li><?php endforeach; ?>
                                <?php foreach($form->getFormFieldSchema() as $name=>$formField) { if ($formField->getError()) { echo '<li>'.$formField->getError().'</li>'; } } ?>
                            </ul>
                    </div>
            <?php endif; ?>
            <h1 class="titulos">
                    <?php echo __(ucfirst($str_action)).' '.__('Productos') ?>
            </h1>
            <form enctype="multipart/form-data" method="post" action="<?php echo url_for('@'.$str_module.'-'.$str_action.$request_id) ?>">
                <label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label><br />
                <fieldset>
                    <table width="100%" cellspacing="4" cellpadding="0" border="0">
                        <tr>
                            <td width="20%"><label><?php echo __('Producto') ?> *</label></td>
                            <td><?php echo $form['name'] ?></td>
                        </tr>
                        <tr>
                            <td width="20%"><label><?php echo __('Empresas') ?> </label></td>
                            <td><?php echo $form['company'] ?></td>
                        </tr>
                    </table>
                    <table width="100%" cellspacing="4" cellpadding="0" border="0">
                        <tr><td style="height: 15px;"></td></tr>
                        <tr>
                          <td colspan="2">
                            <table width="100%" cellspacing="4" cellpadding="0" border="0">
                              <tr><td><?php echo $form['description'] ?></td></tr>    
                            </table>
                          </td>
                        </tr>
                    </table>
                </fieldset>  
                <div style="padding-top:10px;" class="botonera">
                    <input type="button" onclick="document.location='<?php echo url_for($str_module.'/index') ?>';" value="<?php echo __('Cancel') ?>" class="boton" />
                    <?php if($id): ?>
                        <input type="button" onclick="document.location='<?php echo url_for('@'.$str_module.'-show?id='.$id) ?>';" value="<?php echo __('See') ?>" class="boton" />
                    <?php endif; ?>
                    <input type="submit" name="btn_action" value="<?php echo __('Register') ?>" class="boton" id="btn_action"/>
                    <?php echo $form->renderHiddenFields() ?>
                </div>
            </form>
        </div>
    <div class="clear"></div>
</div>    