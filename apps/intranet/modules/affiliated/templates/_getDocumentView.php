<?php if(count($result_document)>0): ?>
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
        </tr>
        <?php endforeach; ?>
    </table>
</fieldset>    
<?php endif; ?>
