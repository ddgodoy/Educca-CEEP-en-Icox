<?php use_helper('Text') ?>
<?php use_helper('informacion') ?>
<div class="titulos_tabla_general">
  <table class="tabla_cambiar_tareas">
    <tr>
      <th class="td1">Ejercicio a realizar</th>
      <th class="td2">Curso</th>
      <th class="td3">Categor&iacute;a</th>
      <th class="td4">Alumnos</th>
      <th class="td5">Comienzo</th>
      <th class="td6">Fin</th>
    </tr>
  </table>
</div>

<div class="listado_tabla_general">
  <table class="tabla_cambiar_tareas">
    <?php $ahora = time();?>
    <?php for ($index = 0; $index < sizeof($eventos); $index++): ?>
      <?php $tarea = $tareas[$index];?>
      <?php if($tarea->getId() != 354): ?>
       <?php $fondo = (($index % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
       <?php echo("<tr$fondo>"); ?>
        <?php $evento = $eventos[$index];?>
        <?php $curso = $cursos[$index];?>
        <?php $tipo_evento = $tipos_evento[$index];?>

        <td class="td1"><?php echo link_to($evento->getDescripcion(), 'seguimiento/mostrarTarea?id_tarea='.$tarea->getId(),array('id'=>'ln_tarea_'.$tarea->getId())) ?></td>
        <td class="td2"><?php echo $curso->getNombre() ?></td>
        <td class="td3"><?php echo $tipo_evento->getDescripcion() ?></td>
        <td class="td4"><?php echo $tarea->contar_alumnos() ?></td>
        <td class="td5"><?php echo($evento->getFechaInicio('d-m-Y')); ?></td>
        <td class="td6"><?php echo($evento->getFechaFin('d-m-Y')); ?></td>

      </tr>
      <?php endif; ?>
    <?php endfor; ?>
    </table>
    <?php if (!$index) : ?>
      <?php echoAvisoVacio("No se han puesto tareas o ex&aacute;menes para este curso o cursos"); ?>
    <?php endif; ?>

</div>
