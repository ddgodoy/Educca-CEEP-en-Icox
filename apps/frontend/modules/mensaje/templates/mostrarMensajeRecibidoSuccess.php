<?php use_helper('Javascript','SexyButton') ?>
<?php use_helper('volver'); ?>
<div id="mensajes_recibidos">
  <div class="tit_box_mensajes"><h2 class="titbox"><?php echo $mensaje->getAsunto_mensaje()->getDescripcion() ?></h2></div>
  <div class="cont_box_correo">
      <div class="herramientas">
        <?php echo form_tag('mensaje/mostrarMensajeRecibido') ?>
        <?php echo (input_hidden_tag('id_mensaje', $mensaje->getId())); ?>
        <?php if ($mensaje->getBorrado()): ?>
          <div style='display:none'>
              <INPUT id='eliminar' TYPE=submit NAME="opcion" VALUE="Eliminar" CLASS="submit">
              <INPUT id='recuperar' TYPE=submit NAME="opcion" VALUE="Recuperar" CLASS="submit">
         </div>
         <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width="70"><input class="boton_gris_herramientas1" onclick="if (confirm('El mensaje se eliminar\u00e1 de forma permanente. Confirma que quieres borrar el mensaje')) {document.getElementById('eliminar').click();}" name="delete" value="Eliminar" type="button"></td>
              <td><input class="boton_gris_herramientas2" onclick="document.getElementById('recuperar').click();" name="recuperar" value="Recuperar" type="button"></td>
            </tr>
         </table>
        <?php else: ?>
          <div style='display:none'>
              <INPUT id='eliminar' TYPE=submit NAME="opcion" VALUE="Eliminar" CLASS="submit">
              <INPUT id='responder' TYPE=submit NAME="opcion" VALUE="Responder" CLASS="submit">
         </div>
         <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width="70"><input class="boton_gris_herramientas1" onclick="if (confirm('El mensaje se mover\u00e1 a la papelera de mensajes. Confirma que quieres borrar el mensaje')) {document.getElementById('eliminar').click();}" name="delete" value="Eliminar" type="button"></td>
              <td><input class="boton_gris_herramientas2" onclick="document.getElementById('responder').click();" name="responder" value="Responder" type="button"></td>
            </tr>
         </table>

        <?php endif; ?>
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
            </table>
        </div>
        <div class="detalles" style="background-repeat: round;">
            <table class="tabladetalles">
              <tr>
                  <td class="titulo">Adjuntos:</td>
                  <?php if(count($files)>0): ?>
                   <td> 
                       <ul style="list-style-type: none ">
                    <?php foreach ($files as $K=>$file): ?>
                           <li>
                               <?php $folder = $mensaje->getAdjuntos(); ?>
                               <?php echo image_tag('books-stack.png','title="Archivo Adjunto" class=ico_profesor'); ?> &nbsp;&nbsp;&nbsp;
                               <a href="<?php echo "/uploads/correo/".$folder."/".$file ?>" target="_blanck"><?php echo $file ?></a>
                           </li>
                    <?php endforeach; ?>
                       </ul> 
                   </td>   
                  <?php endif; ?>
              </tr>
            </table>
        </div>    
        <div class="cont_mensaje">
            <?php echo $mensaje->getContenido()?>
        </div>
      </div>
      <br>
      <?php use_helper('volver');echo volver(); ?>
  </div>
  <div class="cierre_box_correo"></div>
</div>


