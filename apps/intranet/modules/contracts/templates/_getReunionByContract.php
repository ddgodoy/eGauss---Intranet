<?php if($reunion): ?>
<script type="text/javascript">
$(document).ready(function(){
    $('.delete-reunion').click(function(){
        if(confirm('<?php echo __('Are you sure?') ?>')){
            var url = '<?php echo url_for("@delete-reunion-by-contract") ?>';
            var id  = '<?php echo $id ?>';
            jQuery.ajax({
            type: 'POST',
            url: url,
            data: 'id='+id+'&id_reunion='+$(this).attr('id'),
            success: function(data) {
               $('#div-reunion').html(data);
             }
            });   
        }
    })  
});
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listados">
    <?php foreach ($reunion AS $r): ?> 
    <tr class="<?php if (!empty($odd)) { echo 'gris'; $odd=0; } else { echo 'blanco'; $odd=1; } ?>">
        <td width="10%"><label><?php echo Common::getFormattedDate($r->getDate(),'d/m/Y') ?></label></td>
        <td><?php echo html_entity_decode($r->getComments()) ?></td>
        <?php if($sf_user->hasCredential('super_admin') && ($sf_params->get('action') == 'edit' || $sf_params->get('action') == 'deleteReunionByContract')): ?>
        <td align="center">
        	<a class="delete-reunion" id="<?php echo $r->getId() ?>" style="cursor: pointer">
        		<img border="0" src="/images/borrar.png" alt="<?php echo __('Delete') ?>" title="<?php echo __('Delete') ?>">
        	</a>
        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>
<br/>
<br/>
<?php endif; ?>
