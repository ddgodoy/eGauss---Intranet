<html>
	<head>
		<title>Sus datos de acceso para eGauss.com</title>
	</head>
	<table>
		<tr>
			<td><strong>Login:</strong>&nbsp;<td>
			<td><?php echo $data['email'] ?></td>
		</tr>
		<tr>
			<td><strong>Clave:</strong>&nbsp;<td>
			<td><?php echo $data['password'] ?></td>
		</tr>
	</table>
	<br />
	<p>
		<a href="<?php echo $data['url'] ?>" target="_blank"><strong>Intranet eGauss.com</strong></a>
	</p>
</html>