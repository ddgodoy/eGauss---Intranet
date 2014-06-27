<div class="content">
    <div class="leftside">
        <?php if (count($error)>0): ?>
            <div class="mensajeSistema error">
                    <ul>
                            <?php foreach($error as $name_error=>$formField) { echo '<li>'.$formField.'</li>'; } ?>
                    </ul>
            </div>
        <?php endif; ?>
        <?php if($msj_ok): ?>
        <div class="mensajeSistema ok">
            Vídeo registrado
        </div>    
        <?php endif; ?>
        <h1 class="titulos">
                <?php echo __('Registrar Documento') ?>
        </h1>
        <form enctype="multipart/form-data" method="post" action="<?php echo url_for($url) ?>">
        <label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label><br />
        <fieldset>
            <table width="100%" cellspacing="4" cellpadding="0" border="0">
                <tr>
                    <td width="10%"><label><?php echo __('Name') ?> *</label></td>
                    <td><input type="text" id="name" name="name" style="width:300px;" value="<?php echo $name ?>" class="form_input"></td>
                </tr>
                <tr>
                    <td width="10%"><label><?php echo __('File') ?> *</label></td>
                    <td><input type="file" name="file" class="form_input"></td>
                </tr>
            </table>
        </fieldset> 
        <div style="padding-top:10px;" class="botonera">
                <input type="submit" name="btn_action" value="<?php echo __('Register') ?>" class="boton" id="btn_action"/>
        </div>
        </form>
    </div>
</div>
