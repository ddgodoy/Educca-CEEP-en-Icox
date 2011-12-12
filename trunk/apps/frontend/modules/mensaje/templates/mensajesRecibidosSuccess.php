<?php use_helper('Javascript') ?>
<div id="mensajes_recibidos">
  <div class="tit_box_mensajes"><h2 class="titbox">Mensajes Recibidos</h2></div>
  <div class="cont_box_correo">
    <?php echo form_tag('mensaje/mensajesRecibidos') ?>
      <div class="herramientas_general">
        <table style="width: 100%;">
          <tr>
            <td style="width: 13%;">
              <input class="boton_gris_herramientas1" onclick="if (confirm('Confirme que quiere borrar los mensajes seleccionados (estos mensajes se mover\u00e1n a la papelera de mensajes)')) {new Ajax.Updater('listado_mensajes_recibidos', '/mensaje/borrarMensajesRecibidos', {asynchronous:true, evalScripts:false, parameters:Form.serialize(this.form)});} return false;" name="delete" value="Eliminar" type="button">
            </td>
            <td style="width: 17%; font-size: 11px; font-family: ">
              Mostrar mensajes de:
            </td>
            <td style="width: 70%;">
              <?php echo select_tag('filtro', options_for_select($cursos), 'class=select_general') ?>
              <?php echo observe_field('filtro', array('update'=>'listado_mensajes_recibidos', 'url'=>'mensaje/listarMensajesRecibidos', 'with' => "'filtro=' + value")) ?>
            </td>
          </tr>
        </table>
      </div>
      <div id="listado_mensajes_recibidos">
      </div>
      <?php echo javascript_tag(remote_function(array('update' => 'listado_mensajes_recibidos', 'url' => 'mensaje/listarMensajesRecibidos')))?>
    </form>
    <br><? use_helper('volver'); echo volver(); ?>
  </div>
 <div class="cierre_box_correo"></div>
</div>
