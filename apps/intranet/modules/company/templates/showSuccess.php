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
});
</script>
<div class="content">
        <div class="rightside">
            <div class="paneles" style="text-align:center;">
                <img src="/<?php echo $logo ? 'uploads/company/'.$logo : 'images/no_image.jpg' ?>" border="0" width="150" height="150" title="<?php echo $oValue->getName() ?>" alt="<?php echo $oValue->getName() ?>"/><br/>
            </div>
            <div class="paneles">
                <h1>Socios Responsables</h1> 
                <table width="100%" border="0" cellpadding="0" cellspacing="3">
                  <?php foreach ($partners_company AS $p_value): ?>
                  <?php $_img_user = $p_value->getAppUser()->getPhoto()? 'uploads/user/'.ServiceFileHandler::getThumbImage($p_value->getAppUser()->getPhoto()) : 'images/no_user.jpg'; ?>
                  <tr>
                    <td class="fancybox-manual-b" id="<?php echo $p_value->getAppUser()->getId() ?>" style="cursor: pointer">
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
	<div class="leftside" style="margin-left:260px;">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('company/index') ?>"><strong><?php echo __('Empresas') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo $oValue->getName(); ?>
		</div>
		<h1 class="titulos"><?php echo $oValue->getName() ?></h1>
                <h6 class="titulos" style=" color: #1B6577"><?php echo Common::getFormattedDate($oValue->getDate(),'d/m/Y') ?></h6>
		<?php if($oValue->getDescription()): ?>
                <fieldset>
			<table width="100%" cellspacing="4" cellpadding="2" border="0">
                                <tr>
                                    <td class="text_detail"><?php echo html_entity_decode($oValue->getDescription()) ?></td>
				</tr>
			</table>
		</fieldset>
                <?php endif; ?>
                <div id="videos">
                    <?php include_component('company', 'getVideosView') ?>
                </div>
                <div id="drive">
                    <?php include_component('company', 'getDocumentView') ?>
                </div>
                <?php if($oValue->getComments()): ?>
                <fieldset>
                    <legend>Comentario</legend>
                    <table width="100%" cellspacing="4" cellpadding="0" border="0">
                        <tr>
                            <td><?php echo html_entity_decode($oValue->getComments()) ?></td>
                        </tr>
                    </table>
                </fieldset>
                <?php endif; ?>
		<div style="padding-top:10px;" class="botonera">
                     <?php if($sf_user->hasCredential('super_admin')): ?> 
			<input type="button" onclick="document.location='<?php echo url_for('company/edit?id='.$oValue->getId()) ?>';" value="<?php echo __('Edit') ?>" class="boton" />
                     <?php endif; ?>   
			<input type="button" onclick="document.location='<?php echo url_for('company/index') ?>';" value="<?php echo __('Continue to list') ?>" class="boton" />
		</div>
	</div>
	<div class="clear"></div>
</div>