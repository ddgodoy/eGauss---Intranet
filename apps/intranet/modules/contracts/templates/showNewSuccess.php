<script type="text/javascript">
$(document).ready(function()
{
//
  $(".fancybox-manual-b").click(function()
  {
    var id = $(this).attr('id');
    $.fancybox.open({
      href : '<?php echo url_for('@user-view?id=') ?>'+id,
      type : 'iframe',
      padding : 5
    });
  });
  
  $(".fancybox-manual-company").click(function()
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
<div class="content">
        <div style="width:29%;float:right;">
            <?php if(!$sf_user->hasCredential('clientes') && !$sf_user->hasCredential('socios_empresa')): ?>
            <div class="paneles" id="conten-calendar" >
                <?php include_component('calendar', 'calendar') ?>
            </div>
            <?php endif; ?>
            <?php if(count($reunion_action)>0): ?>
            <div class="paneles" style="overflow-y: auto; height: 280px;">
                <h1><?php echo __('Reuniones') ?></h1>
                <div id="div-reunion">
                    <?php include_component('contracts', 'getReunionByContract') ?>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($product): ?>
            <div class="paneles" style="overflow-y: auto; height: 175px;">
              <h1>Productos</h1>
              <table width="100%" cellspacing="0" border="0" class="listados">
                <tr>
                  <th width="25%" align="left"><?php echo __('Productos') ?></th>
                </tr>
                <?php foreach ($product AS $pr_value): ?>
                <tr class="<?php if (!empty($odd_i)) { echo 'gris'; $odd_i=0; } else { echo 'blanco'; $odd_i=1; } ?>">
                  <td><?php echo $pr_value->getProducts()->getName().' - ('.$pr_value->getRegisteredCompanies()->getName().')' ?></td>
                </tr> 
                <?php endforeach; ?>
              </table>
            </div>
            <?php endif; ?>
            <?php if (count($information) > 0): ?>
            <div class="paneles" style="overflow-y: auto; height: 175px;">
              <h1>Últimas noticias</h1>
              <table width="100%" cellspacing="0" border="0" class="listados">
                <tr>
                  <th width="5%"></th>  
                  <th width="25%" align="left"><?php echo __('Date') ?></th>
                  <th width="65%" align="left"><?php echo __('Titulo') ?></th>
                  <th width="25%" align="left"><?php echo __('Categoría') ?></th>
                </tr>
                <?php foreach ($information AS $value): ?>
                <tr class="<?php if (!empty($odd_i)) { echo 'gris'; $odd_i=0; } else { echo 'blanco'; $odd_i=1; } ?> fancybox-manual-company" style="cursor: pointer" id="<?php echo url_for('@information-show?id='.$value->getId().'&iframe=1') ?>">
                  <td><img src="/images/acta.png" border="0"/></td>
                  <td><?php echo Common::getFormattedDate($value->getCreatedAt() , 'd/m/Y') ?></td>
                  <td><?php echo $value->getName() ?></td>
                  <td><?php echo $value->getTypeInformation()->getName() ?></td>
                </tr> 
                <?php endforeach; ?>
              </table>
            </div>
            <?php endif; ?>
            <?php if (count($document) > 0 ): ?>
            <div class="paneles" id="div_doc_c" style="overflow-y: auto; height: 175px;">
              <h1>Documentos</h1>
              <table width="100%" cellspacing="0" id="table_doc_c" border="0" class="listados">
                  <tr>
                    <th width="25%" align="left"><?php echo __('Date') ?></th>
                    <th width="65%" align="left"><?php echo __('Titulo') ?></th>
                    <th width="10%" align="center"></th>
                    <th width="10%" align="center"></th>
                  </tr>
                  <?php foreach ($document AS $d_value): ?>
                  <tr class="<?php if (!empty($odd_i)) { echo 'gris'; $odd_i=0; } else { echo 'blanco'; $odd_i=1; } ?>">
                    <td><a class="fancybox-manual-d" dir="<?php echo $d_value->getId() ?>" style="text-decoration: none; cursor: pointer "><?php echo Common::getFormattedDate($d_value->getCreatedAt() , 'd/m/Y') ?></a></td>
                    <td><a class="fancybox-manual-d" dir="<?php echo $d_value->getId() ?>" style="text-decoration: none; cursor: pointer "><?php echo $d_value->getName() ?></a></td>
                    <td>
                        <a  href="<?php echo $d_value->getUrl() ?>" target="_blanck">
                            <img src="<?php echo $d_value->getIcon()  ?>" border="0" style="width:20px;height:20px;" title="Ver"/>
                        </a>
                    </td>
                    <td>
                        <a  href="<?php echo $d_value->getDownload()?$d_value->getDownload():$d_value->getUrl() ?>" <?php if(!$d_value->getDownload()): ?> target="_blanck" <?php endif; ?>>
                            <img src="/images/descargar-documento.jpg" border="0" style="width:20px;height:20px;" title="Descargar"/>
                        </a>    
                    </td>
                  </tr>
                  <?php endforeach; ?>
              </table>
            </div>
            <?php endif; ?>
        </div>
	<div class="leftside" style="width: 70%">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('contracts/index') ?>"><strong><?php echo __('Contratos de Intermediación') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo $oValue->getName(); ?>
		</div>
		<h1 class="titulos"><?php echo $oValue->getName() ?></h1>
                <h6 class="titulos" style=" color: #1B6577">Mes previsto de ingresos:&nbsp;&nbsp;<?php echo $month[$oValue->getMonth()].' -- '.$oValue->getYear() ?></h6>
                <table width="100%" cellpadding="2" border="0">
                    <tr>
                        <td style="vertical-align: top">
                            <fieldset style="height: 160px;">
                                <legend><?php echo __('Cliente') ?></legend>
                                <table width="100%" cellspacing="4" cellpadding="2" border="0">
                                    <?php foreach ($customer AS $p_value): ?>
                                    <?php $_img_user = $p_value->getAppUser()->getPhoto()? 'uploads/user/'.ServiceFileHandler::getThumbImage($p_value->getAppUser()->getPhoto()) : 'images/no_user.jpg'; ?>
                                    <tr>
                                      <td class="fancybox-manual-b" id="<?php echo $p_value->getAppUser()->getId() ?>">
                                        <img src="/<?php echo $_img_user ?>" width="20" height="20" alt="User" border="0" style="vertical-align: middle; cursor: pointer"/>
                                        &nbsp;&nbsp;&nbsp;
                                        <label style="cursor: pointer"><b><?php echo $p_value->getAppUser()->getName().' '.$p_value->getAppUser()->getLastName() ?></b></label>
                                      </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </table>
                            </fieldset>
                        </td>
                        <?php if($company): ?>
                        <td style="vertical-align: top">
                            <fieldset style="height: 160px;">
                                <legend><?php echo __('Empresa') ?></legend>
                                <table width="100%" cellspacing="4" cellpadding="2" border="0">
                                    <?php foreach ($company AS $c_value): ?>
                                    <tr>
                                        <td class="fancybox-manual-company text_detail" id="<?php echo url_for('@company-show?id='.$c_value->getRegisteredCompaniesId().'&iframe=1') ?>">
                                        <img style=" width: 50px; height: 50px; vertical-align: middle; cursor: pointer" src="/<?php echo $c_value->getRegisteredCompanies()->getLogo() ? 'uploads/company/'.$c_value->getRegisteredCompanies()->getLogo() : 'images/no_image.jpg' ?>" alt="<?php echo $c_value->getRegisteredCompanies()->getName() ?>" title="<?php echo $c_value->getRegisteredCompanies()->getName() ?>" border="0"/>
                                        &nbsp;&nbsp;&nbsp;
                                        <label style="cursor: pointer"><b><?php echo $c_value->getRegisteredCompanies()->getName() ?></b></label>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </table>
                            </fieldset>        
                        </td>
                        <?php endif; ?>
                        <?php if($affiliated): ?>
                        <td style="vertical-align: top">
                            <fieldset style="height: 160px;">
                                <legend><?php echo __('Participadas') ?></legend>
                                <table width="100%" cellspacing="4" cellpadding="2" border="0">
                                    <?php foreach ($affiliated AS $a_value): ?>
                                    <tr>
                                        <td class="fancybox-manual-company text_detail" id="<?php echo url_for('@affiliated-show?id='.$a_value->getRegisteredCompaniesId().'&iframe=1') ?>">
                                        <img style=" width: 50px; height: 50px; vertical-align: middle; cursor: pointer" src="/<?php echo $a_value->getRegisteredCompanies()->getLogo() ? 'uploads/company/'.$a_value->getRegisteredCompanies()->getLogo() : 'images/no_image.jpg' ?>" alt="<?php echo $a_value->getRegisteredCompanies()->getName() ?>" title="<?php echo $a_value->getRegisteredCompanies()->getName() ?>" border="0"/>
                                        &nbsp;&nbsp;&nbsp;
                                        <label style="cursor: pointer"><b><?php echo $a_value->getRegisteredCompanies()->getName() ?></b></label>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </table>
                            </fieldset>        
                        </td>
                        <?php endif; ?>
                    </tr>   
                </table>
                <?php if($sf_user->hasCredential('super_admin')): ?>
                <table width="100%" cellspacing="4" cellpadding="2" border="0">
                    <tr>    
                        <td style="vertical-align: top;">
                            <fieldset style="height: 160px;">
                                <legend><?php echo __('Contrato de Intermediación') ?></legend>
                                <table width="100%" cellspacing="4" cellpadding="2" border="0">
                                    <tr>
                                        <td><label><b>Volumen negocio:</b></label></td>
                                        <td class="text_detail"><?php echo $oValue->getBusinessAmount() ?></td>
                                    </tr>
                                    <tr>
                                        <td><label><b>% Intermediacion:</b></label></td>
                                        <td class="text_detail"><?php echo $oValue->getIntermediation() ?></td>
                                    </tr>
                                    <tr>
                                        <td><label><b>Comisión final:</b></label></td>
                                        <td class="text_detail"><?php echo $oValue->getFinalCommission() ?></td>
                                    </tr>

                                </table>
                            </fieldset>
                        </td>
                    </tr>
                </table>
                <?php endif; ?>
		<?php if($oValue->getObservations()): ?>
                <fieldset>
			<table width="100%" cellspacing="4" cellpadding="2" border="0">
                                <tr>
                                    <td class="text_detail"><?php echo html_entity_decode($oValue->getObservations()) ?></td>
				</tr>
			</table>
		</fieldset>
                <?php endif; ?>
                <div id='commnet-div'>
                    <?php include_component('contracts', 'commentByContract') ?>
                </div>
		<div style="padding-top:10px;" class="botonera">
                     <?php if($sf_user->hasCredential('super_admin')): ?> 
			<input type="button" onclick="document.location='<?php echo url_for('contracts/edit?id='.$oValue->getId()) ?>';" value="<?php echo __('Edit') ?>" class="boton" />
                     <?php endif; ?>   
			<input type="button" onclick="document.location='<?php echo url_for('contracts/index') ?>';" value="<?php echo __('Continue to list') ?>" class="boton" />
		</div>
	</div>
	<div class="clear"></div>
</div>