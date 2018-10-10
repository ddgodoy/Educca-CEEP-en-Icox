<?php use_helper('Text') ?>
<div id="ejercicios" class="nombrescol">
  <table class="tabla_pendientes_evaluacion_corto">
    <tr>
      <th class="td1">&nbsp;&nbsp;Ejercicio</th>
      <th class="td2">Curso</th>
      <th class="td3">Pendientes</th>
    </tr>
  </table>
</div>

<div id="ejercicios">
  <table class="tabla_pendientes_evaluacion_corto">
    <?php $ahora = time();?>
    <?php for ($index = 0; $index < sizeof($eventos); $index++): ?>
      <?php $fondo = (($index % 2 == 0))? " id=\"filarayada\"" : ""; ?>
      <?php echo("<tr$fondo>"); ?>
        <?php $tarea = $tareas[$index];?>
        <?php $evento = $eventos[$index];?>
        <?php $curso = $cursos[$index];?>

        <td class="td1">&nbsp;&nbsp;<?php echo link_to(truncate_text($evento->getDescripcion(), 36), 'evaluacion/mostrarTareaEvaluacion?id_tarea='.$tarea->getId()) ?></td>
        <td class="td2"><?php echo truncate_text($curso->getNombre(), 37) ?></td>
        <td class="td3"><?php echo $tarea->contar_pendientes() ?></td>

      </tr>
    <?php endfor; ?>

    <?php if (!$index):?>
      <tr>
        <td class="tdnoaviso">
          <?php echo image_tag('info.gif', 'Title=Info', 'class=imginfo') ?>
            <span class="txtinfo">No hay ejercicios pendientes de correcci&oacute;n.</span>
        </td>
      </tr>
    <?php endif; ?>

  </table>
</div>
