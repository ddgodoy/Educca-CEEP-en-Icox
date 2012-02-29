
<?php if ($ejercicio->getTipo() == 'test'):?>
  <div id="cuestiones_test"></div>
  <?php echo javascript_tag(remote_function(array('update' => "cuestiones_test", 'url' => "ejercicio/mostrarTest$redireccion")))?>
<?php endif;?>



<?php if ($ejercicio->getTipo() == 'cuestionario'):?>
  <div id="cuestiones_cortas"></div>
<?php echo javascript_tag(remote_function(array('update' => "cuestiones_cortas", 'url' => "ejercicio/mostrarCuestionario$redireccion", 'script' => true)))?>
<?php endif;?>



<?php if ($ejercicio->getTipo() == 'problemas'):?>
  <? if ( false !== stripos($redireccion,'mostrar_respuestas=2') ): ?>
     <?php
     $cad=substr($redireccion, stripos($redireccion,'id_respuesta_ejercicio'));
     $cad=substr($cad, 0,strpos($cad,'&'));
     $id_respuesta_ejercicio=(int)substr($cad, strpos($cad, '=')+1);
     include_partial('ejercicio/respuestasProblemas', array('ejercicio' => $ejercicio, 'redireccion' => $redireccion,'id_respuesta_ejercicio'=>$id_respuesta_ejercicio)) ;?>
  <? endif; ?>
  <div id="cuestiones_practicas"></div>
<?php echo javascript_tag(remote_function(array('update' => "cuestiones_practicas", 'url' => "ejercicio/mostrarProblemas$redireccion")))?>
<?php endif;?>


