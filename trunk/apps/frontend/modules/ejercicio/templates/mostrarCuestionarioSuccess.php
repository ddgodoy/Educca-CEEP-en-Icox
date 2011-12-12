<?php use_helper('Javascript') ?>
<?php use_helper('informacion') ?>

<?php if ($ejercicio->getTipo() == 'cuestionario'):?>
  <?php if (!$cuestiones_cortas):?>
    <?php if ($rol == 'profesor'):?>
      <br><br>
      <h2>EL CUESTIONARIO EST&Aacute; VAC&Iacute;O </h2>
    <?php endif;?>
  <?php else:?>
  <?php if ($mostrar_edicion == 2):?>
    <br><br>
    <?php echoWarning('', 'Este ejercicio ya ha sido resuelto por alg&uacute;n alumno o est&aacute; asociado a alguna tarea o examen. En consecuencia no se podr&aacute;n a&ntilde;adir ni eliminar preguntas del mismo.'); ?>
  <?php endif;?>

  <br><br>
  <h2>CUESTIONARIO</h2>
<?php endif;?>

  <?php if ($mostrar_edicion == 1):?>
    <br><br>
    <form>
    <?php echo (input_hidden_tag('id_ejercicio', $ejercicio->getId())); ?>
    <?php echo submit_to_remote('ajax_submit','A&ntilde;adir pregunta', array('update' => 'cuestiones_cortas', 'url' => 'ejercicio/mostrarCuestionario?add=1&mostrar_edicion=1')) ?>
    </form>
  <?php endif;?>

  <br><br>

  <table class="tabla_cuestionario">
  <?php $indice = 1; foreach($cuestiones_cortas as $cuestion_corta): ?>
    <tr><td>
      <?php if ($mostrar_edicion == 0):?>
        <?php echo("<div id=\"cuestion_corta$indice\" class=\"div_cuestion_corta\">");?>
        <?php include_partial('mostrarCuestionCorta', array('cuestion_corta' => $cuestion_corta, 'indice' => $indice, 'mostrar_edicion' => 0, 'mostrar_solucion' => $mostrar_solucion, 'mostrar_respuestas' => $mostrar_respuestas, 'mostrar_correccion' => $mostrar_correccion, 'id_respuesta_ejercicio' => $id_respuesta_ejercicio)) ?>
      <?php else:?>
        <?php echo form_remote_tag(array('update' => "cuestion_corta$indice", 'url' => 'ejercicio/editarCuestionCorta', 'script' => true)) ?>
        <?php echo("<div id=\"cuestion_corta$indice\" class=\"div_cuestion_corta\">");?>
        <?php include_partial('mostrarCuestionCorta', array('cuestion_corta' => $cuestion_corta, 'indice' => $indice, 'mostrar_edicion' => $mostrar_edicion, 'mostrar_solucion' => $mostrar_solucion, 'mostrar_respuestas' => $mostrar_respuestas, 'mostrar_correccion' => 0)) ?>
        </form>
      <?php endif;?>
    <?php $indice++;?>
    </div>
    <br><br>
    </td></tr>
  <?php endforeach; ?>

  </table>

  <?php if ($cuestiones_cortas && (($mostrar_respuestas == 2) || ($mostrar_correccion == 2))):?>
    <?php {echo (input_hidden_tag('total_preguntas_cuestionario', $indice));}?>
  <?php endif;?>

<?php endif;?>
