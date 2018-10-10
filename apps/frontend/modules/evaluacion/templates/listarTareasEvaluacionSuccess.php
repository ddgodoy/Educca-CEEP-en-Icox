<?php use_helper('Text') ?>
<?php use_helper('informacion') ?>
<div class="titulos_tabla_general">
  <table class="tabla_tareas_evaluacion">
    <tr>
      <td class="td1"><b>Ejercicio</b></td>
      <td class="td2"><b>Curso</b></td>
      <td class="td3"><b>Categor&iacute;a</b></td>
      <td class="td4"><b>Pendientes</b></td>
      <td class="td5"><b>Fecha de entrega</b></td>
    </tr>
  </table>
</div>

<div class="listado_tabla_general">
  <table class="tabla_tareas_evaluacion">
    <?php $ahora = time();?>
    <?php for ($index = 0; $index < sizeof($eventos); $index++): ?>
      <?php $fondo = (($index % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
      <?php echo("<tr$fondo>"); ?>
        <?php $tarea = $tareas[$index];?>
        <?php $evento = $eventos[$index];?>
        <?php $curso = $cursos[$index];?>
        <?php $tipo_evento = $tipos_evento[$index];?>

        <td class="td1"><?php echo link_to($evento->getDescripcion(), 'evaluacion/mostrarTareaEvaluacion?id_tarea='.$tarea->getId(),array('id' => 'ln_evaluacion_tarea'.$tarea->getId())) ?></td>
        <td class="td2"><?php echo $curso->getNombre() ?></td>
        <td class="td3"><?php echo $tipo_evento->getDescripcion() ?></td>
        <td class="td4"><?php echo $tarea->contar_pendientes() ?></td>
        <td class="td5"><?php echo $evento->getFechaFin('d-m-Y') ?></td>
      </tr>
    <?php endfor; ?>
    </table>

    <?php if (!$index):?>
      <?php echoAvisoVacio('No hay ejercicios que corregir o revisar de este curso o cursos');?>
    <?php endif; ?>

</div>
