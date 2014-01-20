<div class="content">
	<div class="login">
		<h2><?php echo __('New password request') ?></h2>
		<?php if ($processCompleted): ?>
			<div class="mensajeSistema ok" style="text-align:center;">
				<?php echo __('Forgoten password process completed') ?><br /><br /><br />
				<input type="button" class="boton" value="<?php echo __('Back to login') ?>" onclick="document.location='<?php echo url_for('authentication/index') ?>';">
			</div>
		<?php else: ?>
			<?php if ($form->hasErrors() || $otherError): ?>
				<div class="mensajeSistema error">
				<?php
					if ($otherError) { echo '<ul><li>'.__($otherError, NULL, 'errors').'</li></ul>'; }
					echo $form['email']->renderError();
					echo $form['captcha']->renderError();
					echo $form->renderGlobalErrors();
				?>
				</div>
			<?php endif; ?>
			<form method="POST" action="<?php echo url_for('authentication/forgotenPassword') ?>" enctype="multipart/form-data">
				<div class="boxes">
					<ul>
						<li><label><?php echo __('Email') ?>:</label><?php echo $form['email']->render(array('class'=>'form_input_login')) ?></li>
						<li><?php echo $form['captcha'] ?></li>
					</ul>
				</div>
				<div class="forgoten_cont">
					<input type="button" class="boton" value="<?php echo __('Cancel') ?>" onclick="document.location='<?php echo url_for('authentication/index') ?>';">
					<input type="submit" class="boton" value="<?php echo __('Send') ?>" name="auth_submit" style="margin-left:10px;"/>
					<?php echo $form->renderHiddenFields() ?>
				</div>
			</form>
			<script type="text/javascript">document.getElementById('<?php echo $form['email']->renderId() ?>').focus();</script>
		<?php endif; ?>
	</div>
</div>