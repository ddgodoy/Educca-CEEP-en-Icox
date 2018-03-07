<?php use_helper('Javascript', 'Text', 'SexyButton', 'volver') ?>

<link rel="stylesheet" type="text/css" media="screen" href="/sfSexyButtonPlugin/css/sexy_button.css" />
<script type="text/javascript">
<?php if ($error):?>alert('El mensaje estaba en blanco y no se envi\u00f3');<?php endif; ?>

function parametrosMensaje()
{
  var destinatarios = 0;
  var temp;
  var ok = 0;  
  
  if (document.getElementById('curso').value == 0) { alert('Por favor, elige un curso'); return false; }
  if (document.getElementById('asunto').value == 0) { alert('Por favor, elige un asunto'); return false; }

  if (document.getElementById('es_envio').value > 0) {
    destinatarios = document.getElementById('numero_destinatarios').value;

    for (var i = 0; i < destinatarios; i++) {
      temp = document.getElementById('usuario'+i);
      if (temp.checked == true) {ok++;}
    }
    if (ok) {
      document.fredactar.submit(); return true;
    } else {
      alert('Debe elegir al menos un destinatario'); return false;
    }
  } else {
    document.fredactar.submit(); return true;
  }
}

function checkTodos()
{
  var inputs = document.getElementsByTagName('input');
  
  for (var i = 0; i < inputs.length; i++) {
    if (inputs[i].type == 'checkbox') { inputs[i].checked = true; }
  }
}

function checkNinguno()
{
  var inputs = document.getElementsByTagName('input');
  
  for (var i = 0; i < inputs.length; i++) {
    if (inputs[i].type == 'checkbox') { inputs[i].checked = false; }
  }
}

function addFile()
{
    
}
</script>
<div id="redactar_mensaje">
  <div class="tit_box_mensajes">
  	<h2 class="titbox"><?php if ($es_respuesta){echo("Responder");} else {echo("Redactar Mensaje");}?></h2>
  </div>
  <div class="cont_box_correo">
    <?php echo form_tag('mensaje/enviarMensaje',array('name'=>'fredactar')) ?>
    <div class="cuerpo_mensaje">
        <table width="100%">
         <tr>
          <td style="width: 512px;">
           <table class="tablaredactar">
            <tr>
              <td class="param">Curso:</td>
              <td>
                <?php if ($es_respuesta) {
                  $id_curso = $mensaje->getIdCurso();
                  $id_pregunta = $mensaje->getId();
                  $curso = CursoPeer::RetrieveByPk($id_curso);
                  echo($curso->getNombre());
                  echo ("<INPUT TYPE=hidden ID=\"curso\" NAME=\"curso\" VALUE=\"$id_curso\">");
                } else {
                  echo (select_tag('curso', options_for_select($cursos), 'class=select'));
                  echo (observe_field('curso', array('update'=>'destinatarios', 'url'=>'mensaje/elegirDestinatarios', 'with'=>"'curso=' + value+'&asunto='+document.fredactar.asunto.value")));
                } ?>
              </td>
            </tr>
            <tr>
              <td class="param">Asunto:</td>
              <td>
                <?php if ($es_respuesta) {
                  $asunto = "RE: ".$mensaje->getAsunto_mensaje()->getDescripcion();
                  echo($asunto);
                  echo ("<INPUT TYPE=hidden ID=\"asunto\" NAME=\"asunto\" VALUE=\"".$mensaje->getAsunto_mensaje()->getId()."\">");
                  echo ($sf_user->hasCredential('profesor'))? "<INPUT TYPE=hidden NAME=\"respuesta_profesor\" VALUE=\"1\">" :"";
                } else {
                         echo (select_tag('asunto', options_for_select($asuntos), 'class=select'));
                         echo (observe_field('asunto', array('update'=>'destinatarios', 'url'=>'mensaje/elegirDestinatarios', 'with'=>"'asunto=' + value +'&curso='+document.fredactar.curso.value" )));
                } ?>
              </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table>
                        <tr>
                          <td>Adjuntos</td>  
                        </tr>
                        <tr id="tr-file">
                          <td>
                              <ul style="list-style-type: none">
                                  <li><input type="file" name="upfile1" id="upfile1" class="file_input"></li>
                                  <li><input type="file" name="upfile1" id="upfile1" class="file_input"></li>
                              </ul>
                          </td>  
                        </tr>
                        <tr>
                           <td><strong><?php echo image_tag('add_icon.gif','Title=Agregar Archivo class=ico_profesor'); ?></strong></td> 
                        </tr>
                    </table>
                </td>
            </tr>
          </table>
          <?php echo textarea_tag('contenidomsj', '', 'rich=true size=85x20 tinymce_options=language:"es", height:"435px", width:"510px", theme:"advanced"') ?></td>
         <td><div class="separadiv"><strong>&nbsp;Destinatarios:</strong></div>
            <div id="destinatarios" style="width: 100%;">
            <?php if ($es_respuesta) {
              $id_emisor = $mensaje->getIdEmisor();
              $destinatario = UsuarioPeer::RetrieveByPk($id_emisor);
              echo ("&nbsp;&nbsp;".image_tag('finalizado.png').'&nbsp;'.truncate_text($destinatario->getNombre()." ".$destinatario->getApellidos(), 36));
              echo ("<INPUT TYPE=hidden NAME=\"usuario0\" VALUE=\"$id_emisor\">");
              echo ("<INPUT TYPE=hidden NAME=\"id_pregunta\" VALUE=\"$id_pregunta\">");
              echo ("<INPUT TYPE=hidden ID=\"es_envio\" VALUE=\"0\">");
            } else {
              echo ("&nbsp;Elige curso y asunto");
              echo ("<INPUT TYPE=hidden ID=\"es_envio\" VALUE=\"1\">");
            } ?>
          </div>
          </td>
          </tr>
        </table>
      </div>
      <?php if ($es_respuesta) {
        echo ("<INPUT TYPE=hidden NAME=\"numero_destinatarios\" VALUE=\"1\">");
      } ?>
      <table border="0" width="100%"">
			   <tr>
			      <td style="width:20%;"><?php echo volver(); ?></td>
			      <td style="width:21%;">&nbsp;</td>
			      <td style="width:59%;"><?php echo sexy_button_to_function('Enviar mensaje', 'parametrosMensaje()'); ?></td>
         </tr>
       </table>       
      </form>
      <div id="lista_errores"></div>
  </div>
  <div class="cierre_box_correo"></div>
</div>