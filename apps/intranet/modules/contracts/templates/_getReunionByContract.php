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
    });
    
     $(".fancybox-manual-cal").click(function()
     {
       var id = $(this).attr('id');
       $.fancybox.open({
         href : id,
         type : 'iframe',
         padding : 5
       });
     });
});
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listados">
    <tr>
        <th width="10%"><a><?php echo __('Date') ?></a></th>
        <th width="10%"><a><?php echo __('Inicio') ?></a></th>
        <th width="60%"><a><?php echo __('Subject') ?></a></th>
        <th></th>
    </tr>
    <?php foreach ($reunion AS $item): ?> 
    <tr class="<?php if (!empty($odd)) { echo 'gris'; $odd=0; } else { echo 'blanco'; $odd=1; } ?>">
        <td><?php echo $item->getDay().'/'.$item->getMonth().'/'.$item->getYear() ?></td>
        <td><?php echo $item->getHourFrom() ?></td>
        <td><?php echo $item->getSubject() ?></td>
        <?php if($sf_user->hasCredential('super_admin') && ($sf_params->get('action') == 'edit' || $sf_params->get('action') == 'deleteReunionByContract')): ?>
        <td align="center">
        	<a class="delete-reunion" id="<?php echo $item->getId() ?>" style="cursor: pointer">
        		<img border="0" src="/images/borrar.png" alt="<?php echo __('Delete') ?>" title="<?php echo __('Delete') ?>">
        	</a>
        </td>
        <?php else: ?>
        <td align="center">
            <a class="fancybox-manual-cal" id="<?php echo url_for('@calendar-show?id='.$item->getId().'&sch_year='.$item->getYear().'&sch_month='.$item->getMonth().'&sch_day='.$item->getDay().'&iframe=1') ?>" style="cursor: pointer">
                    <img border="0" src="/images/calendario.gif" alt="<?php echo __('See') ?>" title="<?php echo __('See') ?>">
            </a>
        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>
<br/>
<br/>
<?php endif; ?>
