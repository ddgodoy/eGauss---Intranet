<script type="text/javascript">
$(document).ready(function(){
    $("#fancybox-manual-b").click(function() {
            $.fancybox.open({
                    href : '<?php echo url_for($url_register_videos) ?>',
                    type : 'iframe',
                    padding : 5,
                    afterClose: function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
                       jQuery.ajax({
                            type: 'GET',
                            url: '<?php echo url_for($url_get_videos) ?>',
                            success: function(data) {
                                $('#videos').html(data);
                            }
                       });
                    }
            });
    });
    $("#fancybox-manual-c").click(function() {
            $.fancybox.open({
                    height: '290px',
                    href : '<?php echo url_for("@google_drive") ?>',
                    type : 'iframe',
                    padding : 5,
                    afterClose: function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
                       jQuery.ajax({
                            type: 'GET',
                            url: '<?php echo url_for($url_document) ?>',
                            success: function(data) {
                                $('#drive').html(data);
                            }
                       });
                    }
            });
    });
    
    $('#entrepreneur_year_two').change(function(){
            var value_one =  $('#entrepreneur_year_one').val()
            if(value_one >= $(this).val())
            {
                alert('El segundo rango de fechas debe ser menor al primero');
            }    
    });  
    
    $('#entrepreneur_capital').click(function(){
        if($(this).attr('checked')){
            $('#capital').show();
            tinyMCE.init({
                mode: "exact",
                elements: "entrepreneur_comments_capital",
                theme: "advanced",
                theme_advanced_toolbar_location: "top",
                theme_advanced_toolbar_align: "left",
                theme_advanced_statusbar_location: "bottom",
                theme_advanced_resizing: true
                ,
                theme_advanced_buttons1 : "cut, copy, paste, images, bold, italic, underline, justifyleft, justifycenter, justifyright , outdent, indent, bullist, numlist, undo, redo, link",theme_advanced_buttons2 : "",theme_advanced_buttons3 : ""
            }); 
        }
        else{
            $('#capital').hide();
        }
    });
    
    $('#entrepreneur_courses').click(function(){
        if($(this).attr('checked')){
            $('#courses').show();
            tinyMCE.init({
                mode: "exact",
                elements: "entrepreneur_comments_courses",
                theme: "advanced",
                theme_advanced_toolbar_location: "top",
                theme_advanced_toolbar_align: "left",
                theme_advanced_statusbar_location: "bottom",
                theme_advanced_resizing: true
                ,
                theme_advanced_buttons1 : "cut, copy, paste, images, bold, italic, underline, justifyleft, justifycenter, justifyright , outdent, indent, bullist, numlist, undo, redo, link",theme_advanced_buttons2 : "",theme_advanced_buttons3 : ""
            }); 
        }else{
            $('#courses').hide();
        }
    });
    
    <?php if($form['capital']->getValue()): ?>
        tinyMCE.init({
                mode: "exact",
                elements: "entrepreneur_comments_capital",
                theme: "advanced",
                theme_advanced_toolbar_location: "top",
                theme_advanced_toolbar_align: "left",
                theme_advanced_statusbar_location: "bottom",
                theme_advanced_resizing: true
                ,
                theme_advanced_buttons1 : "cut, copy, paste, images, bold, italic, underline, justifyleft, justifycenter, justifyright , outdent, indent, bullist, numlist, undo, redo, link",theme_advanced_buttons2 : "",theme_advanced_buttons3 : ""
            }); 
    <?php endif; ?>
        
    <?php if($form['courses']->getValue()): ?>
        tinyMCE.init({
                mode: "exact",
                elements: "entrepreneur_comments_courses",
                theme: "advanced",
                theme_advanced_toolbar_location: "top",
                theme_advanced_toolbar_align: "left",
                theme_advanced_statusbar_location: "bottom",
                theme_advanced_resizing: true
                ,
                theme_advanced_buttons1 : "cut, copy, paste, images, bold, italic, underline, justifyleft, justifycenter, justifyright , outdent, indent, bullist, numlist, undo, redo, link",theme_advanced_buttons2 : "",theme_advanced_buttons3 : ""
            }); 
    <?php endif; ?>     
});
</script>
<?php
	$str_module = $sf_params->get('module');
	$str_action = $sf_params->get('action');
	$request_id = $id ?  "?id=$id" : '';
