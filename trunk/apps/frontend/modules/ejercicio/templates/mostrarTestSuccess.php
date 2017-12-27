<?php use_helper('Javascript') ?>
<?php use_helper('informacion') ?>

<?php if ($ejercicio->getTipo() == 'test'):?>
  <?php if (!$cuestiones_test):?>
    <?php if ($rol == 'profesor'):?>
      <br><br>
      <h2>EL TEST EST&Aacute; VAC&Iacute;O </h2>
    <?php endif;?>
  <?php else:?>
  <?php if ($mostrar_edicion == 2):?>
    <br><br>
    <?php echoWarning('', 'Este ejercicio ya ha sido resuelto por alg&uacute;n alumno o est&aacute; asociado a alguna tarea o examen. En consecuencia no se podr&aacute;n a&ntilde;adir ni eliminar preguntas del mismo.'); ?>
  <?php endif;?>

  <br><br>
  <h2>PREGUNTAS DE TEST</h2>
<?php endif;?>

  <?php if ($mostrar_edicion == 1):?>
    <br><br>
    <form>
    <?php echo (input_hidden_tag('id_ejercicio', $ejercicio->getId())); ?>
    <?php echo submit_to_remote('ajax_submit', 'A&ntilde;adir pregunta', array('update' => 'cuestiones_test', 'url' => 'ejercicio/mostrarTest?add=1&mostrar_edicion=1'))?>
    </form>
  <?php endif;?>
  <br><br>
  <table class="tabla_test">

  <?php $indice = 1; foreach($cuestiones_test as $cuestion_test): ?>

    <tr><td>
      <?php if ($mostrar_edicion == 0):?>
        <?php echo("<div id=\"cuestion_test$indice\" class=\"div_cuestion_test\">");?>
        <?php include_partial('mostrarCuestionTest', array('cuestion_test' => $cuestion_test, 'indice' => $indice, 'mostrar_edicion' => 0, 'mostrar_solucion' => $mostrar_solucion, 'mostrar_respuestas' => $mostrar_respuestas, 'id_respuesta_ejercicio' => $id_respuesta_ejercicio, 'test_resta' => $ejercicio->getTestResta(), 'expresiones_matematicas' => $ejercicio->getExpresionesMatematicas())) ?>
        </div>
      <?php else:?>
        <?php echo form_remote_tag(array('update' => "cuestion_test$indice", 'url' => 'ejercicio/editarCuestionTest')) ?>
        <?php echo("<div id=\"cuestion_test$indice\" class=\"div_cuestion_test\">");?>
        <?php include_partial('mostrarCuestionTest', array('cuestion_test' => $cuestion_test, 'indice' => $indice, 'mostrar_edicion' => $mostrar_edicion, 'mostrar_solucion' => $mostrar_solucion, 'mostrar_respuestas' => $mostrar_respuestas, 'test_resta' => $ejercicio->getTestResta(), 'expresiones_matematicas' => $ejercicio->getExpresionesMatematicas())) ?>
        </div>
        </form>
      <?php endif;?>
      <?php $indice++; ?>
      <br>
    </td></tr>
  <?php endforeach; ?>
  </table>

  <?php if (($mostrar_respuestas == 2) && $cuestiones_test):?>
    <?php {echo (input_hidden_tag('total_preguntas_test', $indice));}?>
  <?php endif;?>

<?php endif;?>
