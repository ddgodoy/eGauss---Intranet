<div class="content">
	<div class="login">
		<h2><?php echo __('Start session') ?></h2>
		<?php if (count($auth_error) > 0): ?>
			<div class="mensajeSistema error">
				<ul><?php foreach ($auth_error as $error): ?><li style="padding:5px;"><?php echo $error ?></li><?php endforeach; ?></ul>
			</div>
		<?php endif; ?>
		<form method="POST" action="<?php echo url_for('authentication/index') ?>" enctype="multipart/form-data">
			<div class="boxes">
				<ul style="width:460px;">
					<li>
						<label><?php echo __('Email') ?>:</label>
						<input type="text" id="auth_email" name="auth_email" value="<?php echo $auth_email ?>" class="form_input_login" style="width:200px;"/>
					</li>
					<li>
						<label><?php echo __('Password') ?>:</label>
						<input type="password" name="auth_password" value="" class="form_input_login" style="width:200px;"/><br/>
						<a href="<?php echo url_for('authentication/forgotenPassword') ?>"><?php echo __('Forgoten your password?') ?></a>
					</li>
				</ul>
			</div>
			<div class="log_cont"><input type="submit" value="<?php echo __('Sign in') ?>" name="auth_submit" /></div>
		</form>
	</div>
</div>
<script type="text/javascript">document.getElementById('auth_email').focus();</script>