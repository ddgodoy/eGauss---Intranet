<?php if(count($result_document)>0): ?>
<script type="text/javascript">
$(document).ready(function()
{
//
  $(".fancybox-manual-d").click(function()
  {
    var id = $(this).attr('dir');
    $.fancybox.open({
      href : '<?php echo url_for('@show-document?id=') ?>'+id,
      type : 'iframe',
      padding : 5
    });
  });
  
});
</script>
<fieldset>
    <legend>Documento</legend>
    <table width="100%" cellspacing="4" cellpadding="0" border="0">
        <?php foreach($result_document AS $k=>$v):?>
        <tr>
            <td width="10%" class="text_detail"><a class="fancybox-manual-d" dir="<?php echo (int)$v['id'] ?>" style="text-decoration: none; cursor: pointer "><?php echo Common::getFormattedDate($v['date'] , 'd/m/Y') ?></a></td>
            <td width="30%" class="text_detail">
                <a class="fancybox-manual-d" dir="<?php echo (int)$v['id'] ?>" style="text-decoration: none; cursor: pointer ">
                    <label style="cursor: pointer"><strong><?php echo $v['name'] ?></strong></label>
                </a>        
            </td>
            <td width="10%" class="text_detail">
                <a  href="<?php echo $v['url'] ?>" target="_blanck">
                    <img src="<?php echo $v['icon'] ?>" border="0" style="width:20px;height:20px;" title="Ver"/>
                    Ver Documento
                </a>
            </td>
            <td width="10%" class="text_detail">
                <a  href="<?php echo $v['download']!=''?$v['download']:$v['url'] ?>" <?php if($v['download']==''): ?> target="_blanck" <?php endif; ?>>
                    <img src="/images/descargar-documento.jpg" border="0" style="width:20px;height:20px;" title="Descargar"/>
                    Descargar Documento
                </a>    
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</fieldset>    
<?php endif; ?>
