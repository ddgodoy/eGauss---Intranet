<script type="text/javascript">
$(document).ready(function(){
    $("#fancybox-manual-c").click(function() {
            $.fancybox.open({
                    height: '290px',
                    href : '<?php echo url_for("http://localhost/google_drive/") ?>',
                    type : 'iframe',
                    padding : 5,
                    afterClose: function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
                       jQuery.ajax({
                            type: 'GET',
                            url: '<?php echo url_for($url_document) ?>',
                            success: function(data) {
                                $('#drive').html(data);
                            }
                       });
                    }
            });
            
            
    });
});
</script>
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
			<a href="<?php echo url_for('shareholders/index') ?>"><strong><?php echo __('Junta de Accionistas') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __(ucfirst($str_action)) ?>
		</div>
		<?php if ($form->hasErrors() || count($error) > 0): ?>
			<div class="mensajeSistema error">
				<ul>
                                        <?php foreach ($error as $e): ?><li><?php echo $e ?></li><?php endforeach; ?>
					<?php foreach($form->getFormFieldSchema() as $name=>$formField) { if ($formField->getError()) { echo '<li>'.$formField->getError().'</li>'; } } ?>
				</ul>
			</div>
		<?php endif; ?>
		<h1 class="titulos">
			<?php echo __(ucfirst($str_action)).' '.__('Junta de Accionistas') ?>
		</h1>
		<form enctype="multipart/form-data" method="post" action="<?php echo url_for('@'.$str_module.'-'.$str_action.$request_id) ?>">
                    <label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label><br />
			<fieldset>
                            <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                <tr>
                                    <td style=" width: 60%">
                                        <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                            <tr>
                                                    <td width="10%"><label><?php echo __('Date') ?> *</label></td>
                                                    <td><?php echo $form['date'] ?></td>
                                            </tr>
                                            <tr>
						<td width="6%"><label><?php echo __('Inicio') ?> *</label></td>
						<td><?php echo $form['hour_from'] ?></td>
                                            </tr>
                                            <tr>
						<td width="6%"><label><?php echo __('Fin') ?> *</label></td>
						<td><?php echo $form['hour_to'] ?></td>
                                            </tr>
                                            <tr>
                                                    <td width="10%"><label><?php echo __('Tema') ?> *</label></td>
                                                    <td><?php echo $form['subject'] ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="vertical-align: top">
                                        <fieldset style="background-color: #E1F3F7;">
                                            <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                                <tr>
                                                    <td width="10%"><?php echo $form['next'] ?></td>
                                                    <td><label>Informar como próxima Junta de Accionistas</label></td>
                                                </tr>
                                            </table>
                                        </fieldset>
                                    </td>
                                </tr>
                                </table>
                                <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                <tr><td style="height: 15px;"></td></tr>
                                <tr>
                                    <td colspan="2">
                                        <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                            <tr>
                                                <td><?php echo $form['body'] ?></td>
                                            </tr>    
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a id="fancybox-manual-c">
                                            <img src="/images/drive.jpeg" border="0" width="50" height="33" title="Ingresar Documento"  style="cursor: pointer; vertical-align: super"/>
                                        </a>
                                    </td>
                                </tr>      
                                </table>
                                <div id="drive">
                                    <?php include_component('shareholders', 'getDocument') ?>
                                </div>
                        </fieldset>
                        <div style="padding-top:10px;" class="botonera">
				<input type="button" onclick="document.location='<?php echo url_for($str_module.'/index') ?>';" value="<?php echo __('Cancel') ?>" class="boton" />
				<input type="submit" name="btn_action" value="<?php echo __('Register') ?>" class="boton" id="btn_action"/>
                                <?php echo $form->renderHiddenFields() ?>
			</div>
                </form>
	</div>
	<div class="clear"></div>
</div>    