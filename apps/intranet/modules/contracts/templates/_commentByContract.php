<?php echo use_stylesheet('jquery-ui-1.7.2.custom.css') ?>
<?php echo use_javascript('tinymce/jscripts/tiny_mce/tiny_mce.js') ?>
<?php echo use_javascript('jquery-ui-1.7.2.custom.min.js') ?>
<script type="text/javascript">
$(document).ready(function(){
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
    
    $('#btn_action').click(function(){
        tinyMCE.triggerSave(true,true);
        var str = $( "#comment-form" ).serialize();
        var url = '<?php echo url_for('@contrat-set-commnet') ?>';
        $('#commnet-div').html('<div style="width: 350px; height: 204px; text-align: center; padding-top: 40px;"><img src="/images/loading.gif"/></div>');
        jQuery.ajax({
            type: 'POST',
            url: url,
            data:  str,
            success: function(data) {
               $('#commnet-div').html(data); 
            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    });
});
</script>
<?php if ($form->hasErrors()): ?>
    <div class="mensajeSistema error">
            <ul>
                <?php foreach($form->getFormFieldSchema() as $name=>$formField) { if ($formField->getError()) { echo '<li>'.$formField->getError().'</li>'; } } ?>
            </ul>
    </div>
<?php endif; ?>
<fieldset>
    <legend>Comentario</legend>
    <?php foreach ($array_value AS $k=>$v): ?>
    <div style="border-bottom: 1px solid #CCCCCC; margin-bottom: 15px;">
        <div>
            <?php $_img_user = $v['app_user']['photo']? 'uploads/user/'.ServiceFileHandler::getThumbImage($v['app_user']['photo']) : 'images/no_user.jpg'; ?>
            <img src="/<?php echo $_img_user ?>" width="20" height="20" alt="User" border="0" style="vertical-align: middle"/>
            &nbsp;&nbsp;&nbsp;
            <label><b><?php echo $v['app_user']['name'] ?>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;<?php echo $v['date'] ?></b></label><br/>
            <span style="font-size: 12px;"><?php echo html_entity_decode($v['comment']) ?></span>
            <br/>
            <div id="drive">
                <?php include_component('contracts', 'getDocumentComment', array('id_comment'=>$k)) ?>
            </div>
            <br/>
        </div>
    </div>
    <?php endforeach; ?>
    <br/>
    <form method="POST" id="comment-form">
    <table width="100%" cellspacing="4" cellpadding="0" border="0">
        <tr>
            <td>
                <?php echo $form['comments'] ?>
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
        <?php include_component('contracts', 'getDocumentComment') ?>
    </div>
    <div style="padding-top:10px;" class="botonera">
        <input type="button" name="btn_action" value="<?php echo __('Register') ?>" class="boton" id="btn_action"/>
        <?php echo $form->renderHiddenFields() ?>
    </div>
    </form>
</fieldset>
