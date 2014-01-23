<html>
	<head>
		<title>Sus datos de acceso para eGauss.com</title>
	</head>
	<table>
                <tr>
                        <td><img title="eGauss Business Holding I+T" src="http://egauss-intranet.icox.com/images/no_company_logo.png"></td>
                </tr>
                <tr><td style="height: 15px;"></td></tr>
                <tr>
                    <td><strong><?php echo $data['name'] ?>:</strong></td>
                </tr>
                <tr><td style="height: 15px;"></td></tr>
                <tr>
                    <td>Sus datos de acceso para eGauss.com son:</td>
                </tr>
                <tr><td style="height: 15px;"></td></tr>
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