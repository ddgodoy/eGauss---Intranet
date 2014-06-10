<script type="text/javascript">
$(document).ready(function(){
    $("#fancybox-manual-b").click(function() {
            $.fancybox.open({
                    href : '<?php echo url_for($url_register_videos) ?>',
                    type : 'iframe',
                    padding : 5,
                    afterClose: function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
                       jQuery.ajax({
                            type: 'GET',
                            url: '<?php echo url_for($url_get_videos) ?>',
                            success: function(data) {
                                $('#videos').html(data);
                            }
                       });
                    }
            });
    });
    
    $("#fancybox-manual-c").click(function() {
            $.fancybox.open({
                    height: '290px',
                    href : '<?php echo url_for("@google_drive") ?>',
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
    
    $('#companies').click(function(){
        if($(this).is(':checked')){
            $('#contracts').removeAttr('checked');
            $('#data-company').show();
            $('#data-contract').hide();
            $('#fancybox-manual-b').show();
        }else{
            $('#contracts').attr('checked', 'checked');
            $('#data-company').hide();
            $('#data-contract').show();
            $('#fancybox-manual-b').hide();
        }    
    });
    
    $('#contracts').click(function(){
        if($(this).is(':checked')){
            $('#companies').removeAttr('checked')
            $('#data-contract').show();
            $('#data-company').hide();
            $('#fancybox-manual-b').hide();
        }else{
            $('#companies').attr('checked', 'checked');
            $('#data-company').show();
            $('#data-contract').hide();
            $('#fancybox-manual-b').show();
        }    
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
			<a href="<?php echo url_for('information/index') ?>"><strong><?php echo __('Información') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __(ucfirst($str_action)) ?>
		</div>
		<?php if ($form->hasErrors()): ?>
			<div class="mensajeSistema error">
				<ul>
					<?php foreach($form->getFormFieldSchema() as $name=>$formField) { if ($formField->getError()) { echo '<li>'.$formField->getError().'</li>'; } } ?>
				</ul>
			</div>
		<?php endif; ?>
		<h1 class="titulos">
			<?php echo __(ucfirst($str_action)).' '.__('Información') ?>
		</h1>
		<form enctype="multipart/form-data" method="post" action="<?php echo url_for('@'.$str_module.'-'.$str_action.$request_id) ?>">
                    <label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label><br />
                        <fieldset>
                            <legend>Pertenece</legend>
                            <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                <tr>
                                    <td width="5%"><input type="checkbox" id="companies" name="companies" <?php if($companies): ?> checked="checked" <?php endif; ?> value="1"></td>
                                    <td><label>Participadas</label></td>
                                </tr>
                                <tr>
                                    <td width="5%"><input type="checkbox" id="contracts" name="contracts" <?php if($contracts): ?> checked="checked" <?php endif; ?> value="1"></td>
                                    <td><label>Intermediación</label></td>
                                </tr>
                            </table>
                        </fieldset>    
			<fieldset>
                            <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                <tr>
                                    <td style=" width: 60%">
                                        <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                            <tr>
                                                    <td width="20%"><label><?php echo __('Date') ?> *</label></td>
                                                    <td><?php echo $form['date'] ?></td>
                                            </tr>
                                            <tr>
                                                    <td width="10%"><label><?php echo __('Título') ?> *</label></td>
                                                    <td><?php echo $form['name'] ?></td>
                                            </tr>
                                        </table>
                                        <table width="100%" id="data-company" cellspacing="4" cellpadding="0" border="0" <?php if(!$companies): ?> style="display: none" <?php endif; ?> >
                                            <tr>
                                                    <td width="20%"><label><?php echo __('Empresa') ?> *</label></td>
                                                    <td><?php echo $form['registered_companies_id'] ?></td>
                                            </tr>
                                            <tr>
                                                    <td width="10%"><label><?php echo __('Categoría') ?> *</label></td>
                                                    <td><?php echo $form['type_information_id'] ?></td>
                                            </tr>
                                        </table>
                                        <table width="100%" cellspacing="4" id="data-contract" cellpadding="0" border="0" <?php if(!$contracts): ?> style="display: none" <?php endif; ?>>
                                            <tr>
                                                    <td width="20%"><label><?php echo __('Intermediación') ?> *</label></td>
                                                    <td>
                                                        <?php echo $form['contracts_intermediation_id'] ?>
                                                        <input type="hidden" id="information_type_information_id" name="information[type_information_id]" value="1" />
                                                    </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="vertical-align: top">
                                        <fieldset style="background-color: #E1F3F7;">
                                            <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                                <tr>
                                                    <td width="10%"><?php echo $form['important'] ?></td>
                                                    <td><label>Informar a los responsables de la Empresa</label></td>
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
                                                <td><?php echo $form['description'] ?></td>
                                            </tr>    
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a id="fancybox-manual-b" <?php if($contracts): ?> style="display: none" <?php endif; ?>>
                                            <img src="/images/video.jpeg" border="0" width="50" height="50" title="Ingresar Vídeo"  style="cursor: pointer"/>
                                        </a>
                                        <a id="fancybox-manual-c">
                                            <img src="/images/drive.jpeg" border="0" width="50" height="33" title="Ingresar Documento"  style="cursor: pointer; vertical-align: super"/>
                                        </a>
                                    </td>
                                </tr>      
                                </table>
                                <div id="videos">
                                    <?php include_component('information', 'getVideos') ?>
                                </div>
                                <div id="drive">
                                    <?php include_component('information', 'getDocument') ?>
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