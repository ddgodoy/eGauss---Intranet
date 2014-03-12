<script type="text/javascript">
function setGifAnimado()
{
	$('#enproceso').show();
	return true;
}
</script>
<div class="content">
    <div class="leftside">
        <?php if (count($error)>0): ?>
          <div class="mensajeSistema error">
            <ul>
              <?php foreach($error as $name_error=>$formField) { echo '<li>'.$formField.'</li>'; } ?>
            </ul>
          </div>
        <?php endif; ?>
        <?php if ($msj_ok): ?>
        	<script type="text/javascript">
						parent.jQuery.fancybox.close();
        	</script>
        <?php endif; ?>
        <h1 class="titulos">
          <?php echo 'Registrar Documento' ?>
        </h1>
        <form action="<?php url_for('@google_drive') ?>" method="post" enctype="multipart/form-data">
            <label class="lineaListados">Campos obligatorios&nbsp;(*)</label><br>
            <fieldset>
                <table width="100%" cellspacing="4" cellpadding="0" border="0">
                    <tbody>
                    <tr>
                        <td width="10%"><label>Nombre </label></td>
                        <td><input type="text" class="form_input" value="<?php echo $name ?>" style="width:300px;" name="name" id="name"></td>
                    </tr>
                    <tr>
                        <td width="10%"><label>Descripción</label></td>
                        <td><textarea name="description" style="width: 300px; height: 80px"><?php $description ?></textarea></td>
                    </tr>
                    <tr>
                        <td width="10%"><label>Archivo *</label></td>
                        <td><input type="file" class="form_input" name="file"></td>
                    </tr>
                </tbody></table>
            </fieldset> 
            <div class="botonera" style="padding-top:10px;">
            	<table cellpadding="0" cellspacing="0">
            		<tr>
            			<td><input type="submit" id="btn_action" class="boton" value="Registrar" name="btn_action" onclick="return setGifAnimado();"></td>
            			<td style="padding-left:40px;">
            				<div id="enproceso" style="display:none;">
            					<label style="color:#077d9a;"><em>Procesando, por favor espere...</em></label>
            					<img src="/images/loader.gif" border="0" style="padding-left:10px;vertical-align:middle;"/>
            				</div>
            			</td>
            		</tr>
            	</table>
            </div>
        </form>
    </div>
</div>