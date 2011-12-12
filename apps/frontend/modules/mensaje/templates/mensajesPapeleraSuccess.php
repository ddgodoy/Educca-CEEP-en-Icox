<?php use_helper('Javascript') ?>
<div id="mensajes_recibidos">
  <div class="tit_box_mensajes"><h2 class="titbox">Mensajes Borrados</h2></div>
  <div class="cont_box_correo">
    <?php echo form_tag('mensaje/mensajesRecibidos') ?>
      <div class="herramientas_general">
        <table style="width: 100%;">
          <tr>
            <td style="width: 10%;">
              <input class="boton_gris_herramientas2" onclick="new Ajax.Updater('listado_mensajes_papelera', '/mensaje/recuperarMensajesPapelera', {asynchronous:true, evalScripts:false, parameters:Form.serialize(this.form)});" name="recover" value="Recuperar" type="button">
            </td>
            <td style="width: 12%;">
              <input class="boton_gris_herramientas1" onclick="if (confirm('Confirme que quiere borrar los mensajes seleccionados, estos mensajes se eliminar\u00e1n de forma permanente')) {new Ajax.Updater('listado_mensajes_papelara', '/mensaje/borrarMensajesPapelera', {asynchronous:true, evalScripts:false, parameters:Form.serialize(this.form)});} return false;" name="delete" value="Eliminar" type="button">
            </td>
            <td style="width: 17%; font-size: 11px; font-family: ">
              Mostrar mensajes de:
            </td>
            <td style="width: 61%;">
              <?php echo select_tag('filtro', options_for_select($cursos), 'class=select_general') ?>
              <?php echo observe_field('filtro', array('update'=>'listado_mensajes_papelera', 'url'=>'mensaje/listarMensajesPapelera', 'with' => "'filtro=' + value")) ?>
            </td>
          </tr>
        </table>
      </div>
      <div id="listado_mensajes_papelera">
      </div>
      <?php echo javascript_tag(remote_function(array('update' => 'listado_mensajes_papelera', 'url' => 'mensaje/listarMensajesPapelera')))?>
    </form>
    <br><? use_helper('volver');echo volver(); ?>
  </div>
 <div class="cierre_box_correo"></div>
</div>
