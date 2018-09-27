<?php use_helper('SexyButton'); ?>
<?php use_helper('informacion'); ?>

<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal"><h2 class="titbox">Formulario de contacto</h2></div>
  <div class="contenido_principal">
    <div id="formEdit">
      <?php echo form_tag('usuario/ayuda'); ?>
      <br /><br>
      <table class="tabla_show_perfil3">
        <tbody>
          <tr>
            <th>Asunto:</th>
            <td><?php echo input_tag('asunto', '', array ('class' => 'inputperfil2')) ?></td>
          </tr>
          <tr>
            <th>Comentario:</th>
            <td><?php echo textarea_tag('comentario', '', array ('class' => 'inputperfil2ta')) ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td style="padding-left: 130px; padding-top: 10px;">
              <?php echo sexy_submit_tag('Enviar'); ?>
            </td>
          </tr>
        </tbody>
      </table>
      </form>
      <br><br>
      <?php echoNotaInformativa('', '<strong>Si necesita ayuda o consejo</strong> sobre el uso de la plataforma , puedes utilizar este formulario para enviarnos tu consulta.'); ?>
    </div>
    <br>
    <?php use_helper('volver'); echo volver();  ?>
  </div>
  <div class="cierre_principal"></div>
</div>
