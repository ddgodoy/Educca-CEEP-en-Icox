<?php use_helper('Text') ?>
<?php use_helper('fechas') ?>
<?php use_helper('informacion') ?>
<div class="titulos_tabla_general">
  <table class="tabla_historial">
    <tr>
      <th class="td1">Ejercicio</th>
      <th class="td2">Curso</th>
      <th class="td3">Fecha de entrega</th>
      <th class="td4">Fecha l&iacute;mite</th>
      <th class="td5">Nota</th>
    </tr>
  </table>
</div>

<div class="listado_tabla_general">
  <table class="tabla_historial">

    <?php $count = 0; ?>
    <?php foreach($historial_entregas as $elemento):?>
      <?php $fondo = (($count % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
      <?php echo("<tr$fondo>"); ?>

        <td class="td1"><?php echo link_to($elemento[0], 'tareas/mostrarEjercicioTarea?id_tarea='.$elemento[5])?></td>

        <td class="td2"><?php echo $elemento[1] ?></td>

        <?php if ($elemento[6] != null):?>
          <?php if ($elemento[2]):?>
            <td class="td3"><?php echo darFormato($elemento[3]) ?></td>
          <?php else:?>
            <td class="td3"><?php echo darFormato($elemento[4]) ?></td>
          <?php endif;?>
        <?php else:?>
          <td class="td3">No entregado</td>
        <?php endif;?>

        <td class="td4"><?php echo darFormato($elemento[4]) ?></td>

        <?php if ($elemento[7]):?>
          <?php $solucion_alumno = Ejercicio_resueltoPeer::RetrieveByPk($elemento[6]);?>
          <th class="td5"><?php printf('%.2f', $solucion_alumno->getScore());?></th>
        <?php else:?>
          <?php if ($elemento[6] != null):?>
            <th class="td5"><div class='correccion_<?echo $elemento[5]?>'>Correcci&oacute;n pendiente</div></th>
          <?php else:?>
            <th class="td5"><div  class='correccion_<?echo $elemento[5]?>'>No presentado</div></th>
          <?php endif;?>
        <?php endif;?>

      </tr>
      <?php $count ++;?>
    <?php endforeach;?>
    </table>

    <?php if (!$count) : ?>
      <?php echoAvisoVacio("No se han entregado ejercicios de este curso o cursos."); ?>
    <?php endif; ?>

</div>
<br><br>
<?php echoNotaInformativa("Sobre las entregas", "Para las tareas o ex&aacute;menes que no est&aacute;n del todo completados o que si lo est&aacute;n pero no se entregaron expl&iacute;citamente, se entrega de forma autom&aacute;tica la &uacute;ltima versi&oacute;n guardada del ejercicio al llegar la fecha l&iacute;mite de entrega."); ?>


