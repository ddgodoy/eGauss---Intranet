<div class="content">
	<div class="login">
		<h2><?php echo __('Set new password') ?></h2>
		<?php if ($rp_error == 'empty token' || $rp_error == 'token not valid'): ?>
			<div class="mensajeSistema error" style="text-align:center;"><?php echo __('Forgoten password '.$rp_error, NULL, 'errors') ?></div>
		<?php else: ?>
		<?php if ($rp_error): ?>
			<div class="mensajeSistema error" style="text-align:center;">
				<?php echo __($rp_error, NULL, 'errors') ?>
			</div>
		<?php endif; ?>
		<form method="POST" action="<?php echo url_for('authentication/requestNewPassword') ?>?token=<?php echo $rp_token ?>" enctype="multipart/form-data">
			<div class="boxes">
				<ul>
					<li>
						<label style="width:130px;"><?php echo __('Email') ?>:</label>
						<span style="vertical-align:middle;"><?php echo $rp_email ?></span>
					</li>
					<li>
						<label style="width:130px;"><?php echo __('New password') ?>:</label>
						<input type="password" name="rp_password" id="rp_password" value="" class="form_input_login"/>
					</li>
					<li>
						<label style="width:130px;"><?php echo __('Repeat password') ?>:</label>
						<input type="password" name="rp_repeat_password" value="" class="form_input_login"/>
					</li>
					<li>
						<em style="font-size:10px;"><?php echo __('Password correct format') ?></em>
					</li>
				</ul>
			</div>
			<div class="forgoten_cont">
				<input type="button" class="boton" value="<?php echo __('Cancel') ?>" onclick="document.location='<?php echo url_for('authentication/index') ?>';">
				<input type="submit" class="boton" value="<?php echo __('Register') ?>" name="auth_submit" style="margin-left:10px;"/>
			</div>
		</form>
		<script type="text/javascript">document.getElementById('rp_password').focus();</script>
		<?php endif; ?>
	</div>
</div>