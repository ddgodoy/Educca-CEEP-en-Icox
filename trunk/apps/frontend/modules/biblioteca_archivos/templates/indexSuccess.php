<?php use_helper('Javascript') ?>
<div id="mistemas">
  <div class="tit_box_mensajes"><h2 class="titbox"><?= $curso->getNombre()?> - Biblioteca de archivos</h2></div>
  <div class="cont_box_correo">
    <?php echo form_tag('mensaje/mensajesRecibidos') ?>
      <?php if ($sf_user->hasCredential('profesor')) : ?>
      <div class="herramientas_general">
        <table style="width: 100%;">
          <tr>
            <td>
              <input class="boton_gris_herramientas1" style="width:100px;" onclick="window.location='<?=url_for('biblioteca_archivos/nuevo?idcurso='.$curso->getId())?>'"  name="add" value="Subir fichero" type="button">
            </td>
            <td></td>
          </tr>
        </table>
      </div>
      <?php endif ?>
      
      <?php include_component('biblioteca_archivos','listarBiblioteca',array('id_curso' => $curso->getId() )); ?>
      
      
      <div id="listado_mensajes_recibidos">
      </div>
    </form>
    <br><?php use_helper('volver'); echo volver(); ?>
  </div>
 <div class="cierre_box_correo"></div>
</div>

