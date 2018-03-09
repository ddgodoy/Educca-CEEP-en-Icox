<?php use_helper('Javascript') ?>
<?php use_helper('volver'); ?>
<div id="mensajes_recibidos">
  <div class="tit_box_mensajes"><h2 class="titbox"><?php echo $mensaje->getAsunto_mensaje()->getDescripcion() ?></h2></div>
  <div class="cont_box_correo">
      <div class="herramientas">
        <?php echo form_tag('mensaje/mostrarMensajeEnviado') ?>
        <?php echo (input_hidden_tag('id_mensaje', $mensaje->getId())); ?>
          <div style='display:none'>
              <INPUT id='eliminar' TYPE=submit NAME="opcion" VALUE="Eliminar" CLASS="submit">
         </div>
         <input class="boton_gris_herramientas1" onclick="if (confirm('El mensaje se eliminar\u00e1 de forma permanente. Confirma que quieres borrar el mensaje')) {document.getElementById('eliminar').click();}" name="delete" value="Eliminar" type="button">
        </form>

      </div>
      <div class="detalles_mensaje">
        <div class="detalles">
            <table class="tabladetalles">
              <tr>
                <td class="titulo">De:</td>
                <td><?php $user = UsuarioPeer::RetrieveByPk($mensaje->getIdEmisor()); echo $user->getNombre().' '.$user->getApellidos() ?></td>
              </tr>
              <tr>
                <td class="titulo">Para:</td>
                <td><?php echo $mensaje->getListaDestinatarios() ?></td>
              </tr>
              <tr>
                <td class="titulo">Fecha:</td>
                <td><?php echo $mensaje->getCreatedAt('H:i d/m/Y')?></td>
              </tr>
              <tr>
                <td class="titulo">Asunto:</td>
                <td><?php echo $mensaje->getAsunto_mensaje()->getDescripcion()?></td>
              </tr>
              <tr>
                <td class="titulo">Curso:</td>
                <td><?php $curso = CursoPeer::RetrieveByPk($mensaje->getIdCurso()); echo $curso->getNombre() ?></td>
              </tr>
              <tr>
                  <td class="titulo">Adjuntos:</td>
                  <?php if(count($files)>0): ?>
                    <?php foreach ($files as $K=>$file): ?>
                       <td><a href="<?php echo "uploads/correo/".$mensaje->getId()."/'".$file ?>" target="_blanck"><?php echo $file ?></a></td>
                    <?php endforeach; ?>
                  <?php endif; ?>
              </tr>
            </table>
        </div>
        <div class="cont_mensaje">
            <?php echo $mensaje->getContenido()?>
        </div>
      </div>
      <br>
      <table border='0' width='100%'>
			   <tr>
			      <td style="width:20%;"><?php echo volver();     ?></td>
			      <td style="width:80%;">&nbsp;</td>
         </tr>
       </table>
      
  </div>
  <div class="cierre_box_correo"></div>
</div>


