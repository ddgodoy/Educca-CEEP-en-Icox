<?php use_helper('informacion'); ?>
<? if (isset($info)) :  ?>
  <?php include_component('curso', 'fichaCurso',array('idcurso' => $idcurso,'info' => $info)) ?>
<? else : ?>
  <?php include_component('curso', 'fichaCurso',array('idcurso' => $idcurso)) ?>
<? endif ;?>

