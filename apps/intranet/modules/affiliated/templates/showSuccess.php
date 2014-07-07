<script type="text/javascript" src="/fancybox/lib/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<link rel="stylesheet" type="text/css" href="/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<!-- Add Media helper (this is optional) -->
<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript">
$(document).ready(function()
{
  // Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
  $('.fancybox-media')
  .fancybox({
    openEffect : 'none',
    closeEffect : 'none',
    prevEffect : 'none',
    nextEffect : 'none',

    arrows : false,
    helpers : {
      media : {},
      buttons : {}
    }
  }); 
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
  
  //
  $(".fancybox-manual-c").click(function()
  {
    var id = $(this).attr('id');
    $.fancybox.open({
      href : id,
      type : 'iframe',
      padding : 5
    });
  });
  
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
<div class="content">
  <div class="rightside">
    <div class="paneles" style="text-align:center;">
      <img src="/<?php echo $logo ? 'uploads/company/'.$logo : 'images/no_image.jpg' ?>" border="0" width="150" height="150" title="<?php echo $oValue->getName() ?>" alt="<?php echo $oValue->getName() ?>"/><br/>
    </div>
    <?php if ($oValue->getContactFirstName() || $oValue->getContactLastName()): ?>
	    <div class="paneles">
	      <h1>Ceo</h1> 
	      <table width="100%" border="0" cellpadding="0" cellspacing="3">
	        <tr><td><?php echo $oValue->getContactFirstName().' '.$oValue->getContactLastName() ?></td></tr>
	        <tr><td><?php echo $oValue->getContactPhone() ?></td></tr>
	        <tr><td><?php echo $oValue->getContactEmail() ?></td></tr>
	      </table>
	    </div>
    <?php endif; ?>
    <div class="paneles">
      <h1>Socios Responsables</h1> 
      <table width="100%" border="0" cellpadding="0" cellspacing="3">
        <?php foreach ($partners_company AS $p_value): ?>
        <?php $_img_user = $p_value->getAppUser()->getPhoto()? 'uploads/user/'.ServiceFileHandler::getThumbImage($p_value->getAppUser()->getPhoto()) : 'images/no_user.jpg'; ?>
        <tr>
          <td class="fancybox-manual-b" id="<?php echo $p_value->getAppUser()->getId() ?>" style="cursor: pointer">
            <img src="/<?php echo $_img_user ?>" width="20" height="20" alt="User" border="0" style="vertical-align: middle"/>
            &nbsp;&nbsp;&nbsp;
            <?php echo $p_value->getAppUser()->getTitle().' '.$p_value->getAppUser()->getName().' '.$p_value->getAppUser()->getLastName() ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <div class="paneles" id="conten-calendar" >
      <?php include_component('calendar', 'calendar') ?>
    </div>
  </div>
  <div style="width:350px;float:right;">
      <?php if(count($arrDatos) > 0): ?>
      <div class="paneles" style="overflow-y: auto; height: 175px;">
        <h1>Basecamp</h1>
        <table width="100%" cellspacing="0" border="0" class="listados">
          <tr>
            <th width="5%"></th>  
            <th width="25%" align="left"><?php echo __('Id') ?></th>
            <th width="65%" align="left"><?php echo __('Nombre') ?></th>
          </tr>
          <?php foreach ($arrDatos as $k_item => $v_item): ?>
          <?php $fixed = str_replace('.', '-', $v_item);?>
          <tr class="<?php if (!empty($odd_i)) { echo 'gris'; $odd_i=0; } else { echo 'blanco'; $odd_i=1; } ?> fancybox-manual-c" id="<?php echo url_for('@task-list?id='.$k_item.'&project='.$fixed.'&account='.$basecamp_id) ?>" style="cursor: pointer">
            <td><img src="/images/basecamp.png" border="0"/></td>
            <td><?php echo $k_item ?></td>
            <td><?php echo $v_item ?></td>
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
          <tr class="<?php if (!empty($odd_i)) { echo 'gris'; $odd_i=0; } else { echo 'blanco'; $odd_i=1; } ?>" style="cursor: pointer" onclick="document.location='<?php echo url_for('@information-show?id='.$value->getId()) ?>'">
            <td><img src="/images/acta.png" border="0"/></td>
            <td><?php echo Common::getFormattedDate($value->getCreatedAt() , 'd/m/Y') ?></td>
            <td><?php echo $value->getName() ?></td>
            <td><?php echo $value->getTypeInformation()->getName() ?></td>
          </tr> 
          <?php endforeach; ?>
        </table>
      </div>
    <?php endif; ?>
    
    <?php if (count($videos) > 0): ?>
      <div class="paneles" style="overflow-y: auto; height: 175px;">
        <h1>Vídeos</h1>
        <table width="100%" cellspacing="0" border="0" class="listados">
            <tr>
              <th width="5%"></th>  
              <th width="25%" align="left"><?php echo __('Date') ?></th>
              <th width="65%" align="left"><?php echo __('Titulo') ?></th>
            </tr>
            <?php foreach ($videos AS $v_value): ?>
            <tr class="<?php if (!empty($odd_i)) { echo 'gris'; $odd_i=0; } else { echo 'blanco'; $odd_i=1; } ?>">
              <td><img src="/images/video.jpeg" border="0" style="width:20px;height:20px;"/></td>
              <td><?php echo Common::getFormattedDate($v_value->getCreatedAt() , 'd/m/Y') ?></td>
              <td>
                <a class="fancybox-media" title="<?php echo $v_value->getName() ?>" href="<?php echo $v_value->getUrl() ?>">
                  <?php echo $v_value->getName() ?>
                </a>
             </td>
            </tr> 
          <?php endforeach; ?>
        </table>
      </div>
    <?php endif; ?>
    <?php if (count($document_c) > 0 ): ?>
            <div class="paneles" id="div_doc_c" style="overflow-y: auto; height: 175px;">
              <h1>Documentos Comerciales </h1>
              <table width="100%" cellspacing="0" id="table_doc_c" border="0" class="listados">
                  <tr>
                    <th width="25%" align="left"><?php echo __('Date') ?></th>
                    <th width="65%" align="left"><?php echo __('Titulo') ?></th>
                    <th width="10%" align="center"></th>
                    <th width="10%" align="center"></th>
                  </tr>
                  <?php foreach ($document_c AS $d_value): ?>
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
    <?php if (count($document_o) > 0 ): ?>
            <div class="paneles" id="div_doc_o" style="overflow-y: auto;height: 175px;">
              <h1>Otros Documentos</h1>
              <table width="100%" cellspacing="0" border="0" id="table_doc_o" class="listados">
                  <tr>
                    <th width="25%" align="left"><?php echo __('Date') ?></th>
                    <th width="65%" align="left"><?php echo __('Titulo') ?></th>
                    <th width="10%" align="center"></th>
                    <th width="10%" align="center"></th>
                  </tr>
                  <?php foreach ($document_o AS $d_value): ?>
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
    <div class="leftside" style="margin-left:260px;">
        <div class="mapa">
                <a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
                &nbsp;&gt;&nbsp;
                <a href="<?php echo url_for('affiliated/index') ?>"><strong><?php echo __('Empresas Participadas') ?></strong></a>
                &nbsp;&gt;&nbsp;
                <?php echo $oValue->getName(); ?>
        </div>
        <h1 class="titulos" style="border:none;">
                <?php echo $oValue->getName() ?>
                <span style="padding-left:20px;font-size:15px;">[&nbsp;<?php echo Common::getFormattedDate($oValue->getDate(),'d/m/Y') ?>&nbsp;]</span>
        </h1>
        <?php if ($oValue->getDescription()): ?>
        <fieldset style="width:60%;">
                <table width="100%" cellspacing="4" cellpadding="2" border="0">
        <tr>
        <td class="text_detail"><?php echo html_entity_decode($oValue->getDescription()) ?></td>
                        </tr>
                </table>
        </fieldset>
        <?php endif; ?>    

        <div style="padding-top:10px;" class="botonera">
        <?php if ($sf_user->hasCredential('super_admin')): ?> 
        <input type="button" onclick="document.location='<?php echo url_for('affiliated/edit?id='.$oValue->getId()) ?>';" value="<?php echo __('Edit') ?>" class="boton" />
        <?php endif; ?>
        <input type="button" onclick="document.location='<?php echo url_for('affiliated/index') ?>';" value="<?php echo __('Continue to list') ?>" class="boton" />
        </div>
    </div>
    <div class="clear"></div>
</div>