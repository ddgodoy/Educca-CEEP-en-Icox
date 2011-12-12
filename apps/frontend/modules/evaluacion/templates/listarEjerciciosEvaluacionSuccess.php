<?php use_helper('informacion') ?>
<?php use_helper('EjerciciosEvaluacion') ?>

<div class="titulos_tabla_general">
  <table class="evaluacion_resumen_ejercicios">
    <tr>
      <th class="td1">Ejercicio</th>
      <th class="td2">Categor&iacute;a</th>
      <th class="td3">Entregas</th>
      <th class="td4">Media de los presentados</th>
    </tr>
  </table>
</div>

<div class="listado_tabla_general">
  <table class="evaluacion_resumen_ejercicios">
    <?php $i = 0;?>
    <?php foreach($ejercicios as $ejercicio):?>
    <?php $fondo = (($i % 2 == 0))? " id=\"filarayada_verde\"" : ""; ?>
    <?php echo("<tr$fondo>"); ?>
    
      <td class="td1"><?php echo link_to($ejercicio[1], 'evaluacion/resumenEvaluacionEjercicio?id_tarea='.$ejercicio[0])?></td>
      <td class="td2"><?php echo $ejercicio[2] ?></td>
      <td class="td3"><?php echo (contarTareasEntregadas($ejercicio[0]).' de '.contarAlumnosTarea($ejercicio[0])) ?></td>
      <th class="td4"><?php $media = calcularMediaTarea($ejercicio[0]); ?>
      <?php if($media == '---'):?>
        No hay presentados
      <?php else:?>
        <?php printf("%.2f", calcularMediaTarea($ejercicio[0])) ?>
      <?php endif;?>
      </th>
      
      <?php $i++;?>
    <?php endforeach;?>    
  </table>
  
  <?php if (!$i):?>
    <?php echoAvisoVacio('Todav&iacute;a no se han puesto tareas o ex&aacute;menes en este curso'); ?>
  <?php endif; ?>
</div>

<?php if ($i):?>
  <br><?php echoNotaInformativa('', 'Para ver las calificaciones en detalle de un ejercicio concreto haga click en el nombre del ejercicio'); ?>
<?php endif; ?>
