<?php use_helper('Javascript') ?>
<?php use_helper('informacion') ?>
<script type="text/javascript">

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
  <div class="titulo_principal">
    <h2 class="titbox">
      <?php if($rol == 'profesor'):?>
        Edici&oacute;n de la soluci&oacute;n - <?php echo $ejercicio->getTitulo() ?>
      <?php endif;?>
      <?php if($rol == 'alumno'):?>
        Resolver <?php echo $ejercicio->getTitulo() ?>
      <?php endif;?>
    </h2>
  </div>
  <?php echo form_tag('ejercicio/guardarResultadosEjercicio', array('name' => 'form1', 'enctype' => 'multipart/form-data', 'onSubmit' => 'return guardarResultados()')) ?>
  <?php echo input_hidden_tag('id_ejercicio', $ejercicio->getId()) ?>
  <?php echo input_hidden_tag('id_respuesta_ejercicio', $id_respuesta_ejercicio) ?>
  <?php echo input_hidden_tag('tiempo', 0) ?>
  <div class="contenido_principal">

    <div class="herramientas_general">
      <div style='display:none;'><input type='submit' value='guardarEjercicio' name='guardarEjercicio' /></div>
      <?php include_partial('opcionesEjercicio', array('ejercicio' => $ejercicio, 'modo' => 'resolver', 'rol' => $rol)) ?>
      <?php include_partial('cabeceraEjercicio', array('ejercicio' => $ejercicio, 'rol' => $rol, 'modo' => 'mostrar')) ?>
    </div>

    <?php if ($error_log != ''):?>
      <br><?php echoWarning('', $error_log); ?>
    <?php endif;?>
    <?php include_partial('contenidoEjercicio', array('redireccion' => $redireccion,
                                                      'ejercicio'=> $ejercicio )); ?>
    </form>
    <?php use_helper('volver'); echo volver();  ?>
  </div>
  </form>
  <div class="cierre_principal"></div>
</div>
