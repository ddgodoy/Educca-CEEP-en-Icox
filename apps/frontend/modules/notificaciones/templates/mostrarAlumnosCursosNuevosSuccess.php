<?php use_helper('Text'); ?>
<?php use_helper('SexyButton'); ?>

<form action="admin/eliminarNotificaciones" method="POST">
    <div class="nombrescol" style="width:99%; border-top: #CCCCCC 1px solid;">
        <table style="width: 702px;">
              <tr>
                <th style="width: 4%; text-align: center;"><input type="checkbox" id="checkmaster1" onclick="checkAll('checknt1', 'checkmaster1');"></th>
                <th style="width: 31%; text-align: left; padding-left: 3px;">Tipo</th>
                <th style="width: 40%; text-align: left;">Descripci&oacute;n</th>
                <th style="width: 13%; text-align: center;">Fecha </th>
                <th style="width: 12%; text-align: center;">Opciones</th>
              </tr>
        </table>
    </div>
    <div class="nuevosAlumnos" style="width:99%;">

        <table style="width: 702px;">    <?php $i = 0; ?>
          <?php if ($notificaciones) :?>
                <?php foreach($notificaciones as $notificacion): ?>
                  <?php $fondo = (($i % 2) == 0)? "id=\"filarayada\"" : ''; ?>
                  <tr <?php echo $fondo;?> height="18">
                    <td style="width: 4%; text-align: center;"><input type="checkbox" id="checknt1" name="checkn<?php echo $i?>" value="<?php echo $notificacion->getId(); ?>"></td>
                    <td style="padding-left: 3px; width: 31%; text-align: left;"><?php echo link_to(truncate_text(html_entity_decode($notificacion->getTitulo(), ENT_NOQUOTES, 'UTF-8'), 40), 'notificaciones/mostrarNotificacion?id_notificacion='.$notificacion->getId()) ?></td>
                    <td style="width: 40%; text-align: left;"><?php echo truncate_text(html_entity_decode($notificacion->getContenido(), ENT_NOQUOTES, 'UTF-8'), 50) ?></td>
                    <td style="width: 13%; text-align: center;"><?php echo $notificacion->getFecha("d-m-Y") ?></td>
                    <td style="width: 12%; text-align: center;"><?php echo link_to(image_tag('papelera.gif','Alt="Borrar esta notificaci&oacute;n" Title="Borrar esta notificaci&oacute;n" align=absmiddle'), 'admin/eliminarNotificacion?idnotificacion='.$notificacion->getId(),'confirm=&iquest;Esta seguro que desea eliminar la notificaci&oacute;n '.' ?') ?></td>
                  </tr>
                  <?php $i++; ?>
                <?php endforeach; ?>
           <?php else : ?>
                 <tr>
                    <td class="tdnoaviso">
                    <br><br><br><br>
                      <?php echo image_tag('info.gif', 'Title=Info', 'class=imginfo') ?>
                        <span class="txtinfo">No hay matr&iacute;culas nuevas</span>
                    </td>
                </tr>
           <?php endif; ?>
        </table>
    </div>

  <input type="hidden" name="total_notificaciones" value="<?php echo $i; ?>">
  <div style="padding-top: 4px;">
  <input class="boton_gris_herramientas3" type="submit" value="Eliminar seleccionados" onclick="return confirm('Confirme que quiere borrar todas las notificaciones seleccionadas');">
  </div>
</form>
