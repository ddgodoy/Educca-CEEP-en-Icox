<?php use_helper('Text') ?>
<?php use_helper('SexyButton'); ?>


<?php if ("administrador"==$sf_user->hasCredential('administrador')) : ?>
<form action="admin/eliminarNotificaciones" method="POST">
  <div class="nombrescol" style="width:99%; border-top: #CCCCCC 1px solid;">
  <table style="width: 702px;">
              <tr>
                <th style="width: 4%; text-align: center;"><input type="checkbox" id="checkmaster2" onclick="checkAll('checknt2', 'checkmaster2');"></th>
                <th style="width: 31%; text-align: left; padding-left: 3px;">Tipo</th>
                <th style="width: 40%; text-align: left;">Descripci&oacute;n</th>
                <th style="width: 13%; text-align: center;">Fecha </th>
                <th style="width: 12%; text-align: center;">Opciones </th>
              </tr>
  </table>
<?php else : ?>
<!--div id="listado_mensajes_recibidos_c" class="nombrescol">
  <table class="tablamensajescorto" cellspacing="0"-->
  <div class="titulos_tabla_general_corto">
    <table class="tabla_tareas_pendientes_corto">
      <tr>
      <th class="td1">&nbsp;&nbsp;Asunto</th>
      <th class="td2">Curso</th>
      <th class="td3">Fecha</th>
    </tr>
  </table>
<?php endif; ?>
</div>


<?php if ("administrador"==$sf_user->hasCredential('administrador')) : ?>
  <div class="nuevosAlumnos" style="width:99%;">
  <table style="width: 702px;">
<?php else : ?>
<!--div id="listado_mensajes_recibidos_c" class="mensajes" style="border: #CCCCCC 1px solid;">
  <table class="tablamensajescorto" cellspacing="0"-->
  <div id="ejercicios" class="listado_tabla_general_corto">
    <table class="tabla_tareas_pendientes_corto">
<?php endif; ?>


    <?php $index = 0; ?>
    <?php foreach ($notificaciones as $notificacion): ?>
      <?php $fondo = (($index % 2 == 0))? " id=\"filarayada\"" : ""; ?>

      <?php if ("administrador"==$sf_user->hasCredential('administrador')) : ?>
       <?php echo("<tr$fondo height=\"17\">"); ?>
        <td style="width: 4%; text-align: center;"><input type="checkbox" id="checknt2" name="checkn<?php echo $index?>" value="<?php echo $notificacion->getId(); ?>"></td>
        <td style="padding-left: 3px; width: 31%; text-align: left;"><?php echo link_to(truncate_text(html_entity_decode($notificacion->getTitulo(), ENT_NOQUOTES, 'UTF-8'), 40), 'notificaciones/mostrarNotificacion?id_notificacion='.$notificacion->getId()) ?></td>
        <td style="width: 40%; text-align: left;">
          <?php if ($notificacion->getCurso()) : ?>
            <?php echo truncate_text($notificacion->getCurso()->getNombre(), 54) ?>
          <?php else: ?>
            <?php echo truncate_text(html_entity_decode($notificacion->getContenido(), ENT_NOQUOTES, 'UTF-8'), 50) ?>
          <?php endif; ?>
        </td>
        <td style="width: 13%; text-align: center;"><?php echo $notificacion->getCreatedAt('d/m/Y') ?></td>
        <td style="width: 12%; text-align: center;"><?php echo link_to(image_tag('papelera.gif','Alt="Borrar esta notificaci&oacute;n" Title="Borrar esta notificaci&oacute;n" align=absmiddle'), 'admin/eliminarNotificacion?idnotificacion='.$notificacion->getId(),'confirm=&iquest;Esta seguro que desea eliminar la notificaci&oacute;n '.' ?') ?></td>
      <?php else : ?>
        <tr class="noleido" <?= $fondo;?>>
        <td class="td1">&nbsp;&nbsp;<div class='c_notificacion_<?php echo $notificacion->getId()?>'><?php echo link_to(truncate_text($notificacion->getTitulo(), 33), 'notificaciones/mostrarNotificacion?id_notificacion='.$notificacion->getId(),array('id'=>'ln_notificacion'.$notificacion->getId())) ?></div></td>
        <td class="td2">
          <?php if ($notificacion->getCurso()) : ?>
            <?php echo truncate_text($notificacion->getCurso()->getNombre(), 50) ?>
          <?php else: ?>
            <?php echo truncate_text($notificacion->getContenido(), 50) ?>
          <?php endif; ?>
        </td>
        <td class="td3"><?php echo $notificacion->getCreatedAt('d/m/Y') ?></td>
      <?php endif; ?>
      </tr>





      </tr>
      <?php $index++; ?>
    <?php endforeach; ?>

    <?php if (!$index):?>
      <tr>
        <td class="tdnoaviso">
        <br>
          <?php echo image_tag('info.gif', 'Title=Info', 'class=imginfo') ?>
            <span class="txtinfo">No ha recibido ninguna notificaci&oacute;n</span>
        </td>
      </tr>
    <?php endif; ?>

  </table>
</div>
<?php if ("administrador"==$sf_user->hasCredential('administrador')) : ?>
  <input type="hidden" name="total_notificaciones" value="<?php echo $index; ?>">
  <div style="padding-top: 4px;">
  <input class="boton_gris_herramientas3" type="submit" value="Eliminar seleccionados" onclick="return confirm('Confirme que quiere borrar todas las notificaciones seleccionadas');">
  </div>
</form>
<?php endif; ?>
