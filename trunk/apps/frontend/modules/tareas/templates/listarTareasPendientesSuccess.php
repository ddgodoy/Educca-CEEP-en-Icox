<?php use_helper('Text') ?>
<?php use_helper('informacion') ?>
<?php if ($corto):?>
  <div class="titulos_tabla_general_corto">
    <table class="tabla_tareas_pendientes_corto">
<?php else:?>
  <div class="titulos_tabla_general">
    <table class="tabla_tareas_pendientes">
<?php endif;?>

    <tr>
      <th class="td1">&nbsp;&nbsp;Ejercicio a realizar</th>
      <th class="td2">Curso</th>
      <th class="td3">Estado</th>
      <th class="td4">Fecha entrega</th>
    </tr>
  </table>
</div>


<?php if ($corto):?>
  <?php $lim1 = 30; $lim2 = 26; ?>
  <div id="ejercicios" class="listado_tabla_general_corto">
    <table class="tabla_tareas_pendientes_corto">
<?php else:?>
  <?php $lim1 = 46; $lim2 = 41; ?>
  <div class="listado_tabla_general">
    <table class="tabla_tareas_pendientes">
<?php endif;?>

    <?php for($index=0; $index < sizeof($tareas); $index++):?>
      <?php $info_tarea = $info_tareas[$index];?>
      <?php $tarea = $tareas[$index];?>
      <?php $evento = $eventos[$index];?>
      <?php $curso = $cursos[$index];?>
      <?php $fondo = (($index % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
      <?php echo("<tr$fondo>"); ?>
        <td class="td1">&nbsp;&nbsp;<?php echo link_to(truncate_text($evento->getDescripcion(), $lim1), 'tareas/mostrarEjercicioTarea?id_tarea='.$tarea->getId(),array('id'=>'ln_tarea_pendiente'.$tarea->getId()))?></td>
        <td class="td2"><?php echo truncate_text($curso->getNombre(), $lim2) ?></td>
        <?php if($info_tarea->getIdEjercicioResuelto() == null):?>
          <td class="td3"><?php echo image_tag('nointentado.png','title=No intentada'); ?></td>
        <?php else:?>
          <td class="td3"><?php echo image_tag('incompleto.png','title=En desarrollo'); ?></td>
        <?php endif;?>
        <td class="td4"><?php echo($evento->getFechaFin('d-m-Y'));?></td>
      </tr>
    <?php endfor;?>
    </table>

    <?php if (!$index) : ?>
      <?php if ($corto):?>
        <?php echoAvisoVacio("No hay tareas pendientes", true); ?>
      <?php else:?>
        <?php echoAvisoVacio("No hay tareas pendientes de este curso o cursos"); ?>
      <?php endif;?>
    <?php endif; ?>
</div>


<?php if ($index) : ?>
<?php if ($corto):?>
<br>
  <div align="left">
<?php else:?>
  <div class="nota_informativa">
<?php endif;?>
  <table>
    <tr>
		 	  <td width="150"><?php echo image_tag('nointentado.png'); ?> Tarea no intentada</td>
		 	  <td width="150"><?php echo image_tag('incompleto.png'); ?> Tarea en desarrollo</td>
    </tr>
  </table>
</div>
<?php endif; ?>
