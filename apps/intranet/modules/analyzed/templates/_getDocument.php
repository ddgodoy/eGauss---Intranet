<?php if(count($result_document)>0): ?>
<script type="text/javascript">
$(document).ready(function() {
    $('.deleted-video').click(function(){
        var id   = $(this).attr('id');
        var type = $(this).attr('alt');
        var url  = '<?php echo url_for($url_d_document) ?>';
        
        jQuery.ajax({
        type: 'POST',
        url: url,
        data: 'id_doc='+id+'&type='+type,
        success: function(data) {
           $('#drive').html(data);
         }
        });   
        
    });
});
</script>
<fieldset>
    <legend>Documento</legend>
    <table width="100%" cellspacing="4" cellpadding="0" border="0">
        <?php foreach($result_document AS $k=>$v):?>
        <tr>
            <td width="3%"><img src="<?php echo $v['icon'] ?>" border="0" width="20" height="20"/></td>
            <td width="35%">
                <a class="fancybox-media" target="_blanck" title="<?php echo $v['name'] ?>" href="<?php echo $v['url'] ?>">
                    <label style="cursor: pointer"><strong><?php echo $v['name'] ?></strong></label>
                </a>        
            </td>
            <td>
                <img src="/images/borrar_hover.png" class="deleted-video" alt="<?php echo $v['type'] ?>" id="<?php echo $v['id'] ?>" border="0" width="20" height="20" style="cursor: pointer"/>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</fieldset>    
<?php endif; ?>
