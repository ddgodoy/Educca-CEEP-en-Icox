<?php use_helper('Javascript') ?>
<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal"><h2 class="titbox"><?php echo $ejercicio->getTitulo() ?></h2></div>

  <?php echo form_tag('evaluacion/guardarEvaluacion', array('onSubmit' => 'return conf_guardar_eval();')) ?>
  <?php echo input_hidden_tag('id_ejercicio', $ejercicio->getId()) ?>
  <?php echo input_hidden_tag('solucion_alumno', $respuesta_ejercicio->getId()) ?>

  <div class="contenido_principal">

    <div class="herramientas_general">
      <?php include_partial('opcionesEjercicioEvaluacion', array('modo' => 'evaluando', 'id_respuesta_ejercicio' => $respuesta_ejercicio->getId())) ?>
      <?php include_partial('ejercicio/cabeceraEjercicio', array('ejercicio' => $ejercicio, 'rol' => 'profesor', 'modo' => 'evaluacion', 'nota' => $nota, 'nombre_alumno' => $nombre_alumno)) ?>
    </div>

    <?php include_partial('ejercicio/contenidoEjercicio', array('ejercicio' => $ejercicio, 'redireccion' => $redireccion)) ?>

  </div>
  </form>
  <div class="cierre_principal"></div>
</div>
