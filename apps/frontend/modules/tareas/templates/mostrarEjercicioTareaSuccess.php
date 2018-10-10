<?php use_helper('Javascript') ?>
<?php use_helper('informacion') ?>

<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal"><h2 class="titbox"><?php echo $ejercicio->getTitulo() ?></h2></div>
  <div class="contenido_principal">

    <div class="herramientas_general">
      <?php include_partial('opcionesEjercicioTarea', array('tarea' => $tarea, 'relacion' => $relacion, 'modo' => 'mostrar', 'id_respuesta_ejercicio' => $id_respuesta_ejercicio)) ?>
      <?php include_partial('ejercicio/cabeceraEjercicio', array('ejercicio' => $ejercicio, 'tarea' => $tarea, 'rol' => 'alumno', 'modo' => 'tarea', 'estado_tarea' => $estado, 'nota' => $nota, 'nombre_alumno' => $nombre_alumno)) ?>
    </div>

    <?php if ($error_log != ''):?>
      <br><?php echoWarning('', $error_log); ?>
    <?php endif;?>

    <?php include_partial('ejercicio/contenidoEjercicio', array('ejercicio' => $ejercicio, 'redireccion' => $redireccion)) ?>

  </div>
  <div class="cierre_principal"></div>
</div>
