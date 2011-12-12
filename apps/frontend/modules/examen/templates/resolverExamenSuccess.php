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


    if (tiempo_restante <= 0) {
      document.getElementById('finalizar').value = 1;
      document.form1.submit();
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


  var inicio = new Date();

  function guardarResultados() {
    var fin = new Date();
    var duracion = fin.getTime() - inicio.getTime();
    duracion = Math.round(duracion / 1000);
    document.form1.tiempo.value = duracion;
    return true;
  }


</script>

<div class="capa_principal" id="ejercicios">
  <div class="titulo_principal"><h2 class="titbox"><?php echo $ejercicio->getTitulo() ?></h2></div>

  <?php echo form_tag('examen/guardarResultadosExamen', array('name' => 'form1', 'enctype' => 'multipart/form-data', 'onSubmit' => 'return guardarResultados()')) ?>
  <?php echo input_hidden_tag('id_ejercicio', $ejercicio->getId()) ?>
  <?php echo input_hidden_tag('id_respuesta_ejercicio', $id_respuesta_ejercicio) ?>
  <?php echo input_hidden_tag('tiempo', 0) ?>
  <?php echo input_hidden_tag('finalizar', 0) ?>
  <?php echo input_hidden_tag('backup', 0) ?>
  <div style='display:none;'><input type='submit' value='guardarExamen'></div>

  <div class="contenido_principal">

    <div class="herramientas_general">
       <?php include_partial('opcionesExamen', array('relacion' => $relacion, 'modo' => 'resolver')) ?>
       <?php include_partial('ejercicio/cabeceraEjercicio', array('ejercicio' => $ejercicio, 'modo' => 'examen', 'rol' => 'alumno')) ?>
    </div>

    <script language="javascript" type="text/javascript">
    new PeriodicalExecuter(actualizar_contador, 1)

    function backupResultados() {
      document.getElementById('backup').value = 1;
      new Ajax.Updater('div_backup', '/examen/guardarResultadosExamen', {asynchronous:true, evalScripts:false, parameters:Form.serialize(document.form1)});
      document.getElementById('backup').value = 0;
    }

    new PeriodicalExecuter(backupResultados, 303)
    </script>

    <br>
    <?php if ($tipo_examen == 'sorpresa'):?>
        <?php echoNotaInformativa('Le han puesto un examen sorpresa. Durante la realizaci&oacute;n del mismo todas las funciones de la plataforma estar&aacute;n deshabilitadas', ''); ?>
    <?php else:?>
        <?php echoNotaInformativa('Durante la realizaci&oacute;n de un examen todas las funciones de la plataforma estar&aacute;n deshabilitadas', ''); ?>
    <?php endif;?>

    <br>
    <?php echoNotaInformativa('Mientras est&eacute; contestando a las preguntas del examen los resultados se guardar&aacute;n de forma autom&aacute;tica cada 5 minutos. Si se le acaba el tiempo se entregar&aacute; el examen autom&aacute;ticamente con sus &uacute;ltimas respuestas y se le llevar&aacute; de vuelta a la pantalla de entrada de la plataforma', ''); ?>

    <?php include_partial('ejercicio/contenidoEjercicio', array('ejercicio' => $ejercicio, 'redireccion' => $redireccion)) ?>

    <div id="div_backup"></div>
    <?php if ($tipo_examen == 'sorpresa'):?>
      <div id="actualizar"></div>
      <?php echo periodically_call_remote(array('frequency' => 120, 'update' => 'actualizar', 'url' => 'examen/refresh')) ?>
    <?php endif; ?>

  </div>
  </form>
  <div class="cierre_principal"></div>
</div>
