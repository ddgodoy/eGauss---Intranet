<html>
	<head>
		<title>eGauss.com Empresa Participada</title>
	</head>
	<table>
                <tr>
                    <td><img title="eGauss Business Holding I+T" src="http://egauss-intranet.icox.com/images/no_company_logo.png"></td>
                </tr>
                <tr><td style="height: 15px;"></td></tr>
                <tr>
                    <td><?php echo $data['name_user'] ?>:</td>
                </tr>
                <tr><td style="height: 15px;"></td></tr>
		<tr>
                    <td>eGauss.com te avisa que eres reponsable de la empresa participada:<td>
		</tr>
                <tr><td style="height: 15px;"></td></tr>
                <tr>
                    <td><strong><?php echo $data['name_company'] ?></strong> para ver sus datos <a href="<?php echo $data['url'] ?>" target="_blank"><strong>click aqui</strong></a></td>
                </tr>    
	</table>
	<br />
	<p>
		<a href="<?php echo $data['url_home'] ?>" target="_blank"><strong>Intranet eGauss.com</strong></a>
	</p>
</html>