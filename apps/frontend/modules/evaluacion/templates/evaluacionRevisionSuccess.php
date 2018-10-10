<?php use_helper('Javascript') ?>
<?php use_helper('informacion') ?>
<?php use_helper('formularios') ?>
<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal"><h2 class="titbox">Evaluaci&oacute;n y revisi&oacute;n de ejercicios</h2></div>
  <div class="contenido_principal">

  <div class="filtro_general">
    Filtrar por curso:
    <?php echoSelectwMatch('filtro', $id_curso, $cursos, array('class' => 'select'));?>
    <?php echo observe_field('filtro', array('update'=>'listado_evaluacion', 'url'=>'evaluacion/listarTareasEvaluacion', 'with' => "'filtro=' + value")) ?>
  </div>

  <div id="listado_evaluacion"></div>
  <?php echo javascript_tag(remote_function(array('update' => 'listado_evaluacion', 'url' => 'evaluacion/listarTareasEvaluacion?filtro='.$id_curso))) ?>

  <br>
  <?php echoNotaInformativa('Ayuda para evaluaci&oacute;n', 'Es recomendable que antes de evaluar un ejercicio cree una soluci&oacute;n para este. As&iacute; a la hora de corregir se le mostrar&aacute; la soluci&oacute;n para poder compararla con la respuesta del alumno. Los tests se corrigen de forma autom&aacute;tica y para que esta funci&oacute;n est&eacute; disponible es necesario que usted cree antes la soluci&oacute;n del mismo.'); ?>

  </div>
  <div class="cierre_box_tareas"></div>
</div>
