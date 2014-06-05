<?php if(count($result_document)>0): ?>
<script type="text/javascript">
$(document).ready(function()
{
//
$(".fancybox-manual-t").click(function(){
  var id = $(this).attr('id');
  $.fancybox.open({
    href : id,
    type : 'iframe',
    padding : 5
  });
});

$('.deleted-video').click(function(){
        var id   = $(this).attr('id');
        var type = $(this).attr('alt');
        var url  = '<?php echo url_for($url_d_document) ?>';
        
        jQuery.ajax({
        type: 'POST',
        url: url,
        data: 'id_doc='+id+'&type='+type+'&id_comment=<?php echo $id_comment ?>',
        success: function(data) {
           $('#drive_two_<?php echo $id_comment ?>').html(data);
         }
        });   
        
    });

});
</script>
<table width="100%" cellspacing="4" cellpadding="0" border="0">
    <?php foreach($result_document AS $k=>$v):?>
    <tr>
        <td width="50%" class="text_detail">
            <a class="fancybox-manual-t" id="<?php echo url_for('@show-document?id='.$v['id']) ?>" style="text-decoration: none; cursor: pointer ">
                <label style="cursor: pointer"><strong><?php echo $v['name'] ?></strong></label>
            </a>        
        </td>
        <td width="5%" class="text_detail">
            <a  href="<?php echo $v['url'] ?>" target="_blanck">
                <img src="<?php echo $v['icon'] ?>" border="0" style="width:20px;height:20px;" title="Ver"/>
            </a>
        </td>
        <td width="5%" class="text_detail">
            <a  href="<?php echo $v['download']!=''?$v['download']:$v['url'] ?>" <?php if($v['download']==''): ?> target="_blanck" <?php endif; ?>>
                <img src="/images/descargar-documento.jpg" border="0" style="width:20px;height:20px;" title="Descargar"/>
            </a>    
        </td>
        <td>
            <?php if($v['user'] == $sf_user->getAttribute('user_id')): ?>
            <img src="/images/borrar_hover.png" class="deleted-video" alt="<?php echo $v['type'] ?>" id="<?php echo $v['id'] ?>" border="0" width="20" height="20" style="cursor: pointer"/>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>  
<?php endif; ?>
