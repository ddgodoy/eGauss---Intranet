<html>
	<head>
		<title><?php echo $project.' - '.__('New password request') ?></title>
	</head>
	<table>
		<tr>
			<td><?php echo __('New password for %user%', array('%user%' => '<strong>'.$user.'</strong>')) ?>.<td>
		</tr>
		<tr><td><?php echo __('To continue use this link') ?>:<br /><br /><td></tr>
		<tr><td><a href='<?php echo $url ?>' target='_blank'><?php echo __('Set new password') ?></a><br /><br /></td></tr>
		<tr><td><?php echo __('Otherwise, ignore this message') ?>.<td></tr>
	</table>
</html>