<?php use_helper('informacion'); ?>
<?php if (isset($info)) :  ?>
  <?php include_component('curso', 'fichaCurso',array('idcurso' => $idcurso,'info' => $info)) ?>
<?php else : ?>
  <?php include_component('curso', 'fichaCurso',array('idcurso' => $idcurso)) ?>
<?php endif ;?>

