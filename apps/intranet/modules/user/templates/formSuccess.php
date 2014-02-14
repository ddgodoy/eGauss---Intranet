<?php
	$str_module = $sf_params->get('module');
	$str_action = $sf_params->get('action');
	$request_id = $id ?  "?id=$id" : '';
?>
<div class="content">
	<div class="rightside">
		<div class="paneles" style="text-align:center;">
			<img src="/<?php echo $photo ? 'uploads/user/'.$photo : 'images/no_user_b.jpg' ?>" border="0" />
		</div>
	</div>
	<div class="leftside" style="margin-left:260px;">
  <?php if (!$my_profile): ?>
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('user/index') ?>"><strong><?php echo __('Users') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __(ucfirst($str_action)) ?>
		</div>
  <?php else: ?>
    <div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>&nbsp;&gt;&nbsp;<?php echo __('My profile') ?>
		</div>
  	<?php if ($my_go_ok): ?>
			<div class="mensajeSistema ok"><?php echo __('Profile updated successfully') ?></div>
		<?php endif; ?>
  <?php endif; ?>
	<?php if ($form->hasErrors() || count($error) > 0): ?>
		<div class="mensajeSistema error">
			<ul>
				<?php foreach ($error as $e): ?><li><?php echo __($e, NULL, 'errors') ?></li><?php endforeach; ?>
				<?php foreach($form->getFormFieldSchema() as $name=>$formField) { if ($formField->getError() && $formField->getName() != 'email') { echo '<li>'.$formField->getError().'</li>'; } } ?>
			</ul>
		</div>
	<?php endif; ?>
	<h1 class="titulos">
    <?php if(!$my_profile): ?>
			<?php echo __(ucfirst($str_action)).' '.__('User') ?>
    <?php else: ?>
      <?php echo __('Update profile') ?>
    <?php endif; ?>
		</h1>
    <form enctype="multipart/form-data" method="post" <?php if(!$my_profile): ?> action="<?php echo url_for($str_module.'/'.$str_action).$request_id ?>" <?php else: ?> action="<?php echo url_for('@my-profile?id='.$sf_user->getAttribute('user_id').'&profile=my-profile') ?>" <?php endif; ?> >
			<label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label><br />
			<fieldset>
				<table width="100%" cellspacing="4" cellpadding="0" border="0">
          <tr>
            <td>
              <table width="100%" cellspacing="4" cellpadding="0" border="0">
                <tr>
                  <td width="7%"><label><?php echo __('Email') ?> *</label></td>
                  <td width="93%"><input type="text" class="form_input" name="email" value="<?php echo $email ?>" style="width:400px;"/></td>
                </tr>
                <tr>
                  <td><label><?php echo __('Name') ?> *</label></td>
                  <td><?php echo $form['name'] ?></td>
                </tr>
                <tr>
                  <td><label><?php echo __('Last name') ?> *</label></td>
                  <td><?php echo $form['last_name'] ?></td>
                </tr>
                <tr>
                  <td><label><?php echo __('Phone') ?> *</label></td>
                  <td><input type="text" class="form_input" name="phone" value="<?php echo $phone ?>" style="width:400px;"/></td>
                </tr>
                <tr>
                  <td><label><?php echo __('Skype') ?></label></td>
                  <td><input type="text" class="form_input" name="skype" value="<?php echo $skype ?>" style="width:400px;"/></td>
                </tr>
                <?php if (!$my_profile): ?>
                  <?php if ($sf_user->hasCredential('super_admin')): ?>
                  <tr>
                    <td><label><?php echo __('Rol') ?> *</label></td>
                    <td><?php echo $form['user_role_id'] ?></td>
                  </tr>
                  <?php endif; ?>
                <?php endif; ?>
                <tr>
                  <td><label><?php echo __('Photo') ?></label></td>
                  <td valign="middle">
                    <input type="file" name="photo" class="form_input"/>
                    <?php if ($photo): ?>
                      <input type="checkbox" name="reset_photo" style="vertical-align:middle;margin-left:10px;"/>&nbsp;<label><?php echo __('Check to delete') ?></label>
                    <?php endif; ?>
                  </td>
                </tr>
                <tr>
                  <td><label><?php echo __('Enabled') ?></label></td>
                  <td><?php echo $form['enabled'] ?></td>
                </tr>
              </table>
            </td>
            <td style="vertical-align: top">
              <fieldset style="background-color: #E1F3F7;">
                <table width="100%" cellspacing="4" cellpadding="0" border="0">
                  <?php
                    $fixed_label = 'Password';
                    $fixed_asterisk = '&nbsp;*';

                    if ($id):
                      $fixed_label = 'New password';
                      $fixed_asterisk = '';
                  ?>
                    <tr><td><label><?php echo __('Password') ?></label></td><td>***************</td></tr>
                  <?php endif; ?>
                  <tr>
                    <td width="15%"><label><?php echo __($fixed_label).$fixed_asterisk ?></label></td>
                    <td width="85%"><input type="password" name="password" class="form_input" style="width:200px;"></td>
                  </tr>
                  <tr>
                    <td><label><?php echo __('Repeat password').$fixed_asterisk ?></label></td>
                    <td><input type="password" name="repeat_password" class="form_input" style="width:200px;"></td>
                  </tr>
                  <tr>
                    <td colspan="2" style="text-align:right;"><em style="font-size:10px;"><?php echo __('Password correct format') ?></em></td>
                  </tr>
                </table>
              </fieldset>
            </td>
          </tr>
				</table>
			</fieldset>
      <fieldset>
			  <legend>&nbsp;<?php echo __('Schedule') ?>&nbsp;</legend>
			  <table cellpadding="0" cellspacing="0">
			    <tr>
			      <td style="padding-right: 30px;"><label><?php echo __('Contact Time From') ?></label></td>
			      <td><?php echo $form['contact_time_from'] ?></td>
			    </tr>
			    <tr><td colspan="3" style="height: 15px;"></td></tr>
			    <tr>
			      <td><label><?php echo __('Contact Time To') ?></label></td>
			      <td><?php echo $form['contact_time_to'] ?></td>
			    </tr>
			  </table>
      </fieldset>
      <?php if (!$my_profile): ?>
      <fieldset>
			  <legend>&nbsp;<?php echo __('Proyectos en Basecamp') ?>&nbsp;</legend>
			  <?php $allProjects = NewBasecamp::todosLosProyectos(); ?>
			  <table cellpadding="0" cellspacing="0">
			    <tr>
			      <td width="310">
			      	<div class="divSelectMultiple">
			      		<?php echo Common::llenarSelectMultipleWithBoxes('proyectos[]', $allProjects, $sf_data->getRaw('basecamp'), 150); ?>
			      	</div>
			      </td>
			      <td valign="top" style="padding-left:30px;">
			      	<input type="button" class="boton" value="Seleccionar todos" onclick="selAllProyectos();" />
			      </td>
			    </tr>
			  </table>
			  <?php foreach ($allProjects as $kproject => $vproject): ?>
			  	<input type="hidden" name="auxi_lista[]" value="<?php echo $kproject.'$'.$vproject ?>" />
			  <?php endforeach; ?>
      </fieldset>
      <?php endif; ?>
			<div style="padding-top:10px;" class="botonera">
				<input type="button" onclick="document.location='<?php echo url_for($str_module.'/index') ?>';" value="<?php echo __('Cancel') ?>" class="boton" />
				<input type="submit" name="btn_action" value="<?php echo __('Register') ?>" class="boton" id="btn_action"/>
        <?php echo $form->renderHiddenFields() ?>
			</div>
		</form>
	</div>
	<div class="clear"></div>
</div>