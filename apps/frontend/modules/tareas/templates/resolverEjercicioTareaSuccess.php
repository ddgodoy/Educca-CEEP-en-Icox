<?php use_helper('Javascript') ?>

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
  <div class="titulo_principal"><h2 class="titbox"><?php echo $ejercicio->getTitulo() ?></h2></div>

  <?php echo form_tag('tareas/guardarResultadosTarea?id_tarea='.$tarea->getId(), array('name' => 'form1', 'enctype' => 'multipart/form-data', 'onSubmit' => 'return guardarResultados()')) ?>
  <?php echo input_hidden_tag('id_ejercicio', $ejercicio->getId()) ?>
  <?php echo input_hidden_tag('id_respuesta_ejercicio', $id_respuesta_ejercicio) ?>
  <?php echo input_hidden_tag('tiempo', 0) ?>
  <div style='display:none;'><input type='submit' value='guardarTarea'></div>

  <div class="contenido_principal">

    <div class="herramientas_general">
      <?php include_partial('opcionesEjercicioTarea', array('tarea' => $tarea, 'relacion' => $relacion, 'modo' => 'resolver', 'id_respuesta_ejercicio' => $id_respuesta_ejercicio)) ?>
      <?php include_partial('ejercicio/cabeceraEjercicio', array('ejercicio' => $ejercicio, 'rol' => 'alumno', 'modo' => 'tarea', 'estado_tarea' => $estado)) ?>
    </div>

    <?php include_partial('ejercicio/contenidoEjercicio', array('ejercicio' => $ejercicio, 'redireccion' => $redireccion)) ?>

  </div>
  </form>
  <div class="cierre_principal"></div>
</div>
