<script type="text/javascript" src="/sfFormExtraPlugin/js/double_list.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   $('.no_letters').keydown(function(event) {
        if(event.shiftKey)
        {
             event.preventDefault();
        }

        if (event.keyCode == 46 || event.keyCode == 8)    {
        }
        else {
             if (event.keyCode < 95) {
               if (event.keyCode < 48 || event.keyCode > 57) {
                     event.preventDefault();
               }
             }
             else {
                   if (event.keyCode < 96 || event.keyCode > 105) {
                       event.preventDefault();
                   }
             }
           }
   });
   
   $(".checked-company").click(function(){
        var value   = $(this).val();
        if(value == 1){
            $("#select_company").show();
            $("#input_company").hide();
        }else{
            $("#select_company").hide();
            $("#input_company").show();
        }
    });
    
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
    
    $('#arrow_associate_contracts_intermediation_affiliated').click(function(){
            view_doble_select()
    });
    
    $('#arrow_unassociate_contracts_intermediation_company').click(function(){
            view_doble_select()
    });
    
    $('#arrow_associate_contracts_intermediation_company').click(function(){
           view_doble_select() 
    });
    
    $('#arrow_unassociate_contracts_intermediation_affiliated').click(function(){
           view_doble_select() 
    });
    
    
    
});

function view_doble_select()
{
    var id = $('#contracts_intermediation_id').val();
    var in_company = '(0,';
    var url = '<?php echo url_for('@new-products-by-company') ?>';
    $("#contracts_intermediation_affiliated option").each(function(){
        in_company += $(this).attr('value')+',';
    });

    $("#contracts_intermediation_company option").each(function(){
        in_company += $(this).attr('value')+',';
    });

    var result_in_company = in_company.substring(0, in_company.length-1);
    result_in_company += ')';
    $('#string_in_company').val(result_in_company);
    
    jQuery.ajax({
            type: 'POST',
            url: url,
            data: 'id='+id+'&string_in_company='+result_in_company,
            success: function(data) {
                $('#products_div').html(data);
            }
       });
}

</script>
<?php
	$str_module   = $sf_params->get('module');
	$str_action   = $sf_params->get('action');
	$request_id   = $id ?  "?id=$id" : '';
