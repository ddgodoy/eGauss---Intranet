<script type="text/javascript">
$(document).ready(function(){
    $('#btn_action_product').click(function(){
       var product           = $('#product').val();
       var percentage        = $('#percentage').val();
       var string_in_company = $('#string_in_company').val(); 
       var url               = '<?php echo url_for('@set-temp-product') ?>'; 
       var id                = $('#contracts_intermediation_id').val();
       jQuery.ajax({
            type: 'POST',
            url: url,
            data: 'id='+id+'&product='+product+'&percentage='+percentage+'&string_in_company='+string_in_company,
            success: function(data) {
                $('#products_div').html(data);
            }
       });
    });
    
    $('.delete-product').click(function(){
       var string_in_company = $('#string_in_company').val(); 
       var url               = '<?php echo url_for('@delete-products-by-company') ?>'; 
       var id                = $('#contracts_intermediation_id').val();
       var id_array          = $(this).attr('id');
       var type              = $(this).attr('alt');  
       jQuery.ajax({
            type: 'POST',
            url: url,
            data: 'id='+id+'&id_array='+id_array+'&type='+type+'&string_in_company='+string_in_company,
            success: function(data) {
                $('#products_div').html(data);
            }
       });
    });
});
</script>
<fieldset>
<legend><?php echo __('Productos') ?></legend>
    <?php if(count($products_array)>0): ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="listados">
        <tr>
            <th width="50%"><a><?php echo __('Producto') ?></a></th>
            <th width="30%"><a><?php echo __('Porcentaje') ?></a></th>
            <th></th>
        </tr>
        <?php foreach ($products_array AS $k=>$item): ?> 
        <tr class="<?php if (!empty($odd)) { echo 'gris'; $odd=0; } else { echo 'blanco'; $odd=1; } ?>">
            <td><?php echo $item['name'] ?></td>
            <td><?php echo $item['percentage'] ?>%</td>
            <td align="center">
                     <a class="delete-product" id="<?php echo !empty($item['id'])?$item['id']:$k ?>" alt="<?php echo $item['type'] ?>" style="cursor: pointer">
                            <img border="0" src="/images/borrar.png" alt="<?php echo __('Delete') ?>" title="<?php echo __('Delete') ?>">
                    </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    <br/>
    <br/>
    <?php if($string_in_company != '(0)'):?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="listados">
        <tr>
            <td>Producto</td>
            <td><?php echo select_tag('product', options_for_select($select_products), array('id'=>'product')) ?></td>
            <td>Porcentaje</td>
            <td><input type="text" id="percentage" name="percentage" style="width:100px;" class="form_input">%</td>
            <td>
                <input type="botton" id="btn_action_product" class="boton" value="Registrar" name="btn_action" style="text-align: center;width: 100px;">
            </td>
        </tr>
    </table>
    <?php else: ?>
        <div class="mensajeSistema error">
                <ul>
                    <li>Para registrar un producto, seleccione una empresa o participada </li>      
                </ul>
        </div>
    <?php endif; ?>
</fieldset>    
    
