<?php if(count($result_document)>0): ?>
<fieldset>
    <legend>Documento</legend>
    <table width="100%" cellspacing="4" cellpadding="0" border="0">
        <?php foreach($result_document AS $k=>$v):?>
        <tr>
            <td width="3%"><?php echo Common::getFormattedDate($v['date'] , 'd/m/Y') ?></td>
            <td width="35%">
                <a target="_blanck" title="<?php echo $v['name'] ?>" href="<?php echo $v['url'] ?>">
                    <label style="cursor: pointer"><strong><?php echo $v['name'] ?></strong></label>
                </a>        
            </td>
            <td>
                <a  href="<?php echo $v['url'] ?>" target="_blanck">
                    <img src="<?php echo $v['icon'] ?>" border="0" style="width:20px;height:20px;" title="Ver"/>
                </a>
            </td>
            <td>
                <a  href="<?php echo $v['download']!=''?$v['download']:$v['url'] ?>" <?php if($v['download']==''): ?> target="_blanck" <?php endif; ?>>
                    <img src="/images/descargar-documento.jpg" border="0" style="width:20px;height:20px;" title="Descargar"/>
                </a>    
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</fieldset>    
<?php endif; ?>
