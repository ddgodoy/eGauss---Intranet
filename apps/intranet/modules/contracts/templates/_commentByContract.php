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
        tinyMCE.get("contracts_intermediation_comments_comments").save();
        var str = $( "#comment-form" ).serialize();
        var url = '<?php echo url_for('@contrat-set-commnet') ?>';
        $('#commnet-div').html('<div style="width: 100%; height: 204px; text-align: center; padding-top: 40px;"><img src="/images/loading.gif"/></div>');
        jQuery.ajax({
            type: 'POST',
            url: url,
            data:  str,
            success: function(data) {
               $('#commnet-div').html(data); 
               tinymce.EditorManager.execCommand('mceRemoveEditor', false, "contracts_intermediation_comments_comments"); 
               tinymce.EditorManager.execCommand('mceAddEditor', false, "contracts_intermediation_comments_comments");
            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    });
    
    $('.deleted-comment').click(function(){
        var id_comment = $(this).attr('id');
        var url = '<?php echo url_for('@contrat-delete-commnet') ?>';
        $('#commnet-div').html('<div style="width: 100%; height: 204px; text-align: center; padding-top: 40px;"><img src="/images/loading.gif"/></div>');
        jQuery.ajax({
            type: 'GET',
            url: url,
            data:  'id_comment='+id_comment+'&id=<?php echo $contract_id ?>',
            success: function(data) {
               $('#commnet-div').html(data);
               tinymce.EditorManager.execCommand('mceRemoveEditor', false, "contracts_intermediation_comments_comments"); 
               tinymce.EditorManager.execCommand('mceAddEditor', false, "contracts_intermediation_comments_comments");
            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    });
    
    $('.edit-comment').click(function(){
        var id_comment = $(this).attr('id');
        var url = '<?php echo url_for('@contrat-set-commnet') ?>';
        $('#commnet-div').html('<div style="width: 100%; height: 204px; text-align: center; padding-top: 40px;"><img src="/images/loading.gif"/></div>');
        jQuery.ajax({
            type: 'GET',
            url: url,
            data:  'comment_id='+id_comment+'&id=<?php echo $contract_id ?>',
            success: function(data) {
               $('#commnet-div').html(data);
               tinymce.EditorManager.execCommand('mceRemoveEditor', false, "contracts_intermediation_comments_comments"); 
               tinymce.EditorManager.execCommand('mceAddEditor', false, "contracts_intermediation_comments_comments");
            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    });
    
    $(".fancybox-manual-user-comment").click(function()
    {
      var id = $(this).attr('id');
      $.fancybox.open({
        href : '<?php echo url_for('@user-view?id=') ?>'+id,
        type : 'iframe',
        padding : 5
      });
    });
});
</script>
<?php if ($form->hasErrors()): ?>
    <div class="mensajeSistema error">
            <ul>
                <?php foreach($form->getFormFieldSchema() as $name=>$formField) { if ($formField->getError()) { echo '<li>'.$name.' '.$formField->getError().'</li>'; } } ?>
            </ul>
    </div>
<?php endif; ?>
<fieldset>
    <legend>Comentario</legend>
    <?php foreach ($array_value AS $k=>$v): ?>
    <div style="border-bottom: 1px solid #CCCCCC; margin-bottom: 15px;">
        <div>
            <?php $_img_user = $v['app_user']['photo']? 'uploads/user/'.ServiceFileHandler::getThumbImage($v['app_user']['photo']) : 'images/no_user.jpg'; ?>
            <a class="fancybox-manual-user-comment text_detail" id="<?php echo $v['app_user']['id'] ?>" style="cursor: pointer">
                <img src="/<?php echo $_img_user ?>" width="20" height="20" alt="User" border="0" style="vertical-align: middle"/>
            </a>
            &nbsp;&nbsp;&nbsp;
            <label>
                <b>
                    <a class="fancybox-manual-user-comment text_detail" id="<?php echo $v['app_user']['id'] ?>" style="cursor: pointer">
                        <?php echo $v['app_user']['name'] ?>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;<?php echo $v['date'] ?>
                    </a>
                </b>
            </label>
            <?php if($v['app_user']['id'] == $sf_user->getAttribute('user_id')): ?>
            <div style="float: right;width: 50px; height: 20px;">
                <img src="/images/editar.png" class="edit-comment" id="<?php echo $v['id'] ?>" border="0" style="width:20px;height:20px;cursor: pointer" title="Editar"/>
                <img src="/images/borrar.png" class="deleted-comment" id="<?php echo $v['id'] ?>" title="Eliminar" style="cursor: pointer" />
            </div><br/>
            <?php endif; ?>
            <span style="font-size: 12px;"><?php echo html_entity_decode($v['comment']) ?></span>
            <br/>
            <div id="drive_two_<?php echo $k ?>">
                <?php include_component('contracts', 'getDocumentViewComment', array('id_comment'=>$k)) ?>
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
        <?php include_component('contracts', 'getDocumentComment', array('id_comment'=>$comment_id)) ?>
    </div>
    <div style="padding-top:10px;" class="botonera">
        <input type="button" name="btn_action" value="<?php echo __('Register') ?>" class="boton" id="btn_action"/>
        <?php echo $form->renderHiddenFields() ?>
        <?php if(!$form->isNew()): ?>
        <input type="hidden" id="comment_id" value="<?php echo $form['id']->getValue() ?>" name="comment_id">
        <?php endif; ?>
    </div>
    </form>
</fieldset>