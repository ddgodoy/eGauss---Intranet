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
$(document).ready(function() {
    /*
     *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
     */
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
    
    $(".fancybox-manual-b").click(function() {
            var id = $(this).attr('id');
            $.fancybox.open({
                    href : '<?php echo url_for('@user-view?id=') ?>'+id,
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
            <div class="paneles"  >
                <h1>Ceo</h1> 
                <table width="100%" border="0" cellpadding="0" cellspacing="3">
                    <tr><td><?php echo $oValue->getContactFirstName().' '.$oValue->getContactLastName() ?></td></tr>
                    <tr><td><?php echo $oValue->getContactPhone() ?></td></tr>
                    <tr><td><?php echo $oValue->getContactEmail() ?></td></tr>
                </table>
            </div>
            <div class="paneles"  >
                <h1>Socios Responsables</h1> 
                <table width="100%" border="0" cellpadding="0" cellspacing="3">
                    <?php foreach ($partners_company AS $p_value): ?>
                    <?php $_img_user = $p_value->getAppUser()->getPhoto()? 'uploads/user/'.ServiceFileHandler::getThumbImage($p_value->getAppUser()->getPhoto()) : 'images/no_user.jpg'; ?>
                    <tr>
                        <td class="fancybox-manual-b" id="<?php echo $p_value->getId() ?>" style="cursor: pointer">
                            <img src="/<?php echo $_img_user ?>" width="20" height="20" alt="User" border="0" style="vertical-align: middle"/>
                            &nbsp;&nbsp;&nbsp;
                            <?php echo $p_value->getAppUser()->getName().' '.$p_value->getAppUser()->getLastName() ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="paneles" id="conten-calendar" >
              <?php include_component('calendar', 'calendar') ?>
            </div>
        </div>
        <div style="width: 350px; float: right; margin-top: 122px;">
            <?php if(count($information)>0): ?>
            <div class="paneles" style="overflow-y: auto; height: 175px;">
                <h1>Información</h1>
                <table width="100%" cellspacing="0" border="0" class="listados">
                    <tr>
                      <th width="5%"></th>  
                      <th width="25%" align="left"><?php echo __('Date') ?></th>
                      <th width="65%" align="left"><?php echo __('Titulo') ?></th>
                      <th width="25%" align="left"><?php echo __('Categoría') ?></th>
                    </tr>
                    <?php foreach ($information AS $value): ?>
                    <tr class="<?php if (!empty($odd_i)) { echo 'gris'; $odd_i=0; } else { echo 'blanco'; $odd_i=1; } ?>" style="cursor: pointer" onclick="document.location='<?php echo url_for('@information-show?id='.$value->getId()) ?>'">
                        <td>
                            <img src="/images/acta.png" border="0"/>
                        </td>
                        <td><?php echo Common::getFormattedDate($value->getCreatedAt() , 'd/m/Y') ?></td>
                        <td><?php echo $value->getName() ?></td>
                        <td><?php echo $value->getTypeInformation()->getName() ?></td>
                    </tr> 
                    <?php endforeach; ?>
                </table>
            </div> 
            <?php endif; ?> 
            <?php if(count($information)>0): ?>
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
                        <td>
                            <img src="/images/video.jpeg" border="0" style=" width: 20px; height: 20px;"/>
                        </td>
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
            <?php if(count($document)>0): ?>
            <div class="paneles" style="overflow-y: auto; height: 175px;">
                <h1>Documentos</h1>
                <table width="100%" cellspacing="0" border="0" class="listados">
                    <tr>
                      <th width="5%"></th>  
                      <th width="25%" align="left"><?php echo __('Date') ?></th>
                      <th width="65%" align="left"><?php echo __('Titulo') ?></th>
                      <th width="25%" align="left"><?php echo __('Categoría') ?></th>
                    </tr>
                    <?php foreach ($document AS $d_value): ?>
                    <tr class="<?php if (!empty($odd_i)) { echo 'gris'; $odd_i=0; } else { echo 'blanco'; $odd_i=1; } ?>" style="cursor: pointer" onclick="window.open('<?php echo $d_value->getUrl()?>')">
                        <td>
                            <img src="<?php echo $d_value->getIcon()  ?>" border="0" style=" width: 20px; height: 20px;"/>
                        </td>
                        <td><?php echo Common::getFormattedDate($d_value->getCreatedAt() , 'd/m/Y') ?></td>
                        <td><?php echo $d_value->getName() ?></td>
                        <td><?php echo $d_value->getTypeInformation()->getName() ?></td>
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
		<h1 class="titulos"><?php echo $oValue->getName() ?></h1>
                <h6 class="titulos" style=" color: #1B6577"><?php echo Common::getFormattedDate($oValue->getDate(),'d/m/Y') ?></h6>
		<?php if($oValue->getDescription()): ?>
                <fieldset style="width: 60%">
			<table width="100%" cellspacing="4" cellpadding="2" border="0">
                                <tr>
                                    <td class="text_detail"><?php echo html_entity_decode($oValue->getDescription()) ?></td>
				</tr>
			</table>
		</fieldset>
                <?php endif; ?>
		<div style="padding-top:10px;" class="botonera">
                     <?php if($sf_user->hasCredential('super_admin')): ?> 
			<input type="button" onclick="document.location='<?php echo url_for('affiliated/edit?id='.$oValue->getId()) ?>';" value="<?php echo __('Edit') ?>" class="boton" />
                     <?php endif; ?>   
			<input type="button" onclick="document.location='<?php echo url_for('affiliated/index') ?>';" value="<?php echo __('Continue to list') ?>" class="boton" />
		</div>
	</div>
	<div class="clear"></div>
</div>
