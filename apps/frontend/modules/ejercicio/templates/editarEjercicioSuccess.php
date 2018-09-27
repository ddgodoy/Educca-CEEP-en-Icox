<?php use_helper('Javascript') ?>
<?php use_javascript('tiny_mce/tiny_mce') ?>
<div id="ejercicios" class="capa_principal">
  <div class="titulo_principal"><h2 class="titbox">Edici&oacute;n de contenido - <?php echo $ejercicio->getTitulo() ?></h2></div>
  <div class="contenido_principal">

  <div class="herramientas_general">
    <?php include_partial('opcionesEjercicio', array('ejercicio' => $ejercicio, 'modo' => 'edicion', 'rol' => 'profesor')) ?>
    <?php include_partial('cabeceraEjercicio', array('ejercicio' => $ejercicio, 'modo' => 'mostrar', 'rol' => 'profesor')) ?>
  </div>
  <?php include_partial('contenidoEjercicio', array('ejercicio' => $ejercicio, 'redireccion' => $redireccion)) ?>

  </div>
  <div class="cierre_principal"></div>
</div>


