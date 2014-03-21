<html>
	<head>
		<title>eGauss.com Empresa Participada</title>
	</head>
	<table>
                <tr>
                    <td colspan="2"><img title="eGauss Business Holding I+T" src="http://egauss-intranet.icox.com/images/no_company_logo.png"></td>
                </tr>
                <tr><td style="height: 15px;" colspan="2"></td></tr>
                <tr>
                    <td colspan="2"><?php echo $data['name_user'] ?>:</td>
                </tr>
                <tr><td style="height: 15px;" colspan="2"></td></tr>
		<tr>
                    <td colspan="2">Nueva Informaci&oacute;n sobre <strong><?php echo $data['name_company'] ?>:</td>
		</tr>
                <tr><td style="height: 15px;" colspan="2"></td></tr>
                <tr>
                    <td width="15%"><label><?php echo __('Título') ?>:</label></td>
                    <td>
                        <a href="<?php echo $data['url'] ?>" target="_blank"><strong><?php echo $data['name_info'] ?></strong></a>
                    </td>
                </tr>
                <tr><td style="height: 15px;" colspan="2"></td></tr>
                <tr>
                    <td width="15%"><label><?php echo __('Categoría') ?>:</label></td>
                    <td><?php echo $data['type'] ?></td>
                </tr>
                <tr><td style="height: 30px;" colspan="2"></td></tr>
                <tr>
                    <td colspan="2"><?php echo html_entity_decode($data['content']) ?></td>
                </tr>
	</table>
	<br />
	<p>
		<a href="<?php echo $data['url_home'] ?>" target="_blank"><strong>Intranet eGauss.com</strong></a>
	</p>
</html>