?>
<div class="content">
	<div class="rightside">
            <div class="paneles" id="conten-calendar">
                <?php include_component('calendar', 'calendar') ?>
            </div> 
        </div>
	<div class="leftside" style="margin-left:260px;">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('contracts/index') ?>"><strong><?php echo __('Contratos de Intermediación') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __(ucfirst($str_action)) ?>
		</div>
		<?php if ($form->hasErrors()): ?>
			<div class="mensajeSistema error">
				<ul>
					<?php foreach($form->getFormFieldSchema() as $name=>$formField) { if ($formField->getError()) { echo '<li>'.$formField->getError().'</li>'; } } ?>
				</ul>
			</div>
		<?php endif; ?>
		<h1 class="titulos">
			<?php echo __(ucfirst($str_action)).' '.__('Contratos de Intermediación') ?>
		</h1>
		<form enctype="multipart/form-data" method="post" action="<?php echo url_for('@'.$str_module.'-'.$str_action.$request_id) ?>">
                    <label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label><br />
			<fieldset>
                            <fieldset>
                                <legend><?php echo __('Cliente') ?></legend>
                                <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                    <tr>
                                        <td><?php echo $form['customer'] ?></td>
                                    </tr>
                                </table>
                            </fieldset>
                            <fieldset style="margin-top:20px;">
                                    <legend style="padding:0px 10px 0px 10px;">Empresa</legend>
                                    <table width="100%" cellspacing="4" cellpadding="0" border="0" id="select_company">
                                            <tr>
                                                <td><?php echo $form['company'] ?></td>
                                            </tr>
                                    </table>
                            </fieldset>
                            <fieldset style="margin-top:20px;" style="display: none">
                                    <legend style="padding:0px 10px 0px 10px;">Participada</legend>
                                    <table width="100%" cellspacing="4" cellpadding="0" border="0" id="select_company">
                                            <tr>
                                                <td><?php echo $form['affiliated'] ?></td>
                                            </tr>
                                    </table>
                            </fieldset>
                            <div id="products_div">
                                <?php include_component('contracts', 'getProductByCompany', array('string_in_company'=>$string_in_company)) ?>
                            </div>
                            <input type="hidden" id="string_in_company" value="<?php echo $string_in_company ?>" />
                            <fieldset>
                                <legend><?php echo __('Contrato de Intermediación') ?></legend>
                                    <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                        <tr>
                                                <td width="20%"><label><?php echo __('Name') ?> *</label></td>
                                                <td><?php echo $form['name'] ?></td>
                                        </tr>
                                        <tr>
                                                <td width="20%"><label><?php echo __('Mes previsto de ingresos') ?> *</label></td>
                                                <td><?php echo $form['month'] ?>&nbsp;/&nbsp;<?php echo $form['year'] ?></td>
                                        </tr>
                                        <tr>
                                                <td width="20%"><label><?php echo __('Volumen negocio') ?> *</label></td>
                                                <td><?php echo $form['business_amount'] ?></td>
                                        </tr>
                                        <tr>
                                                <td width="20%"><label><?php echo __('% Intermediacion') ?> *</label></td>
                                                <td><?php echo $form['intermediation'] ?></td>
                                        </tr>
                                        <tr>
                                                <td width="10%"><label><?php echo __('Comisión final') ?> *</label></td>
                                                <td><?php echo $form['final_commission'] ?></td>
                                        </tr>
                                        <tr>
                                                <td width="10%"><label><?php echo __('Cobrado') ?> </label></td>
                                                <td><?php echo $form['cashed'] ?></td>
                                        </tr>
                                    </table>
                                </fieldset>
                                <fieldset>
                                    <legend><?php echo __('Reuniones') ?></legend>
                                    <div id="div-reunion">
                                        <?php include_component('contracts', 'getReunionByContract') ?>
                                    </div>
                                    <div>
                                        <?php if (count($error_calendar) > 0): ?>
                                        <div class="mensajeSistema error">
                                            <ul>
                                             <?php foreach ($error_calendar as $e): ?><li><?php echo $e ?></li><?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <?php endif; ?>
                                        <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                            <tr>
                                                    <td width="10%"><label><?php echo __('Date') ?> *</label></td>
                                                    <td><?php echo $form['date'] ?></td>
                                            </tr>
                                            <tr>
						<td width="6%"><label><?php echo __('Inicio') ?> *</label></td>
						<td><?php echo $form['hour_from'] ?></td>
                                            </tr>
                                            <tr>
						<td width="6%"><label><?php echo __('Fin') ?> *</label></td>
						<td><?php echo $form['hour_to'] ?></td>
                                            </tr>
                                            <tr>
                                                    <td width="10%"><label><?php echo __('Tema') ?> *</label></td>
                                                    <td><?php echo $form['subject'] ?></td>
                                            </tr>
                                            <tr><td style="height: 15px;"></td></tr>
                                            <tr>
                                                <td colspan="2"><?php echo $form['body'] ?></td>
                                            </tr>
                                        </table>  
                                    </div>
                                </fieldset>    
                                <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                <tr><td style="height: 15px;"></td></tr>
                                <tr>
                                    <td colspan="2">
                                        <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                            <tr>
                                                <td><?php echo $form['observations'] ?></td>
                                            </tr>    
                                        </table>
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
                                    <?php include_component('contracts', 'getDocument') ?>
                                </div>
                        </fieldset>
                        <div style="padding-top:10px;" class="botonera">
				<input type="button" onclick="document.location='<?php echo url_for($str_module.'/index') ?>';" value="<?php echo __('Cancel') ?>" class="boton" />
                                <?php if($id): ?>
                                    <input type="button" onclick="document.location='<?php echo url_for('@'.$str_module.'-show?id='.$id) ?>';" value="<?php echo __('See') ?>" class="boton" />
                                <?php endif; ?>
				<input type="submit" name="btn_action" value="<?php echo __('Register') ?>" class="boton" id="btn_action"/>
                                <?php echo $form->renderHiddenFields() ?>
			</div>
                </form>
	</div>
	<div class="clear"></div>
</div>    