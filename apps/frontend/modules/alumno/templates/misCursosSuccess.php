<?php use_helper('SexyButton') ?>
<div id="miscursos">
  <?php include_component('curso', 'listaCursosAlumno') ?>
</div>
<?php slot('columna_derecha') ?>
  <?php include_component('columna_derecha', 'oferta'); ?>
<?php end_slot() ?>
