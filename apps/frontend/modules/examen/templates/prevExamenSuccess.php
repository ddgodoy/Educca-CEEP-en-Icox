<?php use_helper('Javascript') ?>
<?php use_helper('informacion') ?>

  <script language="javascript" type="text/javascript">

    var tiempo_restante = <?php echo $diferencia ?>;

    function actualizar_contador () {
      var horas = Math.floor(tiempo_restante / 3600);
      var minutos = Math.floor(tiempo_restante / 60) % 60;
      var segundos = tiempo_restante % 60;
      var tm;
      var ts;

      if (tiempo_restante <= 0)
      {
        window.location.replace('entregarExamen');
      }
      else
      {
        if (horas < 10) {th = '0'+horas;}
        else {th = horas;}

        if (minutos < 10) {tm = '0'+minutos;}
        else {tm = minutos;}

        if (segundos < 10) {ts = '0'+segundos;}
        else {ts = segundos;}

        document.getElementById('contador').value = th+':'+tm+':'+ts;
        tiempo_restante--;
      }
    }

  </script>




<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal">
    <h2 class="titbox">
      <?php if ($tipo_examen == 'sorpresa'):?>
        Examen sorpresa - <?php echo $curso->getNombre() ?>
      <?php else:?>
        Examen - <?php echo $curso->getNombre() ?>
      <?php endif;?>
    </h2>
  </div>
  <div class="contenido_principal">

    <div class="herramientas_general">
      <?php include_partial('opcionesExamen', array('relacion' => $relacion, 'modo' => 'mostrar')) ?>
      <?php include_partial('ejercicio/cabeceraEjercicio', array('ejercicio' => $ejercicio, 'modo' => 'examen', 'rol' => 'alumno')) ?>
    </div>
    <script language="javascript" type="text/javascript">
    new PeriodicalExecuter(actualizar_contador, 1)
    </script>
    <br>
    <?php if ($tipo_examen == 'sorpresa'):?>
        <?php echoNotaInformativa('Le han puesto un examen sorpresa. Durante la realizaci&oacute;n del mismo todas las funciones de la plataforma estar&aacute;n deshabilitadas', ''); ?>
    <?php else:?>
        <?php echoNotaInformativa('Durante la realizaci&oacute;n de un examen todas las funciones de la plataforma estar&aacute;n deshabilitadas', ''); ?>
    <?php endif;?>

    <br>
    <?php echoNotaInformativa('Mientras est&eacute; contestando a las preguntas del examen los resultados se guardar&aacute;n de forma autom&aacute;tica cada 5 minutos. Si se le acaba el tiempo se entregar&aacute; el examen autom&aacute;ticamente con sus &uacute;ltimas respuestas y se le llevar&aacute; de vuelta a la pantalla de entrada de la plataforma', ''); ?>

    <?php if ($error_log != ''):?>
      <br><?php echoWarning('', $error_log); ?>
    <?php endif;?>

    <?php include_partial('ejercicio/contenidoEjercicio', array('ejercicio' => $ejercicio, 'redireccion' => $redireccion)) ?>


    <?php if ($tipo_examen == 'sorpresa'):?>
      <div id="actualizar"></div>
      <?php echo periodically_call_remote(array('frequency' => 120, 'update' => 'actualizar', 'url' => 'examen/refresh')) ?>
    <?php endif; ?>


  </div>
  <div class="cierre_principal"></div>
</div>