?>
<div class="content">
        <div class="rightside">
		<div class="paneles" id="conten-calendar">
                    <?php include_component('calendar', 'calendar') ?>
                </div> 
	</div>
	<div class="leftside" style="margin-left:260px;">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('entrepreneur/index') ?>"><strong><?php echo __('Emprendedores') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __(ucfirst($str_action)) ?>
		</div>
		<?php if ($form->hasErrors()): ?>
			<div class="mensajeSistema error">
				<ul>
					<?php foreach($form->getFormFieldSchema() as $name=>$formField) { if ($formField->getError()) { echo '<li>'.$formField->getError().'</li>'; } } ?>
				</ul>
			</div>
		<?php endif; ?>
		<h1 class="titulos">
			<?php echo __(ucfirst($str_action)).' '.__('Emprendedores') ?>
		</h1>
		<form enctype="multipart/form-data" method="post" action="<?php echo url_for('@'.$str_module.'-'.$str_action.$request_id) ?>">
                <label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label><br />
            <fieldset>
            <table width="100%" cellspacing="4" cellpadding="0" border="0">
                <tr>
                  <td style=" width: 60%">
                    <table width="100%" cellspacing="4" cellpadding="0" border="0">
                      <tr>
                        <td width="25%"><label><?php echo __('Año o Rango de años') ?> *</label></td>
                        <td>
                            <?php echo $form['year_one'] ?>&nbsp;-&nbsp;<?php echo $form['year_two'] ?>
                        </td>
                      </tr>
                      <tr>
                        <td><label><?php echo __('Name') ?> *</label></td>
                        <td><?php echo $form['name'] ?></td>
                      </tr>
                      <tr>
                        <td><label><?php echo __('Last name') ?> *</label></td>
                        <td><?php echo $form['last_name'] ?></td>
                      </tr>
                      <tr>
                        <td><label><?php echo __('Sexo') ?></label></td>
                        <td><?php echo $form['sex'] ?></td>
                      </tr>
                      <tr>
                        <td><label><?php echo __('País, internacional') ?></label></td>
                        <td><?php echo $form['country'] ?></td>
                      </tr>
                      <tr>
                        <td><label><?php echo __('Phone') ?></label></td>
                        <td><?php echo $form['phone'] ?></td>
                      </tr>
                      <tr>
                        <td><label><?php echo __('Email') ?></label></td>
                        <td><?php echo $form['email'] ?></td>
                      </tr>
                      <tr>
                        <td><label><?php echo __('Linkedin') ?></label></td>
                        <td><?php echo $form['linkedin'] ?></td>
                      </tr>
                      <tr>
                        <td><label><?php echo __('Website') ?></label></td>
                        <td><?php echo $form['web_personal'] ?></td>
                      </tr>
                      <tr>
                        <td><label><?php echo __('Puesto en la empresa') ?></label></td>
                        <td><?php echo $form['workstation'] ?></td>
                      </tr>
                      <tr>
                        <td><label><?php echo __('Sector') ?></label></td>
                        <td><?php echo $form['sector'] ?></td>
                      </tr>
                      <tr>
                        <td><label><?php echo __('Twitter') ?></label></td>
                        <td><?php echo $form['twitter'] ?></td>
                      </tr>
                      <tr>
                        <td><label><?php echo __('Facebook') ?></label></td>
                        <td><?php echo $form['facebook'] ?></td>
                      </tr>
                      <tr>
                        <td><label><?php echo __('Fuente') ?></label></td>
                        <td><?php echo $form['source'] ?></td>
                      </tr>
                      <tr>
                        <td><label><?php echo __('Otros sitios de interés') ?></label></td>
                        <td><?php echo $form['other_sites_interest'] ?></td>
                      </tr>
                      <tr>
                        <td><label><?php echo __('Nombre Proyecto') ?></label></td>
                        <td><?php echo $form['project_name'] ?></td>
                      </tr>
                    </table><br />
                    <fieldset>
                        <legend>&nbsp;<?php echo __('Proyectos') ?>&nbsp;</legend>
                        <table width="100%" cellspacing="4" cellpadding="0" border="0">
                            <tr>
                              <td><?php echo $form['project'] ?></td>
                            </tr>
                        </table>
                    </fieldset>
                    <table width="100%" cellspacing="4" cellpadding="0" border="0">
                        <tr>
                          <td><label><?php echo $form['capital'] ?> Ampliación de capital</label></td>
                        </tr>
                        <tr <?php if(!$form['capital']->getValue()): ?> style="display: none" <?php endif; ?> id="capital">
                            <td>
                                <fieldset>
                                <legend>&nbsp;<?php echo __('Comentarios') ?>&nbsp;</legend>    
                                <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                    <tr>
                                      <td><?php echo $form['comments_capital'] ?></td>
                                    </tr>
                                </table>
                                </fieldset>    
                            </td>
                        </tr>
                    </table>
                    <table width="100%" cellspacing="4" cellpadding="0" border="0">
                        <tr>
                          <td><label><?php echo $form['courses'] ?> Cursos eGauss</label></td>
                        </tr>
                        <tr <?php if(!$form['courses']->getValue()): ?> style="display: none" <?php endif; ?> id="courses">
                            <td>
                                <fieldset>
                                <legend>&nbsp;<?php echo __('Comentarios') ?>&nbsp;</legend>    
                                <table width="100%" cellspacing="4" cellpadding="0" border="0">
                                    <tr>
                                      <td><?php echo $form['comments_courses'] ?></td>
                                    </tr>
                                </table>
                                </fieldset>    
                            </td>
                        </tr>
                    </table>
                  </td>
                </tr>
                </table>
                <table width="100%" cellspacing="4" cellpadding="0" border="0">
                <tr><td style="height: 15px;"></td></tr>
                <tr>
                  <td colspan="2">
                    <table width="100%" cellspacing="4" cellpadding="0" border="0">
                      <tr><td><?php echo $form['comments'] ?></td></tr>    
                    </table>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a id="fancybox-manual-b">
                      <img src="/images/video.jpeg" border="0" width="50" height="50" title="Ingresar Vídeo"  style="cursor: pointer"/>
                    </a>
                    <a id="fancybox-manual-c">
                      <img src="/images/drive.jpeg" border="0" width="50" height="33" title="Ingresar Documento"  style="cursor: pointer; vertical-align: super"/>
                    </a>
                  </td>
                </tr>
              </table>
              <div id="videos">
                <?php include_component('entrepreneur', 'getVideos') ?>
              </div>
              <div id="drive">
                <?php include_component('entrepreneur', 'getDocument') ?>
              </div>
            </fieldset>
            <div style="padding-top:10px;" class="botonera">
                <input type="button" onclick="document.location='<?php echo url_for($str_module.'/index') ?>';" value="<?php echo __('Cancel') ?>" class="boton" />
                <?php if($id): ?>
                    <input type="button" onclick="document.location='<?php echo url_for('@'.$str_module.'-show?id='.$id) ?>';" value="<?php echo __('See') ?>" class="boton" />
                <?php endif; ?>
                <input type="submit" name="btn_action" value="<?php echo __('Register') ?>" class="boton" id="btn_action"/>
                <?php echo $form->renderHiddenFields() ?>
            </div>
        </form>
	</div>
	<div class="clear"></div>
</div>